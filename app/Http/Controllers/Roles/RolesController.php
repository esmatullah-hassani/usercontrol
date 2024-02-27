<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\DataTables\RolesDataTable;
use App\Models\Province;
use Illuminate\Validation\Rule;
use DCN\RBAC\Models\Role;
use App\Models\ExtendedPermission as Permission;


class RolesController extends Controller
{
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

    public function create()
    {        
        $roles = Role::pluck('name', 'id');
        return view('roles.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:roles',
            'slug' => 'unique:roles',
        ]);

        $role = Role::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->has('parent_id') ? $request->get('parent_id') : null,
            'description' => $request->get('description'),
        ]);        
        
        return redirect(route('roles.index'))->with('success', trans('general.x_has_been_registered', ['x' => $role->name]));
    }

    public function edit($role)
    {
        $roles = Role::pluck('name', 'id');
        return view('roles.edit', compact('role', 'roles'));
    }

    public function update(Request $request, $role)
    {
        $this->validate($request, [
            'name' => [Rule::unique('roles')->ignore($role->id)],
            'slug' => [Rule::unique('roles')->ignore($role->id)],
        ]);       

        $role->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'parent_id' => $request->has('parent_id') ? $request->get('parent_id') : null,
            'description' => $request->get('description'),
        ]); 
        
        return redirect(route('roles.index', $role))->with('success', trans('general.x_has_been_updated', ['x' => $role->name]));
    }

    public function destroy($role)
    {
        $role->delete();
        return redirect(route('roles.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.role')]));
    }
}