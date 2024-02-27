<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\RegistrationPeriod;
use App\Models\Department;
use App\Models\SemesterDepartmentFee;
use App\DataTables\SemestersDataTable;
use Illuminate\Validation\Rule;

class SemestersController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:administrator');
    }

    public function index(SemestersDataTable $dataTable)
    {
        return $dataTable->render('administrator.semesters.index');
    }

    public function create()
    {
        $registrationPeriod = (new RegistrationPeriod())->get();

        return view('administrator.semesters.create', [
            'registrationPeriod' => $registrationPeriod
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'year' => [
                'required',
                'numeric',
                Rule::unique('semesters')->whereNull('deleted_at')
            ]
        ]);

        $semester = Semester::create([
            'title' => $request->get('title'),
            'eng_title' => $request->get('eng_title'),
            'year' => $request->get('year'),
            'registration_period_id' => $request->get('registration_period_id'),
        ]);

        if ($request->has('default')) {
            $semester->setDefault();
        }

        return redirect(route('semesters.index'))->with('success', trans('general.x_has_been_created', ['x' => $semester->title]));
    }

    public function edit($semester)
    {
        $registrationPeriod = (new RegistrationPeriod())->get();
        return view('administrator.semesters.edit', compact('semester', 'registrationPeriod'));
    }

    public function update(Request $request, $semester)
    {
        $this->validate($request, [
            'title' => 'required',
            'year' => [
                'required',
                'numeric',
                Rule::unique('semesters')->ignore($semester->id)
            ]
        ]);

        $semester->update([
            'title' => $request->get('title'),
            'eng_title' => $request->get('eng_title'),
            'year' => $request->get('year'),
            'registration_period_id' => $request->get('registration_period_id'),
        ]);

        if ($request->has('default')) {
            $semester->setDefault();
        }

        return redirect(route('semesters.index'))->with('success', trans('general.x_has_been_updated', ['x' => $semester->title]));
    }

    public function destroy($semester)
    {
        $semester->delete();
        return redirect(route('semesters.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.semester')]));
    }
    // display form with all semester in edit form if has value, user can created
    // value for departments
    public function semesterDepartmentFees($semester)
    {
        $department = (new Department())->get();

        $department = $department->map(function ($dep) use ($semester) {
            $semesterDepartmentFee = (new SemesterDepartmentFee())->where('semester_id', $semester->id)->where('department_id', $dep->id)->first();
            $fees = 0;
            $female_fees = 0;
            $credit_fees = 0;
            $female_credit_fees = 0;
            if ($semesterDepartmentFee) {
                $fees = $semesterDepartmentFee->fees;
                $female_fees = $semesterDepartmentFee->female_fees;
                $credit_fees = $semesterDepartmentFee->credit_fees;
                $female_credit_fees = $semesterDepartmentFee->female_credit_fees;
            }
            return [
                'id' => $dep->id,
                'title' => $dep->title,
                'fees' => $fees,
                'female_fees' => $female_fees,
                'credit_fees'=>$credit_fees,
                'female_credit_fees'=>$female_credit_fees
            ];
        });

        return view('administrator.semesters.semester_department_fee', [
            'department' => $department,
            'semester' => $semester
        ]);
    }

    // store or update semster departments fees
    public function storeSemesterDepartmentFee(Request $request)
    {

        $this->validate($request, [
            'semester_id' => 'required',
            'department_id' => 'required',
            'fees' => 'required'
        ]);
        $semester_id = $request->get('semester_id');
        $department_id = $request->get('department_id');
        $fees = $request->get('fees');
        $female_fees = $request->get('female_fees');

        $credit_fees = $request->get('credit_fees');
        $female_credit_fees = $request->get('female_credit_fees');

        $department_id = is_array($department_id) ? $department_id : [$department_id];
        $fees = is_array($fees) ? $fees : [$fees];
        $female_fees = is_array($female_fees) ? $female_fees : [$female_fees];

        $credit_fees = is_array($credit_fees) ? $credit_fees : [$credit_fees];
        $female_credit_fees = is_array($female_credit_fees) ? $female_credit_fees : [$female_credit_fees];

        foreach ($department_id as $key => $value) {
            if ($value > 0) {
                $semesterDepartmentFee = (new SemesterDepartmentFee())->where('semester_id', $semester_id)->where('department_id', $value)->first();
                if ($semesterDepartmentFee) {
                    if (!$fees[$key] && $female_fees[$key]) {
                        (new SemesterDepartmentFee())->where('semester_id', $semester_id)->where('department_id', $value)->delete();

                    } else {
                        $semesterDepartmentFee->update([
                            'fees' => isset($fees[$key]) ? $fees[$key]: 0 ,
                            'female_fees' => isset($female_fees[$key]) ? $female_fees[$key] : 0,
                            'credit_fees'=>isset($credit_fees[$key]) ?  $credit_fees[$key] : 0,
                            'female_credit_fees'=>isset($female_credit_fees[$key]) ?  $female_credit_fees[$key] : 0
                        ]);
                    }


                } else {
                    (new SemesterDepartmentFee())->create([
                        'semester_id' => $semester_id,
                        'department_id' => $value,
                        'fees' =>isset($fees[$key]) ? $fees[$key] : 0 ,
                        'female_fees' => isset($female_fees[$key]) ? $female_fees[$key] :0,
                        'credit_fees'=>isset($credit_fees[$key]) ?  $credit_fees[$key] : 0,
                        'female_credit_fees'=>isset($female_credit_fees[$key]) ?  $female_credit_fees[$key] : 0
                    ]);
                }

            }

        }


        $semester = (new Semester())->find($semester_id);


        return redirect(route('semester.department.fees', $semester))->with('success', trans('general.x_has_been_updated', ['x' => $semester->title]));

    }
}
