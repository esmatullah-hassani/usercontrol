<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => ':attribute یکسان نیست.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'فیلد :attribute باید :digits عدد باشد.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ' :attribute صحیح نمی باشد.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'فیلد :attribute نباید بیشتر از :max باشد.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'فیلد :attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ' :attribute باید یکی از فرمت های: :values باشد.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'فیلد :attribute حداقل باید :min باشد.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'فیلد :attribute الزامی می باشد.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'فیلد :attribute الزامی است در صورتی که فیلد :values انتخاب نشده باشد.',
    'required_without_all' => 'فیلد :attribute الزامی است در صورتی که فیلد های :values انتخاب نشده باشند.',
    'same'                 => ' :attribute و :other یکسان نیست.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => ' :attribute باید کمتر از <span class="ltr">:size kilobytes</span> باشد.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attribute قبلا ثبت شده است.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',
    "match_password" => "کلمه عبور فعلی اشتباه است.",
    "unique_seat_number" => "شماره چوکی قبلا ثبت شده است.",
    'valid_score' => 'مجموع نمرات باید بین 0 تا 100 باشد.',
    'valid_schedule' => 'انتخاب واحد مجاز به تایید نمی باشد.',
    'student_has_schedule' => 'انتخاب واحد برای سمستر انتخاب شده موجود نیست.',
    'valid_date_range' => 'بازه زمانی انتخاب شده معتبر نمی باشد.',
    'score_exists' => 'برای این مضمون نمره کامیابی ثبت شده است.',
    'valid_sessions' => 'مجموع جلسات تدریس شده این صنف از حد مجاز بیشتر است.',
    'valid_direct_subject' => 'تعداد واحد های معرفی به استاد از تعداد مجاز بیشتر است.',
    'valid_total_credits' => 'تعداد کریدت ها از حد مجاز(۲۴ کریدت در یک سمستر) بیشتر است.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],    

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'نام',
        'last_name' => 'تخصلص ',
        'id_card' => 'آیدی کارت',
             
    ],    
];
