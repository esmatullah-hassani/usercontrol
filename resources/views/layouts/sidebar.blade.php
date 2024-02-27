<div class="page-sidebar-wrapper"  >
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse" style="background-color: <? echo getSidebarColor(); ?>;">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"></div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper" style="text-align:center">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <div style="background-color: white;border-radius: 54px 54px 54px 54px !important;-webkit-border-radius: 54px 54px 54px 54px !important;margin: 20px 60px;padding: 5px 4px;">
                    {!! systemLogo(['style' => 'max-height: 100px; border-radius: 54px 54px 54px 54px !important;']) !!}

                </div>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

            <li class="heading">
                <h3 class="font-white nazanin" style="margin:0;" align="center" >{{ systemName() }}</h3>
            </li>

        <!-- <li class="nav-item @if(request()->segment(1) == 'registration') active @endif">
                <a href="{{ url('registration') }}" class="nav-link">
                    <i class="icon-pencil"></i>
                    <span class="title">{{ trans('general.registration') }}</span>
                </a>
            </li> -->

           

            @permission('users.*')
            <li class="nav-item @if(request()->segment(1) == 'users' or request()->segment(1) == 'activities' or request()->segment(1) == 'onlineUsers') active @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{ trans('general.users') }}</span>
                    <span class="arrow @if(request()->segment(1) == 'users' or request()->segment(1) == 'activities' or request()->segment(1) == 'onlineUsers') open @endif"></span>
                </a>
                <ul class="sub-menu">
                    
                    <li class="nav-item start @if(request()->segment(1) == 'users') active @endif">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <span class="title">{{ trans('general.users_list') }}</span>
                        </a>
                    </li>
                   
                </ul>
            </li>
            @endpermission
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
