<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet ">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
        	<a href="">
    			{!! userPhoto($user, ['class' => 'img-responsive']) !!}				      		
	      	</a>            
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ $user->fullName }}</div>
            <br>{{ trans('general.user_account') }} @if ($user->active) <span class='badge badge-success'>{{ trans('general.active') }}</span> @else <span class='badge badge-danger'>{{ trans('general.inactive') }}</span> @endif</p>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <!-- <div class="profile-userbuttons">
            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
            <button type="button" class="btn btn-circle red btn-sm">Message</button>
        </div> -->
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
            	<li class="@if (request()->url() == route('users.show', $user) OR request()->url() == route('users.edit', $user)) active @endif" >
            		<a href="{{ route('users.show', $user) }}">{{ trans('general.user_details') }}</a>
            	</li>
                @permission('users.update')
                <li class="@if (request()->url() == route('users.roles.edit', $user)) active @endif" >
                	<a href="{{ route('users.roles.edit', $user) }}">{{ trans('general.roles') }}</a>
                </li>
                @endpermission
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
</div>
