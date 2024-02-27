<!DOCTYPE html>
<html  @if (app()->isLocale('da')) lang="fa" dir="rtl" @else lang="en" @endif >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sib') }}</title>

    <!-- Styles -->
    <!-- {{-- Html::style('https://fonts.googleapis.com/css?family=Raleway:300,400,600') --}} -->
    {!! Html::style('css/all.css') !!}    
    
    @stack('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        window.BaseUrl = "<?php echo url(''); ?>"
        window.SelectText = "{{ trans('general.select') }}"
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {!! teamLogo(null, ['style' => 'max-width:40px;margin-top:-10px']) !!}                        
                    </a>
                    <h4 class="pull-left" style="margin-top:15px;font-family:nazanin">{{ systemName() }}</h4>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">                   
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->                        
                        <li><a href="javascript:;">{{ jalaliDate('l j F Y') }}</a></li>                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-top: 70px;">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    {!! Html::script('js/all.js') !!}
    <div>
        @yield('script_code')
    </div>
    
    @stack('scripts')
    <script type="text/javascript">
        function doConfirm()
        {
            if (! confirm("{{ trans('general.do_you_want_to_proceed') }}")) {
                event.preventDefault();
                return false;
            }                
            return true;
        }        
    </script>
</body>
</html>