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
                        {{ trans('general.user_details') }} 
                        <a class="pull-right btn btn-default btn-xs" href="{{route('users.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                                           
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group clear-both {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', trans('general.name'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $user->name }}     
                                    </div>
                                </div>
                                <div class="form-group clear-both {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    {!! Form::label('last_name', trans('general.last_name'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $user->last_name }}     
                                    </div>
                                </div>
                               
                                
                                <div class="form-group clear-both">
                                    {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $user->phone }}                                    
                                    </div>
                                </div>
                                <div class="form-group clear-both {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email', trans('general.email'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $user->email }}                               
                                    </div>
                                </div>                                                                                         
                            </div>
                        </div> 
                        @permission('users.update')
                        <hr>                                                                                                         
                        <div class="form-group clear-both"> 
                            <div class="col-sm-7">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">{{ trans('general.edit') }}</a>
                            </div>
                        </div>
                        @endpermission
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.permissions') }}                                           
                    </div>                    
                    <div class="panel-body">                     
                        <style>
                            li {
                                margin-bottom: 5px;
                            }
                            ul {
                                margin-top: 5px;
                            }
                        </style>
                        <ul>
                            @foreach($user->roles as $role)
                                <li>
                                    <span title="{{ trans('general.role') }}">{{ $role->name }}</span>
                                    <ul>
                                        @foreach($role->permissions->groupBy('description') as $permissions)
                                        <li>
                                            <span title="{{ trans('general.section') }}">{{ $permissions->first()->description }}</span>
                                            <ul>
                                                @foreach($permissions as $permission)
                                                    <li title="{{ trans('general.permission') }}">{{ $permission->name }}</li>
                                                @endforeach
                                            </ul>                                                
                                        </li>                                        
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection