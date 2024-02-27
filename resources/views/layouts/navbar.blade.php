<div class="page-header navbar navbar-fixed-top" style="background-color: <? echo getMenuebarColor(); ?>;">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="" target="new">
                <img src="" alt="logo" style="max-height: 40px;margin: 3px 20px;" class="logo-default">
            </a>
            <div class="menu-toggler sidebar-toggler" > 
                <i class="fa fa-bars" style="font-size: 22px;color:white"></i>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li><a href="javascript:;" class="font-white" style="background: initial !important">{{ jalaliDate('l j F') }}، {{trans('general.year')}} {{ jalaliDate('Y') }}</a></li>
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                @if (auth()->user())
                 <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    
                </li>


                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle font-white" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        @lang('general.'.auth()->user()->locale)
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <a href="javascript:;" >@lang('general.select')&nbsp;@lang('general.language')</a>
                        </li>
                        <li>
                            <a href="{{ route('lang.set',['lang'=>'en']) }}" @if(app()->getLocale()==null  || app()->getLocale() =='en') class="text-primary" @endif>@lang('general.english')</a>
                        </li>
                        <li>
                            <a href="{{ route('lang.set',['lang'=>'da']) }}" @if(app()->getLocale() =='da') class="text-primary" @endif>@lang('general.dari')</a>
                        </li>
                        <li>
                            <a href="{{ route('lang.set',['lang'=>'pa']) }}" @if(app()->getLocale() == 'pa') class="text-primary" @endif>@lang('general.pashtu')</a>
                        </li>
                    </ul>
                </li>

                @endif
                <!-- END INBOX DROPDOWN -->
               
               
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                @if (auth()->user())
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!-- <img alt="" class="img-circle" src="/saas-metronic/public/img/avatar3_small.jpg" /> -->
                        {!! userPhoto(auth()->user(), ['class' => 'img-circle']) !!}
                        <span class="username username-hide-on-mobile"> {{ Auth()->user()->fullName }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        

                        @if(auth()->user()->isDeveloper() or auth()->user()->mayAdministrator() or auth()->user()->may('finance.administrator'))
                        <li class="divider"></li>
                        <li class="dropdown-header"> <i class="icon-user"></i> {{ trans('general.administrator') }}</li>                                
                        @endif

                        
                        @if(auth()->user()->isDeveloper())                        
                        <li>                                            
                            <a href="{{ route('roles.index') }}"> {{ trans('general.system_administrator') }} </a>
                        </li>
                        @endif
                        @if(auth()->user()->isImpersonator())                            
                        <li class="divider"></li>
                        <li>                                                                          
                            <a href="{{ route('impersonate.stop') }}"><i class="fa fa-sign-out"></i>{{ trans('general.stop_impersonating') }} </a>
                        </li>                                                                
                        @endif
                        <li>                                        
                            <a href="javascript:;"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-lock"></i> {{ trans('general.logout') }}
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!-- <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li> -->
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>