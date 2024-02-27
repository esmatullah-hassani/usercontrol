@extends('layouts.app')

@section('content')
        <div class="row">
            @include('teachers.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.teacher_details') }} 
                        <a class="pull-right btn btn-default btn-xs" href="{{route('teachers.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                                           
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clear-both">
                                    {!! Form::label('code', trans('general.code'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->code }}                                                                                             
                                    </div>
                                </div>
                                <div class="form-group clear-both {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', trans('general.name'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->name }}     
                                    </div>
                                </div>
                                <div class="form-group clear-both {{ $errors->has('father_name') ? ' has-error' : '' }}">
                                    {!! Form::label('father_name', trans('general.father_name'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->father_name }}                                                                  
                                    </div>
                                </div>
                                <div class="form-group clear-both">
                                    {!! Form::label('grandfather_name', trans('general.grandfather_name'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->grandfather_name }}
                                    </div>
                                </div>
                                <div class="form-group clear-both">
                                    {!! Form::label('birth_date', trans('general.birth_date'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->birth_date }}
                                    </div>
                                </div>
                                <div class="form-group clear-both">
                                    {!! Form::label('gender', trans('general.gender'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->gender ? ($teacher->gender == 'm' ? trans('general.male') : trans('general.female')) : null }}                                  
                                    </div>
                                </div>
                                <div class="form-group clear-both">
                                    {!! Form::label('marital_status', trans('general.marital_status'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->marital_status ? ($teacher->marital_status == 's' ? trans('general.single') : trans('general.married')) : null }}                                                                                                         
                                    </div>
                                </div>
                                <div class="form-group clear-both">
                                    {!! Form::label('province', trans('general.province'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->province ? $teacher->province->title : null }}                                    
                                    </div>
                                </div>                            
                                <hr>
                                <div class="form-group clear-both">
                                    {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->phone }}                                    
                                    </div>
                                </div>
                                <div class="form-group clear-both {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email', trans('general.email'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->email }}                               
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group clear-both">
                                    {!! Form::label('description', trans('general.description'), ['class' => 'control-label align-right col-sm-5']) !!}                                
                                    <div class="col-sm-7">
                                        {{ $teacher->description }}                                    
                                    </div>
                                </div>                                                                                              
                            </div>
                        </div> 
                        <hr>                                                                                                         
                        <div class="form-group clear-both"> 
                            <div class="col-sm-offset-3 col-sm-7">
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-primary">{{ trans('general.edit') }}</a>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
@endsection