<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExtendedPermission as Permission;
use DCN\RBAC\Models\Role;

class RolePermissionsController extends Controller
{
    public function edit($role)
    {
        $permissionGroups = (new Permission)->groups();
        return view('roles.permissions', compact('role', 'permissionGroups'));
    }

    public function update(Request $request, $role)
    {
        $permissions = $request->has('permissions') ? $request->get('permissions') : [];
        $role->permissions()->sync($permissions);

        return redirect(route('rolePermissions.edit', $role))->with('success', trans('general.x_has_been_updated', ['x' => $role->name]));
    }
}
