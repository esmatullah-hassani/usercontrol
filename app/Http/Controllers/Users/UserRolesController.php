<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DCN\RBAC\Models\Role;
use App\Models\Department;
use App\Models\StudentStatus;

class UserRolesController extends Controller
{
    public function __construct()
    {        
        $this->middleware('permission:users.update', ['only' => ['update']]);   
        $this->middleware('permission:users.update', ['only' => ['edit']]);
    }

    public function edit($user)
    {
        $roles = Role::whereNotIn('id', [1])->get();
       
        return view('users.roles', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $roles = $request->has('roles') ? $request->get('roles') : [];
                

        $pivotData = array_fill(0, count($roles), []);
        $syncData  = array_combine($roles, $pivotData);
        $user->roles()->sync($syncData);

        return redirect(route('users.roles.edit', $user))->with('success', trans('general.x_has_been_updated', ['x' => $user->name]));
    }
}