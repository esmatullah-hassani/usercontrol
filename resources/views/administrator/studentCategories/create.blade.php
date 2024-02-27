@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')     
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.add_category') }}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('studentCategories.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                        
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::open(['route' => 'studentCategories.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}                                
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('code', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', trans('general.title'), ['class' => 'control-label col-sm-4 required']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label col-sm-4 required']) !!}
                                <div class="col-sm-5">
                                    {!! Form::select('department', $departments, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('class_type') ? ' has-error' : '' }}">
                                {!! Form::label('class_type', trans('general.class_type'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-5">
                                    {!! Form::select('class_type', [""=>"",trans('general.group_male') => trans('general.group_male'), trans('general.group_female') => trans('general.group_female'),trans('general.group_mixed')=> trans('general.group_mixed')],[], ['class' => 'form-control select2']) !!}
                                    @if ($errors->has('class_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('class_type') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                            </div>  
                            <div class="form-group {{ $errors->has('is_competence_group') ? ' has-error' : '' }}">
                                {!! Form::label('is_competence_group', trans('general.is_competence_group'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-5" style="margin-top: 8px;">
                                    {!! Form::checkbox('is_competence_group',true, false) !!}

                                    @if ($errors->has('is_competence_group'))
                                        <span class="help-block">
                                                        <strong>{{ $errors->first('is_competence_group') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                            </div>                                                                            
                            <hr>                        
                            <div class="form-group"> 
                                <div class="col-sm-offset-4 col-sm-4">
                                     <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
