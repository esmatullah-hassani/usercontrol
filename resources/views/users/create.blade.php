@extends('layouts.app')

@section('content')
        <div class="row">            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.add_user') }}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('users.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                        
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}                    
                            <div class="form-group {{ $errors->has('id_card') ? ' has-error' : '' }}">
                                {!! Form::label('id_card', trans('general.id_card'), ['class' => 'control-label col-sm-4 required']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::text('id_card', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('id_card'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_card') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-4 required']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {!! Form::label('last_name', trans('general.last_name'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::text('phone', null, ['class' => 'form-control ltr']) !!}                                    
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', trans('general.email'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::email('email', null, ['class' => 'form-control ltr']) !!}                                    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif                                 
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', trans('general.password'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::password('password', ['class' => 'form-control ltr']) !!}                                    
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                                {!! Form::label('photo', trans('general.photo'), ['class' => 'control-label col-sm-4']) !!}
                                <div class="col-sm-4">
                                    <input type="file" name="photo" id="photo" />
                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_account', trans('general.user_account'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-4">
                                    {!! Form::select('user_account', ['1' => trans('general.active'), '0' => trans('general.inactive')],0, ['class' => 'form-control select2']) !!}                                    
                                </div>
                            </div>                                                                       
                            <hr>
                            <div class="form-group"> 
                                <div class="col-sm-offset-4 col-sm-8">
                                    <div class="checkbox">
                                        <label>{!! Form::checkbox('new', 1, false) !!} {{ trans('general.add_user') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="col-sm-offset-4 col-sm-8">
                                     <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>    
@endsection
