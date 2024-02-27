<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Grade;
use App\DataTables\DepartmentsDataTable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');
    }

    public function index(DepartmentsDataTable $dataTable)
    {
        return $dataTable->render('administrator.departments.index');
    }

    public function create()
    {
        return view('administrator.departments.create', ['grades' => getGrades()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique("departments")
                ->where('team_id',currentTeamId())->whereNull("deleted_at")
            ],
            'title' => ['required',
                        Rule::unique("departments")
                        ->where('team_id',currentTeamId())->whereNull("deleted_at"),  
                        ],
            'eng_title' => [
                'nullable',
                Rule::unique("departments")
                ->where('team_id',currentTeamId())->whereNull("deleted_at")
            ],
            'number_title' => ['required',
                            Rule::unique("departments")
                            ->where('team_id',currentTeamId())->whereNull("deleted_at"),  
                            ], 
        ]);

        $department = DB::transaction(function () use ($request) {
            $department = Department::create(
                array_merge(
                    $request->only([
                        'code', 'title', 'eng_title', 'fees', 'credit_fees','number_title',
                    ]), [
                        'registrable' => $request->has('registrable'),
                        'capacity' => $request->capacity ? $request->get('capacity') :0,
                        'team_id' => currentTeamId()
                    ]
                )
            );

            if (!auth()->user()->isDeveloper()) {
                auth()->user()->departments()->attach([$department->id => ['team_id' => currentTeamId()]]);
            }

            return $department;
        });

        return redirect(route('departments.index'))->with('success', trans('general.x_has_been_created', ['x' => $department->title]));
    }

    public function edit($department)
    {
        return view('administrator.departments.edit', compact('department'));
    }

    public function update(Request $request, $department)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique('departments')->where('team_id', currentTeamId())->ignore($department->id),
            ],

            'title' => [
                'required',
                Rule::unique("departments")->where("team_id",currentTeamId())->ignore($department->id),
            ],
            'eng_title' => [
                Rule::unique('departments')->where("team_id",currentTeamId())->ignore($department->id),
            ],
            'number_title' => ['required',
                        Rule::unique('departments')
                            ->ignore($department->id)
                            ->where('team_id', currentTeamId())->whereNull('deleted_at'),  
                        ], 
        ]);
        //dd($request->all());
        $department->update(
            array_merge(
                $request->only([
                    'code', 'title',  'eng_title', 'fees', 'credit_fees','number_title'
                ]), [
                    'registrable' => $request->has('registrable'),
                    'female_fees' => $request->get('female_fees') != '' ? $request->get('female_fees') : null,
                    'female_credit_fees' => $request->get('female_credit_fees') != '' ? $request->get('female_credit_fees') : null,
                    'capacity'=>$request->get('capacity'),
                    'meta' => [
                        'abbreviation' => $request->get('abbreviation'),
                        'head_of_faculty' => $request->get('head_of_faculty')
                    ]
                ]
            )
        );

        return redirect(route('departments.index'))->with('success', trans('general.x_has_been_updated', ['x' => $department->title]));
    }

    public function destroy($department)
    {
        if ($department->students()->exists()) {
            return redirect(route('departments.index'))->with('error', trans('general.x_can_not_be_deleted', ['x' => trans('general.department')]));
        }

        $department->delete();
        return redirect(route('departments.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.department')]));
    }
}