@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.edit_semester') }}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('semesters.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::model($semester, ['route' => ['semesters.update', $semester], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', trans('general.title'), ['class' => 'control-label col-sm-4 required']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('title', null, ['class' => 'form-control',]) !!}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('eng_title') ? ' has-error' : '' }}">
                                {!! Form::label('eng_title', trans('general.eng_title'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('eng_title', null, ['class' => 'form-control',]) !!}
                                    @if ($errors->has('eng_title'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('eng_title') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
                                {!! Form::label('year', trans('general.year'), ['class' => 'control-label col-sm-4 required']) !!}
                                <div class="col-sm-5">
                                    {!! Form::number('year', null, ['class' => 'form-control','placeholder'=>'1399']) !!}
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('registration_period_id') ? ' has-error' : '' }}">
                                {!! Form::label('registration_period_id', trans('general.registration_period'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-5">
                                    <select name="registration_period_id" class="form-control">

                                      @foreach($registrationPeriod AS $rp)
                                        <option value="{{$rp->id}}" {{($rp->id==$semester->registration_period_id)?'selected':''}}>{{$rp->title}}</option>
                                      @endforeach

                                    </select>
                                    @if ($errors->has('registration_period_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('registration_period_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="checkbox">
                                        <label>{!! Form::checkbox('default', 1, $semester->default) !!} {{ trans('general.default') }}</label>
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
