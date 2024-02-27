<?php

use App\Models\CourseTime;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Storage;
use App\Models\Semester;
use App\Models\Setting;
use App\Models\User;
use App\Http\CalendarUtils;
use App\Models\Category;
use App\Models\Department;
use App\Models\District;
use App\Models\Employee;
use App\Models\Province;
use App\Models\RegistrationPeriod;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

function systemLogo(array $atributes = [])
{
    $attr = "";
    if ($atributes) {
      foreach($atributes as $key => $value) {
        $attr .= $key."='".$value."' ";
      }
    }

    if(Storage::exists("/public/".config('client')."/logo.jpg")) {
      $src = asset("/storage/".config('client')."/logo.jpg");
    } else {
      $src = asset("/images/logo-placeholder.jpg");
    }

    return  "<img src='$src' ".$attr." />";
}

function systemName()
{
    
    return   trans('general.system');
}

function jalaliDate($format = 'Y/m/j', $time = null, $persianNumber = false)
{
    $time = $time ? $time : time();
    return jDateTime::date($format, $time, $persianNumber, "Asia/Kabul");
}

function systemLogoUrl()
{
    $attr = "";
    
    if (Storage::exists("/public/" . config('client') . "/logo.jpg")) {
        $src = asset("/storage/" . config('client') . "/logo.jpg");
    } else {
        $src = asset("/images/logo-placeholder.jpg");
    }

    return $src;
}

function userPhoto(User $user = null, array $atributes = [])
{
	if($user and $user->photo_url and Storage::exists(str_replace("/storage/","public/", $user->photo_url))) {
		$src = url($user->photo_url);
    } else {
    	$src = url("/images/avatar-placeholder.png");
    }

   	$attr = "";
   	if ($atributes) {
   		foreach($atributes as $key => $value) {
   			$attr .= $key."='".$value."' ";
   		}
   	}

   	return  "<img src='$src' ".$attr." />";
}



