@extends('layouts.app')

@section('content')
<div class="row">            
    <div class="col-md-12">
        @include('users.sidebar')
        <div class="profile-content">
            <div class="row">            
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            {{ trans('general.photo') }} 
                            <a class="pull-right btn btn-default btn-xs" href="{{route('users.index')}}" >
                                <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                            </a>                                           
                        </div>
                        <div class="panel-body">
                            @include('layouts.message')
                            {!! Form::open(['route' => ['photo.update', $user],'files' => true, 'method' => 'put',  'class' => 'form-horizontal']) !!}                    
                                <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                                    {!! Form::label('photo', trans('general.photo'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-5">
                                        {!! Form::file('photo', ['class' => 'form-control']) !!}     
                                        @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('photo') }}</strong>
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
        </div>
    </div>
</div> 
@endsection