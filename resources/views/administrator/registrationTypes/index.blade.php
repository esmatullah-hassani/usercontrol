@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')     
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.registration_types') }}                        
                        <a class="pull-right btn btn-primary btn-xs" href="{{route('registrationTypes.create')}}" >
                            <i class="fa fa-plus"></i> {{ trans('general.add') }}
                        </a>                        
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
