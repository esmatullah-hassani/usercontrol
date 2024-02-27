@extends('layouts.app')

@section('content')
        <div class="row">
            @include('developer.sidebar')
            <div class="col-md-8">
                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('general.percentage')." ".trans("general.competency_exam")}}                        
                    </div>
                    <h5 style="color:blue;">در صورت ذخیره کردن قیمت برای فیصدی امتحان لیاقت سیستم شاگردان که امتحان لیاقت میدهد فیصدی شان را برسی میکند !</h5>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['system.competency.update'], 'method' => 'put',  'class' => 'form-horizontal']) !!}                            
                            <div class="form-group {{ $errors->has('competency') ? ' has-error' : '' }}">
                                {!! Form::label('competency', trans('general.percentage')." ".trans("general.competency_exam"), ['class' => 'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('competency', systemCompetency(), ['class' => 'form-control']) !!}     
                                    @if ($errors->has('competency'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('competency') }}</strong>
                                        </span>
                                    @endif                                                                                                   
                                </div>
                            </div>


                            <div class="form-group"> 
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                
            </div>
        </div>
@endsection

