@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-md-9">
                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('general.login_slides') !!}                        
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['login.slides.update'],'files' => true, 'method' => 'put',  'class' => 'form-horizontal']) !!}                            
                            <div class="form-group {{ $errors->has('first_slide') ? ' has-error' : '' }}">
                                {!! Form::label('first_slide', trans('general.first_slide'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::file('first_slide', ['class' => 'form-control']) !!}     
                                    @if ($errors->has('first_slide'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_slide') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('second_slide') ? ' has-error' : '' }}">
                                {!! Form::label('second_slide', trans('general.second_slide'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::file('second_slide', ['class' => 'form-control']) !!}     
                                    @if ($errors->has('second_slide'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('second_slide') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('third_slide') ? ' has-error' : '' }}">
                                {!! Form::label('third_slide', trans('general.third_slide'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::file('third_slide', ['class' => 'form-control']) !!}     
                                    @if ($errors->has('third_slide'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('third_slide') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
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

