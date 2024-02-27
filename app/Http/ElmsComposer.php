<?php

namespace App\Http\ViewComposers;

//use App\Repositories\UserRepository;
use Illuminate\View\View;
use Session;
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
        if(session::has('course'))
        {  
            $course = Session::get('course');
        }
        $view->with('course', $course);
    }
}