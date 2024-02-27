<?php
namespace App\Models;

use DCN\RBAC\Models\Permission;

class ExtendedPermission extends Permission
{
    protected $table = 'permissions';   

    public function groups()
    {
        return $this->select('description')->groupBy('description')->get();
    }

    public function permissions()
    {
        return $this->where('description', $this->description)->get();
    }

}
