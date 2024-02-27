<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetails;
use App\Models\Department;
use App\Models\Shift;
use App\Models\RegistrationType;
use App\Models\User as Student;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getStudentCode(Request $request)
    {
        $format = valueOf('student_code_format');
        $formatArray = explode(',', $format);
        $student = StudentDetails::find($request->id);
            
        foreach ($formatArray as $key => $value) {        
            if ($value == "registration_type_code") {
                $registrationType = RegistrationType::find($student->registration_type_id);
                $formatArray[$key] = $registrationType ? $registrationType->code : null;
            } elseif ($value == 'shift_code') {      
                $shift = Shift::find($student->shift_id);            
                $formatArray[$key] = $shift ? $shift->code : null;
            } elseif ($value == 'entrance_year') {
                $formatArray[$key] = substr($student->entrance_year, -2);
            } elseif ($value == 'department_code') {
                $department = Department::find($student->department_id);
                $formatArray[$key] =  $department ? $department->code : null;
            }                
        }

        if (in_array('sequence_number', $formatArray)) {
            $key = array_search('sequence_number', $formatArray);
            $formatArray[$key] = "%";
            $likeString = implode('', $formatArray);
            
            $result = Student::select(DB::raw(' MAX(CAST(SUBSTRING(code, LOCATE("%", "'.$likeString.'"), LENGTH(code) - '.(strlen($likeString) - 1).' ) AS unsigned)) as maxNumber'))
                ->where('code', 'like', $likeString)
                ->where('type','permanent')
                ->first();
            $maxNumber = $result ? $result->maxNumber : 0;            
            
            $formatArray[$key] = str_pad($maxNumber + 1, 3, '0', STR_PAD_LEFT);
        } 

        return response()->json([
            'success' => true,
            'code' => implode('', $formatArray)
        ]);
    }

    public function getThesisCode(Request $request)
    {
        $format = valueOf('student_code_format');
        $formatArray = explode(',', $format);
        $student = StudentDetails::find($request->id);
            
        $code = $student->getThesisCode();

        return response()->json([
            'success' => true,
            'code' => $code
        ]);
    }
}
