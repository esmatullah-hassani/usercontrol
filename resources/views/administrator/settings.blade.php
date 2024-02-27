@extends('layouts.app')

@section('content')
<div class="row">
    @include('administrator.sidebar')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                {{ trans('general.settings') }}
            </div>
            <div class="panel-body">
                @include('layouts.message')
                {!! Form::open(['route' => ['administrator.settings.update'], 'method' => 'put', 'class' =>
                'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('student_number_format') ? ' has-error' : '' }}">
                    {!! Form::label('student_number_format', trans('general.student_number_format'), ['class' =>
                    'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('student_number_format', valueOf('student_number_format'), ['class' =>
                        'form-control format', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('student_number_format'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('student_number_format') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('student_code_format') ? ' has-error' : '' }}">
                    {!! Form::label('student_code_format', trans('general.student_code_format'), ['class' =>
                    'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('student_code_format', valueOf('student_code_format'), ['class' => 'form-control
                        format', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('student_code_format'))
                        <span class="help-block">
                            <strong>{{ $errors->first('student_code_format') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <hr>

                <div class="form-group {{ $errors->has('employee_number_format') ? ' has-error' : '' }}">
                    {!! Form::label('employee_number_format', trans('general.employee_number_format'), ['class' =>
                    'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('employee_number_format', valueOf('employee_number_format'), ['class' =>
                        'form-control format_teacher', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('employee_number_format'))
                            <span class="help-block">
                               <strong>{{ $errors->first('employee_number_format') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group {{ $errors->has('teacher_number_format') ? ' has-error' : '' }}">
                    {!! Form::label('teacher_number_format', trans('general.teacher_number_format'), ['class' =>
                    'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('teacher_number_format', valueOf('teacher_number_format'), ['class' =>
                        'form-control format_teacher', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('teacher_number_format'))
                            <span class="help-block">
                              <strong>{{ $errors->first('teacher_number_format') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                        <h4 class="static-control font-blue">{{ trans('general.new_registration') }}</h4>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('registration_entrance_year') ? ' has-error' : '' }}">
                    {!! Form::label('registration_entrance_year', trans('general.registration_entrance_year'), ['class'
                    => 'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::number('registration_entrance_year', valueOf('registration_entrance_year'), ['class'
                        => 'form-control ltr']) !!}
                        @if ($errors->has('registration_entrance_year'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('registration_entrance_year') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('registration_student_status') ? ' has-error' : '' }}">
                    {!! Form::label('registration_student_status', trans('general.student_status'), ['class' =>
                    'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::select('registration_student_status', $studentStatuses,
                        valueOf('registration_student_status'), ['class' => 'form-control select2', 'placeholder' =>
                        trans('general.select')]) !!}
                        @if ($errors->has('registration_student_status'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('registration_student_status') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>
                
                <hr>
                
                @if (auth()->user()->isDeveloper())
                <hr>
                <div class="form-group {{ $errors->has('scores_approval') ? ' has-error' : '' }}">
                    {!! Form::label('scores_approval', trans('general.scores_approval'), ['class' => 'control-label
                    col-sm-3']) !!}
                    <div class="col-sm-5">
                        <label class="radio-inline">{!! Form::radio('scores_approval', '1', valueOf('scores_approval') ?
                            1 : 0) !!} {{ trans('general.active') }}</label>
                        <label class="radio-inline">{!! Form::radio('scores_approval', '0', valueOf('scores_approval') ?
                            0 : 1) !!} {{ trans('general.inactive') }}</label>
                        @if ($errors->has('scores_approval'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('scores_approval') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>
                @endif
                
                <hr>
                <div class="form-group {{ $errors->has('student_chat_access') ? ' has-error' : '' }}">
                    {!! Form::label('student_chat_access', trans('general.student_chat_access'), ['class' =>
                        'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::select('student_chat_access', array('class'=>__('general.group'),
                           'department'=>__('general.department'),'unlimited'=>__('general.unlimited')), valueOf('student_chat_access'),
                        ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('registration_period'))
                            <span class="help-block">
                               <strong>{{ $errors->first('student_chat_access') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>

                <div class="form-group {{ $errors->has('student_sort_by') ? ' has-error' : '' }}">
                    {!! Form::label('student_sort_by', trans('general.student_sort_by'), ['class' =>
                        'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::select('student_sort_by', array('name_asc'=>__('general.name_asc'),
                           'name_desc'=>__('general.name_desc'),
                           'code_asc'=>__('general.code_asc'),'code_desc'=>__('general.code_desc'),
                           'average_asc'=>__('general.average_asc'),
                           'average_desc'=>__('general.average_desc')), valueOf('student_sort_by'),
                        ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                        @if ($errors->has('student_sort_by'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('student_sort_by') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <label for="card_note" class="control-label col-sm-3">@lang('general.student_card_note')</label>
                    <div class="col-sm-5">
                        <textarea name="student_card_note" id="card_note" cols="30" rows="2" class="form-control">{{$note ? $note->note:''}}</textarea>
                    </div>
                </div>
                <hr>

                <div class="form-group {{ $errors->has('teacher_card_expiration') ? ' has-error' : '' }}">
                    {!! Form::label('teacher_card_expiration', trans('general.teacher_card_expiration'), ['class'
                    => 'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::number('teacher_card_expiration', valueOf('teacher_card_expiration'), ['class'
                        => 'form-control ltr','placeholder'=>__('general.in_months')]) !!}
                        @if ($errors->has('teacher_card_expiration'))
                            <span class="help-block">
                              <strong>{{ $errors->first('teacher_card_expiration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('employee_card_expiration') ? ' has-error' : '' }}">
                    {!! Form::label('employee_card_expiration', trans('general.employee_card_expiration'), ['class'
                    => 'control-label col-sm-3']) !!}
                    <div class="col-sm-5">
                        {!! Form::number('employee_card_expiration', valueOf('employee_card_expiration'), ['class'
                        => 'form-control ltr','placeholder'=>__('general.in_months')]) !!}
                        @if ($errors->has('employee_card_expiration'))
                            <span class="help-block">
                                <strong>{{ $errors->first('employee_card_expiration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
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
<script type="text/javascript">
    $(".format").select2({
        tags: [
            {id: 'entrance_year', text: "{{ trans('general.entrance_year') }}"},
            {id: 'department_code', text: "{{ trans('general.department_code') }}"},
            {id: 'registration_type_code', text: "{{ trans('general.registration_type_code') }}"},
            {id: 'shift_code', text: "{{ trans('general.shift_code') }}"},
            {id: 'grades', text: "{{ trans('general.grades') }}"},
            {id: 'sequence_number', text: "{{ trans('general.sequence_number') }}"}
        ],
        tokenSeparators: [",", " "]
    });


    $(".format_teacher").select2({
        tags: [
            {id: 'sequence_number', text: "{{ trans('general.sequence_number') }}"}
        ],
        tokenSeparators: [",", " "]
    });
</script>
@endpush
