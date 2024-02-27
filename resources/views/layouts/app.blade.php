<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html @if (app()->getLocale() == 'da' || app()->getLocale() =='pa') lang="fa" dir="rtl" @else lang="en" dir="ltr" @endif>
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ systemName() }}</title>
        <!-- <title>{{ config('app.name', 'Sib') }}</title> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <link rel="icon" type="image/png" href="{!! systemLogoUrl() !!}">
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        @if(app()->getLocale() != 'en')
        <!-- {{-- Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') --}} -->
        {!! Html::style('css/all.css') !!}
        {!! Html::style('css/themes/darkblue-rtl.min.css') !!}
        @else
            {!! Html::style('assets/all.css') !!}
            {!! Html::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
            {!! Html::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
            {!! Html::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
            {!! Html::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
            {!! Html::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
            {!! Html::style('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') !!}
            {!! Html::style('assets/global/css/components.min.css') !!}
            {!! Html::style('assets/global/css/plugins.min.css') !!}
            {!! Html::style('assets/layouts/layout/css/layout.min.css') !!}
            {!! Html::style('assets/layouts/layout/css/themes/darkblue.min.css') !!}
            {!! Html::style('assets/layouts/layout/css/custom.min.css') !!}

        @endif
            @stack('styles')
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>

            window.LoginPage = "<?php echo url('/login'); ?>"
            window.BaseUrl = "<?php echo url(''); ?>"
            window.SelectText = "{{ trans('general.select') }}"
        </script>

        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107354365-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments)};
          gtag('js', new Date());

          gtag('config', 'UA-107354365-1');
        </script>

        @if(app()->getLocale() != 'en')
        <style type="text/css">
            .nazanin {
                font-family: nazanin;
            }
            .deleted-record {
                opacity: 0.5;
            }

            .table-responsive{
                overflow-y: scroll !important;
            }
        </style>
        @endif

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <!-- <link href="../assets/global/css/components-rounded-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" /> -->
        <!-- <link href="../assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- <link href="../assets/layouts/layout/css/layout-rtl.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="../assets/layouts/layout/css/themes/darkblue-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" /> -->
        <!-- <link href="../assets/layouts/layout/css/custom-rtl.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- END THEME LAYOUT STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.ico" /> -->
    </head> 
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-sidebar-fixed">
        <!-- BEGIN HEADER -->
        @include('layouts.navbar')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('layouts.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- <h3 class="page-title"> Blank Page Layout
                        <small>blank page layout</small>
                    </h3> -->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->

                    <!-- for upgrade purpose -->
                    <div id="update_notification" style="display:none;" class="alert alert-info">
                        <button type="button" style="margin-left: 20px" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 

                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <!-- @ include('layouts.quickSidebar') -->
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                {{ date('Y') }} &copy; توسعه نرم افزار <a href="http://rubik.af" title="روبیک" target="_blank">روبیک</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
       {{-- @if(app()->getLocale() !='en')--}}
        <!-- Scripts -->
        {!! Html::script('js/all.js') !!}
       {{-- @else
            {!! Html::script('js/all.js') !!}
            {!! Html::script('assets/global/plugins/jquery.min.js') !!}
            {!! Html::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
            {!! Html::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
            {!! Html::script('assets/global/plugins/jquery.blockui.min.js') !!}
            {!! Html::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
            {!! Html::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
            {!! Html::script('assets/global/plugins/moment.min.js') !!}
            --}}{{--gap--}}{{--


            {!! Html::script('assets/global/scripts/app.min.js') !!}
            {!! Html::script('assets/pages/scripts/dashboard.min.js') !!}
            {!! Html::script('assets/layouts/layout/scripts/layout.min.js') !!}
            {!! Html::script('assets/layouts/layout/scripts/demo.min.js') !!}
            {!! Html::script('assets/layouts/global/scripts/quick-sidebar.min.js') !!}
        @endif--}}
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

            $(document).ready(function () {
                $('body').on('focus','.date-picker-shamsi',function () {
                    $(this).persianDatepicker(
                        {
                            months: ["حمل", "ثور", "جوزا", "سرطان", "اسد", "سنبله", "میزان", "عقرب", "قوس", "جدی", "دلو", "حوت"]}
                    );
                })
            })
        </script>


        <script>
            $(document).ready(function() {  
                $.ajax({
                    type: 'GET',   
                    url: 'updater.check',
                    async: false,
                    success: function(response) {
                        if(response != ''){
                            
                        }
                    }
                });
            });
        </script>

    </body>

</html>