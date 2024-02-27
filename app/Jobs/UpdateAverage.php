<?php

namespace App\Jobs;

use App\Models\Average;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAverage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $studentId, $studentDepartmentId,$studentCategoryId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $studentId, int $studentDepartmentId,int $studentCategoryId)
    {
        $this->studentId = $studentId;
        $this->studentDepartmentId = $studentDepartmentId;
        $this->studentCategoryId = $studentCategoryId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        Average::updateAverageByStudentId($this->studentId, $this->studentDepartmentId,$this->studentCategoryId);
    }
}
