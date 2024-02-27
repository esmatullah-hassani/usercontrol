<?php

namespace App\Models;

use App\Traits\StudentTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DCN\RBAC\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DCN\RBAC\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, Notifiable, HasRoleAndPermission,
        SoftDeletes;

    protected $guarded = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret'
    ];
    protected $dates = ['deleted_at'];
    
    protected $developers = [
        'admin@admin.com',
    ];

    protected $departments, $statuses;

    public function getDescriptionForEvent(string $eventName): string
    {
        return trans("log.entity_was_action", [
            //'entity' => ':subject.code'.' '.':subject.name'.' '.':subject.last_name',
            'entity' => 'user',
            'action' => trans('log.'.$eventName),
        ]);
    }

    public function isDeveloper()
    {
        return in_array($this->email, $this->developers);
    }

    public function isImpersonator()
    {
        return session()->has('accessControl:impersonator');
    }
    
    public function isTeammate($user)
    {
        return true;
    }
}
