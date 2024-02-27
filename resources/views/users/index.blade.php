@extends('layouts.app')

@section('content')
        <div class="row">            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.users') }}
                        @permission('users.create')
                        <a class="pull-right btn btn-primary btn-xs" href="{{route('users.create')}}" >
                            <i class="fa fa-plus"></i> {{ trans('general.add_user') }}
                        </a>
                        @endpermission
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! $dataTable->table([],true) !!}
                    </div>
                </div>
            </div>
        </div>    
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
