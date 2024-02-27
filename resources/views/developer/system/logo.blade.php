@extends('layouts.app')

@section('content')
        <div class="row">
            @include('developer.sidebar')
            <div class="col-md-8">
                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('general.system_logo') !!}                        
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['system.logo.update'],'files' => true, 'method' => 'put',  'class' => 'form-horizontal']) !!}                    
                            <div class="form-group ">                                
                                <div class="col-sm-5 col-sm-offset-2">
                                    {!! teamLogo() !!}
                                </div>                                
                            </div>
                            <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                {!! Form::label('logo', trans('general.logo'), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::file('logo', ['class' => 'form-control']) !!}     
                                    @if ($errors->has('logo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('logo') }}</strong>
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

