<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Notification;

use App\Notifications\Announcement;

use App\Models\User;
use Carbon\Carbon;
use Redis;
use App\Models\Course;
class MaterialJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    public $tries = 3;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
        $this->data=$data;
    }
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });

        Queue::after(function (JobProcessed $event) {
            \Log::error($event->job);
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            
            $material=$this->data;
            $this->notifyUser($material);
            
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            $this->failed($e);
        }
        
    }
    public function failed(\Exception $e = null)
    {
        //dd('faild');
    }

    public function notifyUser($material)
    {
        
        $course =(new Course())->find($material->course_id);
        if($material && $course)
            {
                $subject_title=__('general.material');
                //$subject_title=$course->subject->title;
                
                $studentList=$course->schedules;
                $student_id_array=array();
                foreach($studentList AS $stu)
                {
                    $student_id=$stu->student_id;
                    
                    array_push($student_id_array,$student_id);

                    $user=(new User())->find($student_id);
                    if($user)
                    {
                        $data=(object) ['title'=>$subject_title,
                        'message'=>$material->title];

                        $user->notify((new Announcement($data)));
                    }
                    else
                    {
                        \Log::error('no= '.$data->title);
                    }
                }
                $student_id_array=$student_id_array;
                //notification
            //     $users = User::select('users.id')               
            //         ->where('users.active', 1)
            //         ->whereIn('users.id', $student_id_array)
            //         ->get();
    
            
            //     $data=(object) ['title'=>$subject_title,
            //     'message'=>$material->title];
            //    // $time = Carbon::now()->addSeconds(20);
            //    $when = now()->addMinutes(1);
            //     $m=Notification::send($users, new MaterialUpload($data))->delay($when);
                
                // end message
                    
            }
    }

}
