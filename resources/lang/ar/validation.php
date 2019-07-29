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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => ' :attribute يجب ان يحتوى  على حروف فقط .',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ' :attribute  المرسل  ليس بريد صالح .',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ' :attribute  يجب ان يكون من نوع صورة  .',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ' :attribute يجب ان يكون رقم صحيح.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ' :attribute يجب ان لا يزيد عن  :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => ' :attribute  يجب ان  لا يزيد عن  :max حرف.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ' :attribute بجب ان لا يقل عن  :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ' :attribute يجب ان لا يقل عن:min حروف.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => ' حقل  :attribute   يجب ان يحتوى على  حروف ومسافات فقط.',
    'required' => 'حقل :attribute   مطلوب.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => ' :attribute يجب  :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => ' :attribute يجب ان يكون حروف.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'ال هذا :attribute    موجود مسبقا.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => ' رابط :attribute رابط غير صالح.',
    'uuid' => 'The :attribute must be a valid UUID.',

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


        'sitePhone1' => [
            'regex' => ':attribute يحب أن يحتوى على ارقام فقط ولا يقل عن 12 حرف',
            'min' => ':attribute يجب أن  لا يقل عن 12 رقم',
            'max' => ':attribute يجب أن  لا يزيد عن 12 رقم!',
        ],

        'sitePhone2' => [
            'regex' => ':attribute يحب أن يحتوى على ارقام فقط ولا يقل عن 12 حرف',
            'min' => ':attribute يجب أن  لا يقل عن 12 رقم',
            'max' => ':attribute يجب أن  لا يزيد عن 12  رقم!',
        ],

        'sitePhone3' => [
            'regex' => ':attribute يحب أن يحتوى على ارقام فقط ولا يقل عن 12 حرف',
            'min' => ':attribute يجب أن  لا يقل عن 12 رقم',
            'max' => ':attribute يجب أن  لا يزيد عن 12 رقم!',
        ],

        'receiverPhone' => [
            'regex' => ':attribute يحب أن يحتوى على ارقام فقط ولا يقل عن 12 حرف',
            'min' => ':attribute يجب أن  لا يقل عن 12 رقم',
            'max' => ':attribute يجب أن  لا يزيد عن 12 رقم!',
        ],
    ],


 

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => ['mail' =>'البريد الالكترونى' ,
                    'name' =>'الاسم'  , 
                    'password' =>'كلمة السر',
                    'question' =>'السؤال',
                    'answer' =>'الجواب',                    
                    'modelName' =>' الموديل',
                    'category' =>'الفئة ',
                    'categoryName'=>'المجموعة',
                    'title1' => 'العنوان الرئيسى ',
                    'title2' => 'العنوان الفرعي',
                    'content' => 'المحتوى ',
                    'sliderImage' => 'الصورة المختارة',
                    'sort'          =>'الترتيب' ,
                    'color'         =>'اللون',
                    'size'          =>'المقاس' ,
                    'receiverName'              =>'اسم المستلم'  ,
                    'receiverPhone'              =>'تليفون المستلم'  ,
                    'country'              =>'البلد'  ,
                    'city'              =>'المحافظة'  ,
                    'town'              =>'المدينة'  ,
                    'address'              =>'العنوان '  ,
                    'startDate'  => 'تاريخ البداية ' ,
                    'endDate'  => 'تاريخ الانتهاء ' ,
                    'percentageValue'  => 'نسبة الخصم',
                    'itemsINsale' =>' المنتجات ',
                    'items'  => ' المنتجات' ,
                    'facebookURL'=>' الفيسبوك',
                    'twitterURL'=>' تويتر',
                    'googlePlusURL'=>' جوجل بلس',
                    'youTubeURL'=>' اليوتيوب' ,
                    'sitePhone1'=> ' التليفون الأساسي',    
                    'sitePhone2'=> ' التليفون الثانى',    
                    'sitePhone3'=> ' التليفون الثالت',    
                    'Email'=> ' الميل',    
                    'status'=> ' الحالة',    
                    'shipperNo'=> ' الموظف',
                    'itemDescription'=> ' وصف المنتج'   ,
                    'materialType1'=> ' نوع القماش الاول' , 
                    'materialType2'=> '  نوع القماش الثانى'  ,
                    'materialRatio1'=> ' نسبة النوع الاول',
                    'materialRatio2'=> ' نسبة النوع الثانى'  ,
                    'quantity'=> '    الكمية '  ,
                    'price'=> '    السعر '  ,
                    'advice'=> ' نصيحة المصمم'  ,
                    'wash'=> ' طريقة الغسل',
                    'image_url'=> ' الصور'  ,
                    'modelNo'=> ' الموديل' ,
                    'itemCode' => ' المنتج'
 
                    ]
// 
];
