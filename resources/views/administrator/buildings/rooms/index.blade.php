@extends('layouts.app')

@section('content')
        <div class="row">
            @include('administrator.sidebar')     
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.rooms') }}: {{ $building->title }}                        
                        <a class="pull-right btn btn-default btn-xs" href="{{route('buildings.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>                      
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        <table class="table">
                            <tr>                                
                                <th>{{ trans('general.title') }}</th>                                                               
                                <th>{{ trans('general.actions') }}</th>
                            </tr>
                            @foreach ($building->rooms as $room)
                                <tr>    
                                    <td>{{ $room->title }}</td>                                   
                                    <td>
                                        <a href="{{ route('rooms.edit',['building'=> $building, 'room'=> $room]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> {{ trans("general.edit") }} </a>
                                        <form action="{{  route('rooms.destroy',['room' => $room, 'building' => $building]) }}" method="post" style="display:inline">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-trash"></i> {{ trans("general.delete") }} </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.add_room') }}                  
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['rooms.store', $building], 'method' => 'post', 'class' => 'form-horizontal']) !!}                                            
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', trans('general.title'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}     
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>
                            <hr>                         
                            <div class="form-group"> 
                                <div class="col-sm-offset-4 col-sm-4">
                                     <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
