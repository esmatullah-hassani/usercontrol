@extends('layouts.app')

@section('content')
    <div class="row">
        @include('developer.sidebar')     
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{ trans('general.edit_role') }} 
                    <a class="pull-right btn btn-default btn-xs" href="{{route('roles.index')}}" >
                        <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                    </a>                                           
                </div>
                <div class="panel-body">
                    @include('layouts.message')
                    {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put', 'class' => 'form-horizontal']) !!}                    
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-4']) !!}                                
                            <div class="col-sm-5">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}     
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                                                                                                   
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                            {!! Form::label('slug', trans('general.slug'), ['class' => 'control-label col-sm-4']) !!}                                
                            <div class="col-sm-5">
                                {!! Form::text('slug', null, ['class' => 'form-control']) !!}     
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif                                                                                                   
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('parent_id', trans('general.parent'), ['class' => 'control-label col-sm-4']) !!}                                
                            <div class="col-sm-5">
                                {!! Form::select('parent_id', $roles, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}                                    
                            </div>
                        </div>                              
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', trans('general.description'), ['class' => 'control-label col-sm-4']) !!}                                
                            <div class="col-sm-5">
                                {!! Form::text('description', null, ['class' => 'form-control']) !!}     
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif                                                                                                   
                            </div>
                        </div>                            
                        <hr>                         
                        <div class="form-group"> 
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection