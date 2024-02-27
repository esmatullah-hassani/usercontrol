@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.edit') }} 
                        <a class="pull-right btn btn-default btn-xs" href="{{route('registrationPeriods.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                                           
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::model($type, ['route' => ['registrationPeriods.update', $type], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('code', null, ['class' => 'form-control ltr']) !!}     
                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>                         
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', trans('general.title'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>  
                            <div class="form-group {{ $errors->has('period') ? ' has-error' : '' }}">
                                {!! Form::label('period', trans('general.period'), ['class' => 'control-label col-sm-4 required']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::select('period', [1=>1,2=>2,3=>3,4=>4],$type->period, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('period'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('period') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="checkbox">
                                        <label>{!! Form::checkbox('default', 1, $type->default) !!} {{ trans('general.default') }}</label>
                                    </div>
                                </div>
                            </div>                         
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
