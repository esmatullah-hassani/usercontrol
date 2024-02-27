@extends('layouts.app')

@section('content')
    <div class="row">
        @include('administrator.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    {{ trans('general.add') }}
                    <a class="pull-right btn btn-default btn-xs" href="{{route('departments.index')}}">
                        <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                    </a>
                </div>
                <div class="panel-body">
                    @include('layouts.message')
                    {!! Form::open(['route' => 'departments.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    
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
                        {!! Form::label('title', trans('general.department_title'), ['class' => 'control-label col-sm-4 required']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('eng_title') ? ' has-error' : '' }}">
                        {!! Form::label('eng_title', trans('general.eng_department_title'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('eng_title', null, ['class' => 'form-control ltr']) !!}
                            @if ($errors->has('eng_title'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('eng_title') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('number_title') ? ' has-error' : '' }}">
                        {!! Form::label('number_title', trans('general.number_title'), ['class' => 'control-label col-sm-4 required']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('number_title', getClassNumber(),1, ['class' => 'form-control ltr']) !!}
                            @if ($errors->has('number_title'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('number_title') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('fees') ? ' has-error' : '' }}">
                        {!! Form::label('fees', trans('general.fees'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-sm-5">
                            {!! Form::number('fees', null, ['class' => 'form-control ltr']) !!}
                            @if ($errors->has('fees'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('fees') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('credit_fees') ? ' has-error' : '' }}">
                        {!! Form::label('credit_fees', trans('general.credit_fees'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-sm-5">
                            {!! Form::number('credit_fees', null, ['class' => 'form-control ltr']) !!}
                            @if ($errors->has('credit_fees'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('credit_fees') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }}">
                        {!! Form::label('capacity', trans('general.capacity'), ['class' => 'control-label col-sm-4']) !!}
                        <div class="col-sm-5">
                            {!! Form::number('capacity', null, ['class' => 'form-control ltr']) !!}
                            @if ($errors->has('capacity'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <div class="checkbox">
                                <label>{!! Form::checkbox('registrable', 1, false) !!} {{ trans('general.registrable') }}</label>
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
