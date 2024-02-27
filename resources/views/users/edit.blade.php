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
                            {{ trans('general.edit_user_details') }} 
                            <a class="pull-right btn btn-default btn-xs" href="{{route('users.index')}}" >
                                <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                            </a>                                           
                        </div>
                        <div class="panel-body">
                            @include('layouts.message')
                            {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}                    
                                <div class="form-group {{ $errors->has('id_card') ? ' has-error' : '' }}">
                                    {!! Form::label('id_card', trans('general.id_card'), ['class' => 'control-label col-sm-3 ']) !!}                                
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
                                    {!! Form::label('name', trans('general.name'), ['class' => 'control-label col-sm-3']) !!}                                
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
                                    {!! Form::label('last_name', trans('general.last_name'), ['class' => 'control-label col-sm-3']) !!}                                
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
                                    {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-4">
                                        {!! Form::text('phone', null, ['class' => 'form-control ltr']) !!}                                    
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email', trans('general.email'), ['class' => 'control-label col-sm-3']) !!}                                
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
                                    {!! Form::label('password', trans('general.password'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-4">
                                        {!! Form::password('password', ['class' => 'form-control ltr', 'id' => 'password']) !!}                                    
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                                    {!! Form::label('photo', trans('general.photo'), ['class' => 'control-label col-sm-3']) !!}
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
                                    {!! Form::label('user_account', trans('general.user_account'), ['class' => 'control-label col-sm-3']) !!}                                
                                    <div class="col-sm-4">
                                        {!! Form::select('user_account', ['1' => trans('general.active'), '0' => trans('general.inactive')], $user->active, ['class' => 'form-control select2']) !!}                                    
                                    </div>
                                </div>                                                                        
                                <hr>                                                 
                                <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" id="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
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

@push('scripts')
    {!! Html::script('js/pwstrength-bootstrap.min.js') !!}

    <script>
		$(function(){
				var handlePasswordStrengthChecker = function () {
					var initialized = false;
					var options = {};
					options.ui = {												
						showVerdictsInsideProgressBar: true,												
					}
                    options.common = {
                        onScore: function (options, word, score) {
                            if (score >= 38) {
                                $('#submit').removeAttr('disabled')
                            } else {
                                $('#submit').attr('disabled', 'disabled')
                            }

                            return score;
                        }
                    };

					var input = $("#password");

					input.keydown(function () {
						if (initialized === false) {
							// set base options
							input.pwstrength(options);							
							// set as initialized 
							initialized = true;
						}
					});
					
				}
			
				handlePasswordStrengthChecker();
		})
	</script>    
@endpush
