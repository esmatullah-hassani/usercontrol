<?php

namespace App\Jobs;

use App\Models\StudentAttendanceTotal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTotalAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $studentId, $studentDepartmentId,$studentCategoryId,$semesterId,$registrationPeriodId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $studentId, int $studentDepartmentId,int $studentCategoryId,int $semesterId,int $registrationPeriodId)
    {
        $this->studentId = $studentId;
        $this->studentDepartmentId = $studentDepartmentId;
        $this->studentCategoryId = $studentCategoryId;
        $this->semesterId = $semesterId;
        $this->registrationPeriodId = $registrationPeriodId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        StudentAttendanceTotal::updateAtteendanceByStudentId($this->studentId, $this->studentDepartmentId,$this->studentCategoryId,$this->semesterId,$this->registrationPeriodId);
    }
}
