<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentStatus;
use App\DataTables\StudentStatusesDataTable;
use Illuminate\Support\Facades\DB;

class StudentStatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(StudentStatusesDataTable $dataTable)
    {
        return $dataTable->render('administrator.studentStatuses.index');
    }

    public function create()
    {                
        return view('administrator.studentStatuses.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'title' => 'required',            
        ]);

        $status = DB::transaction(function () use ($request) {
            $status = StudentStatus::create([            
                'title' => $request->get('title'),            
                'team_id' => auth()->user()->current_team_id,
            ]);

            if(! auth()->user()->isDeveloper()) {
                auth()->user()->statuses()->attach([$status->id => ['team_id' => currentTeamId()]]);
            }
            
            if ($request->has('default')) {
                $status->setDefault();
            }

            return $status;
        });
        
        return redirect(route('studentStatuses.index'))->with('success', trans('general.x_has_been_created', ['x' => $status->title]));
    }

    public function edit($studentStatus)
    {        
        return view('administrator.studentStatuses.edit', compact('studentStatus'));
    }

    public function update(Request $request, $studentStatus)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $studentStatus->update([
            'title' => $request->get('title')            
        ]);

        if ($request->has('default')) {
            $studentStatus->setDefault();
        }      
        
        return redirect(route('studentStatuses.index'))->with('success', trans('general.x_has_been_updated', ['x' => $studentStatus->title]));
    }

    public function destroy($studentStatus)
    {
        $studentStatus->delete();
        return redirect(route('studentStatuses.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.student_status')]));
    }
}