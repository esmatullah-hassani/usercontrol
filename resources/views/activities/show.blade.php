@extends('layouts.app')

@section('content')
        <div class="row">            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.activities') }}  
                        <a class="pull-right btn btn-default btn-xs" href="{{ url('activities') }}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                      
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    {{ trans('general.name') }}: {{ $activity->causer->fullName }}
                                </td>
                                <td>
                                    {{ trans('general.date') }}: <span class="ltr">{{ jalaliDate('Y/n/j H:i:s', strtotime($activity->created_at)) }}</span>
                                </td>
                            </tr>
                            <tr style="direction:ltr">
                                <td>
                                    @if(isset(json_decode($activity->changes)->attributes))
                                    اطلاعات جدید <pre>{{ print_r(json_decode($activity->changes)->attributes) }}</pre>
                                    @endif
                                </td>
                                <td>
                                    @if(isset(json_decode($activity->changes)->old))
                                    اطلاعات قبلی <pre>{{ print_r(json_decode($activity->changes)->old) }}</pre>
                                    @endif
                                </td>
                            </tr>                            
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
@endsection