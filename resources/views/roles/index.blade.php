@extends('layouts.app')

@section('content')
        <div class="row">       
            @include('developer.sidebar')     
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading clearfix">
                        {{ trans('general.roles') }}
                        <a class="pull-right btn btn-primary btn-xs" href="{{route('roles.create')}}" >
                            <i class="fa fa-plus"></i> {{ trans('general.add_role') }}
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
