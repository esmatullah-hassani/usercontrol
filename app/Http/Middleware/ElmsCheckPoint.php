<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\Course;
class ElmsCheckPoint
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->has('course_id')){
            $course = Course::find($request->get('course_id'));
            Session::put('course',$course);
            return $next($request);
        }

        if(Session::has('course'))
        {  
            $course = Session::get('course');
            if(isset($course->subject))
            {
                
                return $next($request); 
            }
            else
            {
                return redirect()->route('blog');  
            }
           
        }
        else
        {
            
            if($request->has('course_id'))
            {
                $course_id=$request->input('course_id');
            
                if($course_id>0)
                {
                    
                    $course=(new Course())->find($course_id);
                    Session::put('course', $course);
                    return $next($request);
                } 

            }

            return redirect()->route('blog'); 
        }
    }
}
