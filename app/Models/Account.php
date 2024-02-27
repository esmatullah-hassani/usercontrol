<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Account extends Model
{
    use UsedByTeams;
    use SoftDeletes;

    protected $guarded = [];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return trans("log.model_was_action", [
            'model' => trans('general.account').' "'.$this->name.'" ',
            'action' => trans('log.'.$eventName)
        ]);
    }
	

    public function setDefault()
    {
        self::where('team_id', '=', $this->team_id)->where('id', '!=', $this->id)->update(['default' => 0]);        
        return $this->update(['default' => 1]);
    }

    public function transactions()
    {
    	return $this->hasMany('App\Models\AccountTransaction', 'account_id', 'id');
    }
}
