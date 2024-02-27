@extends('layouts.app')

@section('content')
        <div class="row">
            @include('developer.sidebar')     
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.permissions') }} <strong>{{ $role->name }}</strong>
                        <a class="pull-right btn btn-default btn-xs" href="{{route('roles.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                                           
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::model($role, ['route' => ['rolePermissions.update', $role], 'method' => 'put', 'class' => 'form-horizontal']) !!}                    
                            @foreach($permissionGroups as $group)
                            <div class="form-group">
                                {!! Form::label('permission[]', $group->description, ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-9">
                                    @foreach($group->permissions() as $permission)
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', $permission->id, $role->permissions->contains($permission->id)) !!} {{ $permission->name }}
                                            </lable>                                        
                                        </div>
                                    @endforeach
                                </div>                                
                            </div>
                            <hr>
                            @endforeach                                                    
                            <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
{!! Html::script('vendor/persianDatepicker/js/persianDatepicker.js') !!}
@endpush