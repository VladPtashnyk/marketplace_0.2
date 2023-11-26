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

    'accepted' => 'Поле :attribute повинно бути прийняте.',
    'accepted_if' => 'Поле :attribute повинно бути прийняте, коли :other є :value.',
    'active_url' => 'Поле :attribute повинно бути дійсним URL.',
    'after' => 'Поле :attribute повинно бути датою після :date.',
    'after_or_equal' => 'Поле :attribute повинно бути датою після або рівним :date.',
    'alpha' => 'Поле :attribute може містити лише літери.',
    'alpha_dash' => 'Поле :attribute може містити лише літери, цифри, дефіси і підкреслення.',
    'alpha_num' => 'Поле :attribute може містити лише літери і цифри.',
    'array' => 'Поле :attribute повинно бути масивом.',
    'ascii' => 'Поле :attribute може містити лише однобайтові буквено-цифрові символи і символи.',
    'before' => 'Поле :attribute повинно бути датою до :date.',
    'before_or_equal' => 'Поле :attribute повинно бути датою до або рівним :date.',
    'between' => [
        'array' => 'Поле :attribute повинно містити від :min до :max елементів.',
        'file' => 'Поле :attribute повинно бути від :min до :max кілобайтів.',
        'numeric' => 'Поле :attribute повинно бути від :min до :max.',
        'string' => 'Поле :attribute повинно містити від :min до :max символів.',
    ],
    'boolean' => 'Поле :attribute повинно бути true або false.',
    'confirmed' => 'Підтвердження поля :attribute не збігається.',
    'current_password' => 'Пароль невірний.',
    'date' => 'Поле :attribute повинно бути дійсною датою.',
    'date_equals' => 'Поле :attribute повинно бути датою, рівною :date.',
    'date_format' => 'Поле :attribute повинно відповідати формату :format.',
    'decimal' => 'Поле :attribute повинно мати :decimal десяткових знаків.',
    'declined' => 'Поле :attribute повинно бути відхилене.',
    'declined_if' => 'Поле :attribute повинно бути відхилене, коли :other є :value.',
    'different' => 'Поля :attribute і :other повинні бути різними.',
    'digits' => 'Поле :attribute повинно бути :digits цифр.',
    'digits_between' => 'Поле :attribute повинно бути від :min до :max цифр.',
    'dimensions' => 'Поле :attribute має недійсні розміри зображення.',
    'distinct' => 'Поле :attribute має значення, яке дублює інше поле.',
    'doesnt_end_with' => 'Поле :attribute не може закінчуватися одним з наступних значень: :values.',
    'doesnt_start_with' => 'Поле :attribute не може починатися з одного з наступних значень: :values.',
    'email' => 'Поле :attribute повинно бути дійсною адресою електронної пошти.',
    'ends_with' => 'Поле :attribute повинно закінчуватися одним з наступних значень: :values.',
    'enum' => 'Вибране значення :attribute є недійсним.',
    'exists' => 'Вибране значення :attribute є недійсним.',
    'file' => 'Поле :attribute повинно бути файлом.',
    'filled' => 'Поле :attribute повинно мати значення.',
    'gt' => [
        'array' => 'Поле :attribute повинно мати більше :value елементів.',
        'file' => 'Поле :attribute повинно бути більше :value кілобайтів.',
        'numeric' => 'Поле :attribute повинно бути більше :value.',
        'string' => 'Поле :attribute повинно бути більше :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute повинно мати :value елементів або більше.',
        'file' => 'Поле :attribute повинно бути більше або рівним :value кілобайтам.',
        'numeric' => 'Поле :attribute повинно бути більше або рівним :value.',
        'string' => 'Поле :attribute повинно бути більше або рівним :value символам.',
    ],
    'image' => 'Поле :attribute повинно бути зображенням.',
    'in' => 'Вибране значення :attribute є недійсним.',
    'in_array' => 'Поле :attribute не існує в :other.',
    'integer' => 'Поле :attribute повинно бути цілим числом.',
    'ip' => 'Поле :attribute повинно бути дійсною IP-адресою.',
    'ipv4' => 'Поле :attribute повинно бути дійсною адресою IPv4.',
    'ipv6' => 'Поле :attribute повинно бути дійсною адресою IPv6.',
    'json' => 'Поле :attribute повинно бути дійсним рядком JSON.',
    'lowercase' => 'Поле :attribute повинно бути у нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute повинно мати менше :value елементів.',
        'file' => 'Поле :attribute повинно бути менше :value кілобайтів.',
        'numeric' => 'Поле :attribute повинно бути менше :value.',
        'string' => 'Поле :attribute повинно бути менше :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute не повинно мати більше :value елементів.',
        'file' => 'Поле :attribute повинно бути менше або рівним :value кілобайтам.',
        'numeric' => 'Поле :attribute повинно бути менше або рівним :value.',
        'string' => 'Поле :attribute повинно бути менше або рівним :value символам.',
    ],
    'mac_address' => 'Поле :attribute повинно бути дійсною MAC-адресою.',
    'max' => [
        'array' => 'Поле :attribute не повинно мати більше :max елементів.',
        'file' => 'Поле :attribute не повинно бути більше :max кілобайтів.',
        'numeric' => 'Поле :attribute не повинно бути більше :max.',
        'string' => 'Поле :attribute не повинно бути більше :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно мати більше :max цифр.',
    'mimes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'mimetypes' => 'Поле :attribute повинно бути файлом типу: :values.',
    'min' => [
        'array' => 'Поле :attribute повинно мати щонайменше :min елементів.',
        'file' => 'Поле :attribute повинно бути щонайменше :min кілобайтів.',
        'numeric' => 'Поле :attribute повинно бути щонайменше :min.',
        'string' => 'Поле :attribute повинно бути щонайменше :min символів.',
    ],
    'min_digits' => 'Поле :attribute повинно мати щонайменше :min цифр.',
    'missing' => 'Поле :attribute повинно бути відсутнім.',
    'missing_if' => 'Поле :attribute повинно бути відсутнім, коли :other є :value.',
    'missing_unless' => 'Поле :attribute повинно бути відсутнім, якщо :other не є :value.',
    'missing_with' => 'Поле :attribute повинно бути відсутнім, коли :values присутні.',
    'missing_with_all' => 'Поле :attribute повинно бути відсутнім, коли присутні всі :values.',
    'multiple_of' => 'Поле :attribute повинно бути кратним :value.',
    'not_in' => 'Вибране значення :attribute є недійсним.',
    'not_regex' => 'Формат поля :attribute недійсний.',
    'numeric' => 'Поле :attribute повинно бути числом.',
    'password' => [
        'letters' => 'Поле :attribute повинно містити щонайменше одну літеру.',
        'mixed' => 'Поле :attribute повинно містити щонайменше одну прописну та одну строчну літеру.',
        'numbers' => 'Поле :attribute повинно містити щонайменше одну цифру.',
        'symbols' => 'Поле :attribute повинно містити щонайменше один символ.',
        'uncompromised' => 'Вказане значення :attribute з\'явилося в витоку даних. Будь ласка, виберіть інше значення :attribute.',
    ],
    'present' => 'Поле :attribute повинно бути присутнім.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, коли :other є :value.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не є в :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Формат поля :attribute недійсний.',
    'required' => 'Поле :attribute є обов\'язковим для заповнення.',
    'required_array_keys' => 'Поле :attribute повинно містити записи для: :values.',
    'required_if' => 'Поле :attribute є обов\'язковим, коли :other є :value.',
    'required_if_accepted' => 'Поле :attribute є обов\'язковим, коли :other прийнято.',
    'required_unless' => 'Поле :attribute обов\'язкове, якщо :other не є в :values.',
    'required_with' => 'Поле :attribute обов\'язкове, коли присутній :values.',
    'required_with_all' => 'Поле :attribute обов\'язкове, коли присутні всі значення :values.',
    'required_without' => 'Поле :attribute обов\'язкове, коли :values відсутні.',
    'required_without_all' => 'Поле :attribute обов\'язкове, коли відсутні всі значення :values.',
    'same' => 'Поле :attribute повинно збігатися з :other.',
    'size' => [
        'array' => 'Поле :attribute повинно містити :size елементів.',
        'file' => 'Поле :attribute повинно бути розміром :size кілобайт.',
        'numeric' => 'Поле :attribute повинно бути :size.',
        'string' => 'Поле :attribute повинно містити :size символів.',
    ],
    'starts_with' => 'Поле :attribute повинно починатися одним із наступних значень: :values.',
    'string' => ':attribute обов\'язковий для заповнення.',
    'timezone' => 'Поле :attribute повинно бути коректною часовою зоною.',
    'unique' => ':attribute вже існує.',
    'uploaded' => 'Не вдалося завантажити :attribute.',
    'uppercase' => 'Поле :attribute повинно бути великими літерами.',
    'url' => 'Поле :attribute повинно бути коректним URL.',
    'ulid' => 'Поле :attribute повинно бути коректним ULID.',
    'uuid' => 'Поле :attribute повинно бути коректним UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
