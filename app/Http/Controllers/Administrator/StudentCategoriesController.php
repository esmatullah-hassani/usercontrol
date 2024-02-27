<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentCategory;
use App\Models\Department;
use App\DataTables\StudentCategoriesDataTable;

class StudentCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(StudentCategoriesDataTable $dataTable)
    {
        return $dataTable->render('administrator.studentCategories.index');
    }

    public function create()
    {                
        $departments = Department::pluck('title', 'id');

        return view('administrator.studentCategories.create',compact('departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'title' => 'required',  
            'department' => 'required',         
        ]);
        $category = StudentCategory::create([
            'code' => $request->get('code'),            
            'title' => $request->get('title'),
            'class_type' => $request->get('class_type'),
            'department_id'  => $request->get('department'),
            'is_competence_group' => $request->get('is_competence_group'),
            'team_id' => auth()->user()->current_team_id,
        ]);
        
        return redirect(route('studentCategories.index'))->with('success', trans('general.x_has_been_created', ['x' => $category->title]));
    }

    public function edit($studentCategory)
    {        
        $departments = Department::pluck('title','id');
        return view('administrator.studentCategories.edit', compact('studentCategory','departments'));
    }

    public function update(Request $request, $studentCategory)
    {
        $this->validate($request, [
            'title' => 'required',
            'department_id' => 'required',
        ]);

        $studentCategory->update([
            'code' => $request->get('code'), 
            'title' => $request->get('title'),
            'class_type' => $request->get('class_type'),
            'department_id'  => $request->get('department_id'),

        ]);

        return redirect(route('studentCategories.index'))->with('success', trans('general.x_has_been_updated', ['x' => $studentCategory->title]));
    }

    public function destroy($studentCategory)
    {
        $studentCategory->delete();
        return redirect(route('studentCategories.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.student_category')]));
    }
}