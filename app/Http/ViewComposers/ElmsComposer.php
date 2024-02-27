<?php

namespace App\Http\ViewComposers;

//use App\Repositories\UserRepository;
use App\Models\Course;
use Illuminate\View\View;
use Session;
use App\Models\Elms\VisitInformation;
use App\Models\Elms\Assignment;
class ElmsComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;
    protected $course;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {   
        
        // Dependencies automatically resolved by service container...
        //$this->course = $course;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $course=null;
        $material_notification=0;
        $assignment_notification=0;
        $totalAssignmentScore=0;
        $request = request();
        if ($request->has('course_id')){
            $course = Course::find($request->get('course_id'));
            Session::put('course',$course);
        }

        if(Session::has('course'))
        {  
            
            $course = Session::get('course');
            $material_notification=(new VisitInformation())->checkVisit('material',null,$course->id);
            $assignment_notification=(new VisitInformation())->checkVisit('assignment',null,$course->id);
            $totalAssignmentScore=(new Assignment())->courseTotalScoreOfAssignment($course->id);
            
        }
        else
        {
            
            return redirect(route('blog'));
            
        }

        $view->with('course', $course);
        $view->with('material_notification', $material_notification);
        $view->with('assignment_notification', $assignment_notification);
        $view->with('total_assignment_score', $totalAssignmentScore);
    }
}