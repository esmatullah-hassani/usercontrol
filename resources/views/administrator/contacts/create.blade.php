@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')     
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.add') }}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('contacts.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                        
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::open(['route' => 'contacts.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
                                {!! Form::label('user', trans('general.name'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::hidden('user', null, ['class' => 'form-control dropdown-all-users', 'placeholder' => trans('general.select')]) !!}
                                    @if ($errors->has('user'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user') }}</strong>
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
