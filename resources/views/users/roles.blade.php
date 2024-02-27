@extends('layouts.app')

@section('content')
<div class="row">            
    <div class="col-md-12">
        @include('users.sidebar')
        <div class="profile-content">
            <div class="row">            
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            {{ trans('general.roles') }} 
                            <a class="pull-right btn btn-default btn-xs" href="{{route('users.index')}}" >
                                <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                            </a>                                           
                        </div>
                        <div class="panel-body">
                            @include('layouts.message')
                            {!! Form::open(['route' => ['users.roles.update', $user], 'method' => 'put', 'class' => 'form-horizontal']) !!}                                                                     
                                <div class="form-group">
                                    {!! Form::label('roles', trans('general.roles'), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-sm-5">
                                        @foreach($roles as $role)
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('roles[]', $role->id, $user->roles->contains($role->id)) !!} {{ $role->name }}
                                                </lable>                                        
                                                @include('users.roleChilderen', $role)
                                            </div>                                                                                                                         
                                        @endforeach
                                    </div>
                                </div>
                                
                                @permission('users.update')
                                <hr>                                                 
                                <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                    </div>
                                </div>
                                @endpermission
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
