<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ systemName() }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="icon" type="image/png" href="{!! systemLogoUrl() !!}">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- {{-- Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') --}} -->
        {!! Html::style('css/all.css') !!}    
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!! Html::style('css/login-rtl.min.css') !!}            
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES --> 
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>

            window.BaseUrl = "<?php echo url(''); ?>"
            window.SelectText = "{{ trans('general.select') }}"
        </script>
        <style>
            body{
                margin-top: 0px;
            }
            h1, h3 {
                font-family: nazanin;
            }
            .user-login-5 .login-container>.login-content {
                margin-top: 10%;
            }
            .progress {
                margin-top: -28px;
            }
        </style>       
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        @yield('content')
        <!-- END : LOGIN PAGE 5-2 -->
        {!! Html::script('js/all.js') !!}
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! Html::script('vendor/backstretch/jquery.backstretch.min.js') !!}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script type="text/javascript">
            // init background slide images
            $('.login-bg').backstretch([
                @if(Storage::exists("/public/".config('client')."/first_slide.jpg"))
                    "{{ asset('/storage/'.config('client').'/first_slide.jpg') }}",
                @else
                    "{{ asset('images/login/bg1.jpg') }}",
                @endif

                @if(Storage::exists("/public/".config('client')."/second_slide.jpg"))
                    "{{ asset('/storage/'.config('client').'/second_slide.jpg') }}",
                @else
                    "{{ asset('images/login/bg2.jpg') }}",
                @endif

                @if(Storage::exists("/public/".config('client')."/third_slide.jpg"))
                    "{{ asset('/storage/'.config('client').'/third_slide.jpg') }}"
                @else
                    "{{ asset('images/login/bg3.jpg') }}"
                @endif                
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );
        </script>

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
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>