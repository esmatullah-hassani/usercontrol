<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use App\DataTables\CourseTypesDataTable;

class CourseTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(CourseTypesDataTable $dataTable)
    {
        return $dataTable->render('administrator.courseTypes.index');
    }

    public function create()
    {        
        return view('administrator.courseTypes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $type = CourseType::create([
            'title' => $request->get('title'),
            'team_id' => auth()->user()->current_team_id
        ]);        
        
        return redirect(route('courseTypes.index'))->with('success', trans('general.x_has_been_created', ['x' => $type->title]));
    }

    public function edit($courseType)
    {
        return view('administrator.courseTypes.edit', compact('courseType'));
    }

    public function update(Request $request, $courseType)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $courseType->update([
            'title' => $request->get('title')
        ]);        
        
        return redirect(route('courseTypes.index'))->with('success', trans('general.x_has_been_updated', ['x' => $courseType->title]));
    }

    public function destroy($courseType)
    {
        $courseType->delete();
        return redirect(route('courseTypes.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.course_type')]));
    }
}
