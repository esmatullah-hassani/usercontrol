@extends('layouts.auth')

@section('content')
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-4 login-container bs-reset">                    
            <div class="login-content text-center">
                {!! systemLogo(['class' => 'login-6', 'style' => 'max-height:160px']) !!}
                <h1>{!! systemName() !!}</h1>
                <h3> {{ trans('general.login_to_system') }} </h3>
                <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            @include('layouts.message')
                            @if ($errors->has('email'))
                                <div class="alert alert-warning">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <input class="form-control form-control-solid placeholder-no-fix ltr" type="email" value="{{ old('email') }}" placeholder="{{ trans('general.email') }}" name="email" required autofocus />

                        </div>                                
                    </div>
                    <div class="row">                            
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <input class="form-control form-control-solid placeholder-no-fix ltr " type="password" autocomplete="off" placeholder="{{ trans('general.password') }}" name="password" required/>                                    
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                                                                
                    <div class="row">
                        <div class="col-xs-6 col-md-5 col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" @if(old('remember')) checked @endif> {{ trans('general.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <button class="btn blue pull-right" type="submit">
                                {{ trans('general.login') }}
                            </button>                                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-xs-12">                                    
                            <div class="forgot-password">
                                <p>{{ trans('general.forgot_your_password') }} <a href="{{ url('password/reset') }}" id="forget-password" class="forget-password">{{ trans('general.click_here') }}</a></p>
                            </div>                                    
                        </div>
                    </div>
                </form>                      
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-4 bs-reset">
                        <!-- <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="col-xs-8 bs-reset">
                        <div class="login-copyright text-right">
                            <p>{{ date('Y') }} &copy; توسعه نرم افزار <a href="http://rubik.af" title="روبیک" target="_blank">روبیک</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 bs-reset">
            <div class="login-bg"> </div>
        </div>
    </div>
</div>
@endsection