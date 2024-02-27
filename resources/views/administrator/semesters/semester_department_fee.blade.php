@extends('layouts.app')
@push('styles')
    <style>
        h4.intercept-4f{
            font-family: nazanin;
            color: #4CAF50;
            font-size: 17px;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ trans('general.fees') }} {{$semester->title}}
                        <a class="pull-right btn btn-default btn-xs" href="{{route('semesters.index')}}" >
                            <i class="fa fa-arrow-left"></i> {{ trans('general.back') }}
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('layouts.message')
                        {!! Form::open(['route' => 'semester.department.fees.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                          <input type="hidden" name="semester_id" value="{{$semester->id}}"/>


                            <table class="table">
                              <thead>
                                <tr>
                                  <th>@lang('general.department')</th>
                                  <th>@lang('general.fees')</th>
                                  <th>@lang('general.fees')/ @lang('general.female')</th>
                                </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td colspan="3" >
                                      <h4 class="intercept-4f">@lang('general.fix_fees')</h4>
                                  </td>
                              </tr>
                                @foreach($department AS $record)
                                <tr>
                                  <td>{{$record['title']}}
                                    <input type="hidden" name="department_id[]" value="{{$record['id']}}"/>
                                  </td>
                                  <td>
                                    <input type="number" name="fees[]" value="{{$record['fees']}}" class="form-control" placeholder="@lang('general.male')"/>

                                  </td>
                                  <td>
                                    <input type="number" name="female_fees[]" value="{{$record['female_fees']}}" class="form-control" placeholder="@lang('general.female')"/>
                                  </td>
                                </tr>
                                @endforeach
                              <tr>
                                  <td colspan="3" >
                                     <h4 class="intercept-4f"> @lang('general.credit_fees')</h4>
                                  </td>
                              </tr>

                              @foreach($department AS $record)
                                  <tr>
                                      <td>
                                          {{$record['title']}}
                                      </td>
                                      <td>
                                          <input type="number" name="credit_fees[]" value="{{$record['credit_fees']}}" class="form-control" placeholder="@lang('general.male')"/>

                                      </td>
                                      <td>
                                          <input type="number" name="female_credit_fees[]" value="{{$record['female_credit_fees']}}" class="form-control" placeholder="@lang('general.female')"/>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                            </table>

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
