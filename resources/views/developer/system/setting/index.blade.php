@extends('layouts.app')

@section('content')
        <div class="row">
            @include('developer.sidebar')
            <div class="col-md-8">
                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('general.settings') !!}                        
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['system.settings.update'], 'method' => 'put',  'class' => 'form-horizontal']) !!}                            
                        
                            <div class="form-group">
                                {!! Form::label('menubar_color', trans('general.menubar_color'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    <select class="form-control" name="menubar_color">
                                        <option value="#00a7b6">{{trans("general.default")}}</option>
                                        <option style='display:block;width:50px;height:20px;background:#10B981;' value="#10B981" {{ ("#10B981" == getMenuebarColor() ? "selected":"") }}>10B981</option>
                                        <option style='display:block;width:50px;height:20px;background:#059669;' value="#059669" {{ ('#059669' == getMenuebarColor() ? "selected":"") }}>059669</option>
                                        <option style='display:block;width:50px;height:20px;background:#065F46;' value="#065F46" {{ ("#065F46" == getMenuebarColor() ? "selected":"") }}>059669</option>
                                        <option style='display:block;width:50px;height:20px;background:#4B5563;' value="#4B5563" {{ ("#4B5563" == getMenuebarColor() ? "selected":"") }}>4B5563</option>
                                        <option style='display:block;width:50px;height:20px;background:#6B7280;' value="#6B7280" {{ ("#6B7280" == getMenuebarColor() ? "selected":"") }}>6B7280</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('sidebar_color', trans('general.sidebar_color'), ['class' => 'control-label col-sm-4']) !!}                                
                                <div class="col-sm-5">
                                    <select class="form-control" name="sidebar_color">
                                        <option value="#2b3643">{{trans("general.default")}}</option>
                                        <option style='display:block;width:50px;height:20px;background:#E5E7EB;' value="#E5E7EB" {{ ("#E5E7EB" == getSidebarColor() ? "selected":"") }}>E5E7EB</option>
                                        <option style='display:block;width:50px;height:20px;background:#D1D5DB;' value="#D1D5DB" {{ ('#D1D5DB' == getSidebarColor() ? "selected":"") }}>D1D5DB</option>
                                        <option style='display:block;width:50px;height:20px;background:#9CA3AF;' value="#9CA3AF" {{ ("#9CA3AF" == getSidebarColor() ? "selected":"") }}>9CA3AF</option>
                                        <option style='display:block;width:50px;height:20px;background:#6B7280;' value="#6B7280" {{ ("#6B7280" == getSidebarColor() ? "selected":"") }}>6B7280</option>
                                        <option style='display:block;width:50px;height:20px;background:#A3A3A3;' value="#A3A3A3" {{ ("#A3A3A3" == getSidebarColor() ? "selected":"") }}>A3A3A3</option>
                                    </select>
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
@push('scripts')
    {!! Html::script('js/pwstrength-bootstrap.min.js') !!}

<script>
    
    $("#menubar_default").change(function(e){
        if($("#menubar_default").is(":checked")){
            $("#system_menubar_color").css('display','none');
        }
        else{
            $("#system_menubar_color").css('display','block');
        }
    });

    $("#sidebar_default").change(function(e){
        if($("#sidebar_default").is(":checked")){
            $("#system_sidebar_color").css('display','none');
        }
        else{
            $("#system_sidebar_color").css('display','block');
        }
    });
</script>
@endpush
