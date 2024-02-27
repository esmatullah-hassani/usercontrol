@extends('layouts.app')

@section('content')
        <div class="row">
            @include('developer.sidebar')
            <div class="col-md-8">
                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('general.system_name') !!}                        
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['system.name.update'], 'method' => 'put',  'class' => 'form-horizontal']) !!}                            
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('name', systemName(), ['class' => 'form-control']) !!}     
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                {!! Form::label('province', trans('general.province'), ['class' => 'control-label col-sm-3 required']) !!}
                                <div class="col-sm-5">
                                    {!! Form::select('province', $provinces, systemProvince('id'), ['id'=>'has-district','class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('province'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}">
                                {!! Form::label('district', trans('general.district'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::hidden('district',  systemDistrict('id') , ['id' => 'belongs-to-province','class' => 'form-control dropdown-student-districts']) !!}
                                    @if ($errors->has('district'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group {{ $errors->has('village') ? ' has-error' : '' }}">
                                {!! Form::label('village', trans('general.village'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('village', systemVillage(), ['class' => 'form-control']) !!}
                                    @if ($errors->has('village'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('village') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                {!! Form::label('address', trans('general.address'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('address', systemAddress(), ['class' => 'form-control']) !!}     
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                {!! Form::label('code', trans('general.code'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('code', systemCode(), ['class' => 'form-control']) !!}     
                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('manager') ? ' has-error' : '' }}">
                                {!! Form::label('manager', trans('general.manager'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('manager', systemManager(), ['class' => 'form-control']) !!}     
                                    @if ($errors->has('manager'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('manager') }}</strong>
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

