<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'accepted_if' => ':attribute musi zostać zaakceptowany, gdy :other ma wartość :value.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być datą późniejszą niż :date.',
    'after_or_equal' => ':attribute musi być datą nie wcześniejszą niż :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => ':attribute może zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'ascii' => ':attribute może zawierać tylko jednobajtowe znaki alfanumeryczne i symbole.',
    'before' => ':attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => ':attribute musi być datą nie późniejszą niż :date.',
    'between' => array(
        'array' => ':attribute musi mieć od :min do :max elementów.',
        'file' => ':attribute musi mieć od :min do :max kilobajtów.',
        'numeric' => ':attribute musi mieć wartość od :min do :max.',
        'string' => ':attribute musi mieć od :min do :max znaków.',
    ),
    'boolean' => 'Pole :attribute musi być prawdą lub fałszem.',
    'confirmed' => 'Potwierdzenie :attribute nie pasuje.',
    'current_password' => 'Hasło jest nieprawidłowe.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie pasuje do formatu :format.',
    'decimal' => ':attribute musi mieć :decimal miejsc dziesiętnych.',
    'declined' => ':attribute musi zostać odrzucony.',
    'declined_if' => ':attribute musi zostać odrzucony, gdy :other ma wartość :value.',
    'different' => ':attribute i :other muszą się różnić.',
    'digits' => ':attribute musi składać się z :digits cyfr.',
    'digits_between' => ':attribute musi mieć od :min do :max cyfr.',
    'dimensions' => ':attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => 'Pole :attribute ma zduplikowaną wartość.',
    'doesnt_end_with' => ':attribute nie może kończyć się jednym z następujących: :values.',
    'doesnt_start_with' => ':attribute nie może zaczynać się od jednego z następujących: :values.',
    'email' => ':attribute musi być prawidłowym adresem e-mail.',
    'ends_with' => ':attribute musi kończyć się jednym z następujących: :values.',
    'enum' => 'Wybrany :attribute jest nieprawidłowy.',
    'exists' => 'Wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => 'Pole :attribute musi mieć wartość.',
    'gt' => array(
        'array' => ':attribute musi mieć więcej niż :value elementów.',
        'file' => ':attribute musi być większy niż :value kilobajtów.',
        'numeric' => ':attribute musi być większy niż :value.',
        'string' => ':attribute musi być dłuższy niż :value znaków.',
    ),
    'gte' => array(
        'array' => ':attribute musi mieć :value elementów lub więcej.',
        'file' => ':attribute musi być większy lub równy :value kilobajtów.',
        'numeric' => ':attribute musi być większy lub równy :value.',
        'string' => ':attribute musi być dłuższy lub równy :value znaków.',
    ),
    'image' => ':attribute musi być obrazem.',
    'in' => 'Wybrany :attribute jest nieprawidłowy.',
    'in_array' => 'Pole :attribute nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być prawidłowym adresem IP.',
    'ipv4' => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6' => ':attribute musi być prawidłowym adresem IPv6.',
    'json' => ':attribute musi być prawidłowym ciągiem JSON.',
    'lowercase' => ':attribute musi być pisane małymi literami.',
    'lt' => array(
        'array' => ':attribute musi mieć mniej niż :value elementów.',
        'file' => ':attribute musi być mniejszy niż :value kilobajtów.',
        'numeric' => ':attribute musi być mniejszy niż :value.',
        'string' => ':attribute musi być krótszy niż :value znaków.',
    ),
    'lte' => array(
        'array' => ':attribute nie może mieć więcej niż :value elementów.',
        'file' => ':attribute musi być mniejszy lub równy :value kilobajtów.',
        'numeric' => ':attribute musi być mniejszy lub równy :value.',
        'string' => ':attribute musi być krótszy lub równy :value znaków.',
    ),
    'mac_address' => ':attribute musi być prawidłowym adresem MAC.',
    'max' => array(
        'array' => ':attribute nie może mieć więcej niż :max elementów.',
        'file' => ':attribute nie może być większy niż :max kilobajtów.',
        'numeric' => ':attribute nie może być większy niż :max.',
        'string' => ':attribute nie może być dłuższy niż :max znaków.',
    ),
    'max_digits' => ':attribute nie może mieć więcej niż :max cyfr.',
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => array(
        'array' => ':attribute musi mieć przynajmniej :min elementów.',
        'file' => ':attribute musi mieć przynajmniej :min kilobajtów.',
        'numeric' => ':attribute musi mieć przynajmniej :min.',
        'string' => ':attribute musi mieć przynajmniej :min znaków.',
    ),
    'min_digits' => ':attribute musi mieć przynajmniej :min cyfr.',
    'multiple_of' => ':attribute musi być wielokrotnością :value.',
    'not_in' => 'Wybrany :attribute jest nieprawidłowy.',
    'not_regex' => 'Format :attribute jest nieprawidłowy.',
    'numeric' => ':attribute musi być liczbą.',
    'password' => array(
        'letters' => ':attribute musi zawierać co najmniej jedną literę.',
        'mixed' => ':attribute musi zawierać co najmniej jedną dużą i jedną małą literę.',
        'numbers' => ':attribute musi zawierać co najmniej jedną cyfrę.',
        'symbols' => ':attribute musi zawierać co najmniej jeden symbol.',
        'uncompromised' => 'Podany :attribute pojawił się w wycieku danych. Proszę użyć innego :attribute.',
    ),
    'present' => 'Pole :attribute musi być obecne.',
    'prohibited' => 'Pole :attribute jest zabronione.',
    'prohibited_if' => 'Pole :attribute jest zabronione, gdy :other ma wartość :value.',
    'prohibited_unless' => 'Pole :attribute jest zabronione, chyba że :other znajduje się w :values.',
    'prohibits' => 'Pole :attribute zabrania obecności :other.',
    'regex' => 'Format :attribute jest nieprawidłowy.',
    'required' => 'To pole jest wymagane.',
    'required_array_keys' => 'Pole :attribute musi zawierać wpisy dla: :values.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other ma wartość :value.',
    'required_if_accepted' => 'Pole :attribute jest wymagane, gdy :other jest zaakceptowane.',
    'required_unless' => 'Pole :attribute jest wymagane, chyba że :other znajduje się w :values.',
    'required_with' => 'Pole :attribute jest wymagane, gdy :values jest obecne.',
    'required_with_all' => 'Pole :attribute jest wymagane, gdy :values są obecne.',
    'required_without' => 'Pole :attribute jest wymagane, gdy :values nie jest obecne.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy żadne z :values nie są obecne.',
    'same' => ':attribute i :other muszą się zgadzać.',
    'size' => array(
        'array' => ':attribute musi zawierać :size elementów.',
        'file' => ':attribute musi mieć :size kilobajtów.',
        'numeric' => ':attribute musi wynosić :size.',
        'string' => ':attribute musi mieć :size znaków.',
    ),
    'starts_with' => ':attribute musi zaczynać się jednym z następujących: :values.',
    'string' => ':attribute musi być ciągiem znaków.',
    'timezone' => ':attribute musi być prawidłową strefą czasową.',
    'unique' => ':attribute został już wcześniej użyty.',
    'uploaded' => 'Przesyłanie :attribute nie powiodło się.',
    'uppercase' => ':attribute musi być zapisany wielkimi literami.',
    'url' => ':attribute musi być prawidłowym adresem URL.',
    'ulid' => ':attribute musi być prawidłowym ULID.',
    'uuid' => ':attribute musi być prawidłowym UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => array(
        'definition_to' => array(
            'after_or_equal' => 'Data końca etapu musi być późniejsza niż data początku.',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => array(
        'password' => 'hasło',
        'email' => 'adres email',
        'site_name' => 'nazwa witryny',
    ),

);
