<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('general.system') }}</div>
        <div class="panel-body" style="padding:0 ">
            <ul class="nav nav-pills nav-stacked" style="margin-bottom:0">
                <li class="@if (request()->segment(2) == 'roles' or request()->segment(2) == 'rolePermissions') active @endif"><a  href="{{ route('roles.index') }}"> {{ trans('general.roles') }} </a></li>                
               
            </ul>                   
        </div>
    </div>
</div>
