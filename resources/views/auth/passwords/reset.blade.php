@extends('layouts.auth')

@section('content')
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-4 login-container text-center bs-reset">                    
                    <div class="login-content">
                        {!! systemLogo(['class' => 'login-6', 'style' => 'max-height:160px']) !!}
                        <h1>{!! systemName() !!}</h1>
                        <h3> {{ trans('general.reset_password') }}</h3>
                        <form class="login-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-md-offset-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="form-control form-control-solid placeholder-no-fix ltr" type="email" autocomplete="off" placeholder="{{ trans('general.email') }}" name="email" required autofocus/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-md-8 col-md-offset-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" class="form-control form-control-solid placeholder-no-fix ltr " type="password" autocomplete="off" placeholder="{{ trans('general.password') }}" name="password" required/> 
                                    @if ($errors->has('password'))
                                        <span class="help-block text-left">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-md-offset-2 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input class="form-control form-control-solid placeholder-no-fix ltr " type="password" autocomplete="off" placeholder="{{ trans('general.password_confirmation') }}" name="password_confirmation" required/> 
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block text-left">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                                                    
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-md-offset-2 text-left">                                                                  
                                    <a type="button" id="back-btn" href="{{ url('login') }}" class="btn grey btn-default"> {{ trans('general.back') }}</a>
                                </div>
                                <div class="col-xs-6 col-md-4 text-left">                                
                                    <button class="btn blue pull-right" id="submit" type="submit">
                                         {{ trans('general.reset_password') }}
                                    </button>                                    
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


    
