<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateMashrootStudent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;
    public $isMasters;
    public $validAverage;
    public $departmentCounter;
    
    public function __construct(User $student)
    {
        $this->student = $student;
        $this->isMasters = $this->student->studentDetails->isMasters();
        $this->validAverage = $this->student->studentDetails->validAverage();
        $this->departmentCounter = $this->student->studentDetails->department_id;                
    }

    public function handle()
    {
        $this->updateIfMashroot();
    }

    public function updateIfMashroot()
    {              
        if ($this->isMashroot()) {
            $this->student->studentDetails->update([
                'is_mashroot' => 1
            ]);
        } elseif ($this->student->studentDetails->is_mashroot) {            
            $this->student->studentDetails->update([
                'is_mashroot' => 0
            ]);        
        }
    }

    public function isMashroot()
    {        
        if ($this->isMasters and $this->departmentCounter >= 1 and ! $this->validateSemesters(2)) {
            return true;
        } elseif ($this->departmentCounter >= 3 and ! $this->validateSemesters(3)) {
            return true;
        } elseif ($this->departmentCounter >= 3 and ! $this->validateSemesters(4, false)) {
            return true;
        }
        
        return false;
    }
      
    public function validateSemesters($semesters, $consicutive = true)
    {
        $averages = $this->getAverages($semesters, $consicutive);
        
        return $averages->where('average', '<', $this->validAverage)->count() < $semesters;
    }

    public function getAverages($semesters, $consicutive)
    {    
        $averages = $this->student->averages()
            ->where('department_id', '<=', $this->departmentCounter)
            ->orderBy('department_id', 'desc');

        if ($consicutive) {
            $averages->take($semesters);
        }

        return $averages->get();
    }
}
