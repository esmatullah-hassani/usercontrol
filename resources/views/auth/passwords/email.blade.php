@extends('layouts.auth')

@section('content')
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-4 login-container bs-reset">                    
                    <div class="login-content text-center">
                        {!! systemLogo(['class' => 'login-6', 'style' => 'max-height:160px']) !!}
                        <h1>{!! systemName() !!}</h1>
                        <h3> {{ trans('general.reset_password') }} </h3>
                        <form class="login-form" role="form" method="POST" action="{{ url('/password/email') }}">                                              
                            {{ csrf_field() }}                        
                            
                            <p> {{ trans('general.please_enter_your_x', ['x' => trans('general.email_address')]) }}  </p>
                            @if (session('status'))
                                <div class="alert col-sx-12 col-md-8 col-md-offset-2 alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-md-offset-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="form-control placeholder-no-fix ltr" type="text" autocomplete="off" placeholder="{{ trans('general.email_address') }}" name="email" required autofocus /> 
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-md-offset-2 text-left">                                                                  
                                    <a type="button" id="back-btn" href="{{ url('login') }}" class="btn grey btn-default"> {{ trans('general.back') }}</a>
                                </div>
                                <div class="col-xs-6 col-md-4 ">
                                    <button type="submit" class="btn blue btn-success pull-right">{{ trans('general.send') }}</button>
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