@extends('layouts.app')

@section('content')
    <div class="row">
        @include('administrator.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{ trans('general.add') }}
                    <a class="pull-right btn btn-default btn-xs" href="{{route('categories.index')}}">
                        <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                    </a>
                </div>
                <div class="panel-body">
                    @include('layouts.message')
                    {!! Form::open(['route' => 'categories.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    
                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-4 required']) !!}
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
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', trans('general.description'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-sm-5">
                            {!! Form::textarea('description', null, ['class' => 'form-control ltr','rows' => 4,'cols' => 54]) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <hr> 
                    <div class="form-group"> 
                        <div class="col-sm-offset-4 col-sm-4">
                            <div class="checkbox">
                                <label>{!! Form::checkbox('new', 1, false) !!} {{ trans('general.add_categories') }}</label>
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
