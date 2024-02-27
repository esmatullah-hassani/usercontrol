<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\DataTables\EmployeesDataTable;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employees.*', ['only' => ['index']]);        
        $this->middleware('permission:employees.create', ['only' => ['create','store']]);
        $this->middleware('permission:employees.update', ['only' => ['edit','update']]);
        $this->middleware('permission:employees.destroy', ['only' => ['destroy']]);
    }

    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employees.index');
    }

    public function create()
    {                
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => [Rule::unique('employees')->where('team_id', currentTeamId())],
            'name' => 'required|max:100',            
            'job_title' => 'max:100',
            'salary' => 'numeric',   
        ]);

        $employee = Employee::create([            
            'code' => $request->has('code') ? $request->get('code') : null,
            'name' => $request->get('name'),
            'job_title' => $request->has('job_title') ? $request->get('job_title') : null,
            'salary' => $request->has('salary') ? $request->get('salary') : 0,
            'team_id' => currentTeamId()
        ]);        

        $route = $request->has('new') ? route('employees.create') : route('employees.index');           
        return redirect($route)->with('success', trans('general.x_has_been_created', ['x' => $employee->name]));
    }

    public function edit($employee)
    {        
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $employee)
    {
        $this->validate($request, [
            'code' => [Rule::unique('employees')->ignore($employee->id)->where('team_id', currentTeamId())],
            'name' => 'required',
            'job_title' => 'max:100',
            'salary' => 'numeric',           
        ]);

        $employee->update([
            'code' => $request->has('code') ? $request->get('code') : null,
            'name' => $request->get('name'),
            'job_title' => $request->has('job_title') ? $request->get('job_title') : null,
            'salary' => $request->has('salary') ? $request->get('salary') : 0,
        ]);        
        
        return redirect(route('employees.index'))->with('success', trans('general.x_has_been_updated', ['x' => $employee->name]));
    }

    public function destroy($employee)
    {
        $employee->delete();
        return redirect(route('employees.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.employee')]));
    }
}