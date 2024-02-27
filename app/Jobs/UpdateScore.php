<?php

namespace App\Jobs;

use DB;
use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateScore implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $score, $attributes;

    public function __construct(Score $score, array $attributes = [])
    {
        $this->score = $score;        
        $this->attributes = array_only($attributes, ['semester_id', 'department_id', 'homework','homework2', 'classwork','classwork2', 'midterm', 'final',  'visible', 'description', 'valid']);
    }

    public function handle()
    {        
        DB::transaction(function () {
            $this->score->update($this->attributes);
        });
        
        return $this->score;
    }

    public static function fromRequest(Score $score, $request)
    {
        return new self($score, [
            'semester_id' => $request->semester,
            'department_id' => $request->department_id,
            'student_category_id' => $request->category,
            'homework' => $request->homework,
            'homework2' => $request->homework2,
            'classwork' => $request->classwork,
            'classwork2' => $request->classwork2,
            'midterm' => $request->midterm,
            'final' => $request->final,           
            'visible' => $request->has('visible'),
            'valid' => $request->has('valid'),
            'description' => $request->description,
        ]);
    }
}
