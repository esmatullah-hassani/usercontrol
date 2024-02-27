<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Teamwork\Traits\UserHasTeams;
use jDateTime;
use Spatie\Activitylog\Traits\CausesActivity;

trait UserTrait
{   
    use SoftDeletes;
    use CausesActivity, UserHasTeams;

    public function getDescriptionForEvent(string $eventName): string
    {
        return trans("log.entity_was_action", [
            'entity' => ':subject.code'.' '.':subject.name'.' '.':subject.last_name',            
            'action' => trans('log.'.$eventName),             
        ]);
    } 

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachable');
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value);    
    }

    public function setMetaAttribute($value)
    {        
        $this->attributes['meta'] = json_encode($value);
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->last_name;
    }

    public function setBirthDateAttribute($value)
    {
        if (! $value) {
            $this->attributes['birth_date'] = null;
        } else {
            $date = explode("/", $value);
            $this->attributes['birth_date'] = date('Y-m-d', jDateTime::mktime(0, 0, 0, $date[1], $date[2], $date[0]));
        }
    }

    public function getBirthDateAttribute($value)
    {
        if ($value) {
            return jDateTime::convertFormatToFormat('Y/n/j', 'Y-m-d', $value, 'Asia/Kabul');    
        } 
        return null;
    }
}