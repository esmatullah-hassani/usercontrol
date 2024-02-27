@extends('layouts.app')

@section('content')
<div class="row">            
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <h3>{{ $user->name . " ".$user->last_name." "}}{{ trans('general.welcome') }}</h3>
                </div>
            </div>
        </div>
</div>

@endsection