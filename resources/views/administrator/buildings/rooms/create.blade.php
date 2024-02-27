@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')     
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.add_time') }}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('times.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                        
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::open(['route' => 'times.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}                                
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
                            <div class="form-group {{ $errors->has('from-to') ? ' has-error' : '' }}">
                                {!! Form::label('from-to', trans('general.from-to'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('from-to', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('from-to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('from-to') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                                {!! Form::label('color', trans('general.color'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::color('color', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>                                                    
                            <div class="form-group"> 
                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="checkbox">
                                        <label>{!! Form::checkbox('default', 1, false) !!} {{ trans('general.default') }}</label>
                                    </div>
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
