@foreach($role->children as $role)
    <div class="checkbox" style="margin-left:10px">
        <label>
            {!! Form::checkbox('roles[]', $role->id, $user->roles->contains($role->id)) !!} {{ $role->name }}
        </lable>                                        
        @include('users.roleChilderen', $role)
    </div>
@endforeach