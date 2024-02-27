<div class="col-md-3">
    <div class="panel panel-default">
    	<div class="panel-heading">{{ trans('general.administrator_settings') }}</div>
        <div class="panel-body" style="padding:0 ">        	
            <ul class="nav nav-pills nav-stacked" style="margin-bottom:0">               
                <li class="@if (request()->segment(2) == 'departments') active @endif" ><a href="{{ route('departments.index') }}">{{ trans('general.departments') }}</a></li>                
                <li class="@if (request()->segment(2) == 'registrationTypes') active @endif" ><a href="{{ route('registrationTypes.index') }}">{{ trans('general.registration_types') }}</a></li>
                <li class="@if (request()->segment(2) == 'registrationPeriods') active @endif" ><a href="{{ route('registrationPeriods.index') }}">{{ trans('general.registration_periods') }}</a></li>
                <li class="@if (request()->segment(2) == 'shifts') active @endif" ><a href="{{ route('shifts.index') }}">{{ trans('general.shifts') }}</a></li>
                <li class="@if (request()->segment(2) == 'semesters') active @endif" ><a href="{{ route('semesters.index') }}">{{ trans('general.semesters') }}</a></li>
                <li class="@if (request()->segment(2) == 'studentCategories') active @endif" ><a href="{{ route('studentCategories.index') }}">{{ trans('general.student_categories') }}</a></li>
                <li class="@if (request()->segment(2) == 'studentStatuses') active @endif" ><a href="{{ route('studentStatuses.index') }}">{{ trans('general.student_statuses') }}</a></li>                
                <li class="@if (request()->segment(2) == 'courseTypes') active @endif" ><a href="{{ route('courseTypes.index') }}">{{ trans('general.course_types') }}</a></li>
                <li class="@if (request()->segment(2) == 'buildings') active @endif" ><a href="{{ route('buildings.index') }}">{{ trans('general.buildings_and_rooms') }}</a></li>
                <li class="@if (request()->segment(2) == 'contacts') active @endif" ><a href="{{ route('contacts.index') }}">{{ trans('general.messenger_contacts') }}</a></li>
                <li class="@if (request()->segment(2) == 'slides') active @endif" ><a href="{{ route('login.slides') }}">{{ trans('general.login_slides') }}</a></li>
                <li class="@if (request()->segment(2) == 'categories') active @endif" ><a href="{{ route('categories.index') }}">{{ trans('general.categories') }}</a></li>                
                <li class="@if (request()->segment(2) == 'settings') active @endif" ><a href="{{ route('administrator.settings.index') }}">{{ trans('general.settings') }}</a></li>                
            </ul>                   
        </div>
    </div>
</div>
