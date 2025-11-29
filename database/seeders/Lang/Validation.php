<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Validation extends Seeder
{
    public static function list(): array
    {
        return array(
            'accepted' => array(
                'pl' => ':attribute musi zostać zaakceptowany.',
            ),
            'accepted_if' => array(
                'pl' => ':attribute musi zostać zaakceptowany, gdy :other ma wartość :value.',
            ),
            'active_url' => array(
                'pl' => ':attribute nie jest prawidłowym adresem URL.',
            ),
            'after' => array(
                'pl' => ':attribute musi być datą późniejszą niż :date.',
            ),
            'after_or_equal' => array(
                'pl' => ':attribute musi być datą nie wcześniejszą niż :date.',
            ),
            'alpha' => array(
                'pl' => ':attribute może zawierać tylko litery.',
            ),
            'alpha_dash' => array(
                'pl' => ':attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
            ),
            'alpha_num' => array(
                'pl' => ':attribute może zawierać tylko litery i cyfry.',
            ),
            'array' => array(
                'pl' => ':attribute musi być tablicą.',
            ),
            'ascii' => array(
                'pl' => ':attribute może zawierać tylko jednobajtowe znaki alfanumeryczne i symbole.',
            ),
            'before' => array(
                'pl' => ':attribute musi być datą wcześniejszą niż :date.',
            ),
            'before_or_equal' => array(
                'pl' => ':attribute musi być datą nie późniejszą niż :date.',
            ),
            'between.array' => array(
                'pl' => ':attribute musi mieć od :min do :max elementów.',
            ),
            'between.file' => array(
                'pl' => ':attribute musi mieć od :min do :max kilobajtów.',
            ),
            'between.numeric' => array(
                'pl' => ':attribute musi mieć wartość od :min do :max.',
            ),
            'between.string' => array(
                'pl' => ':attribute musi mieć od :min do :max znaków.',
            ),
            'boolean' => array(
                'pl' => 'Pole :attribute musi być prawdą lub fałszem.',
            ),
            'confirmed' => array(
                'pl' => 'Potwierdzenie :attribute nie pasuje.',
            ),
            'current_password' => array(
                'pl' => 'Hasło jest nieprawidłowe.',
            ),
            'date' => array(
                'pl' => ':attribute nie jest prawidłową datą.',
            ),
            'date_equals' => array(
                'pl' => ':attribute musi być datą równą :date.',
            ),
            'date_format' => array(
                'pl' => ':attribute nie pasuje do formatu :format.',
            ),
            'decimal' => array(
                'pl' => ':attribute musi mieć :decimal miejsc dziesiętnych.',
            ),
            'declined' => array(
                'pl' => ':attribute musi zostać odrzucony.',
            ),
            'declined_if' => array(
                'pl' => ':attribute musi zostać odrzucony, gdy :other ma wartość :value.',
            ),
            'different' => array(
                'pl' => ':attribute i :other muszą się różnić.',
            ),
            'digits' => array(
                'pl' => ':attribute musi składać się z :digits cyfr.',
            ),
            'digits_between' => array(
                'pl' => ':attribute musi mieć od :min do :max cyfr.',
            ),
            'dimensions' => array(
                'pl' => ':attribute ma nieprawidłowe wymiary obrazu.',
            ),
            'distinct' => array(
                'pl' => 'Pole :attribute ma zduplikowaną wartość.',
            ),
            'doesnt_end_with' => array(
                'pl' => ':attribute nie może kończyć się jednym z następujących: :values.',
            ),
            'doesnt_start_with' => array(
                'pl' => ':attribute nie może zaczynać się od jednego z następujących: :values.',
            ),
            'email' => array(
                'pl' => ':attribute musi być prawidłowym adresem e-mail.',
            ),
            'ends_with' => array(
                'pl' => ':attribute musi kończyć się jednym z następujących: :values.',
            ),
            'enum' => array(
                'pl' => 'Wybrany :attribute jest nieprawidłowy.',
            ),
            'exists' => array(
                'pl' => 'Wybrany :attribute jest nieprawidłowy.',
            ),
            'file' => array(
                'pl' => ':attribute musi być plikiem.',
            ),
            'filled' => array(
                'pl' => 'Pole :attribute musi mieć wartość.',
            ),
            'gt.array' => array(
                'pl' => ':attribute musi mieć więcej niż :value elementów.',
            ),
            'gt.file' => array(
                'pl' => ':attribute musi być większy niż :value kilobajtów.',
            ),
            'gt.numeric' => array(
                'pl' => ':attribute musi być większy niż :value.',
            ),
            'gt.string' => array(
                'pl' => ':attribute musi być dłuższy niż :value znaków.',
            ),
            'gte.array' => array(
                'pl' => ':attribute musi mieć :value elementów lub więcej.',
            ),
            'gte.file' => array(
                'pl' => ':attribute musi być większy lub równy :value kilobajtów.',
            ),
            'gte.numeric' => array(
                'pl' => ':attribute musi być większy lub równy :value.',
            ),
            'gte.string' => array(
                'pl' => ':attribute musi być dłuższy lub równy :value znaków.',
            ),
            'image' => array(
                'pl' => ':attribute musi być obrazem.',
            ),
            'in' => array(
                'pl' => 'Wybrany :attribute jest nieprawidłowy.',
            ),
            'in_array' => array(
                'pl' => 'Pole :attribute nie istnieje w :other.',
            ),
            'integer' => array(
                'pl' => ':attribute musi być liczbą całkowitą.',
            ),
            'ip' => array(
                'pl' => ':attribute musi być prawidłowym adresem IP.',
            ),
            'ipv4' => array(
                'pl' => ':attribute musi być prawidłowym adresem IPv4.',
            ),
            'ipv6' => array(
                'pl' => ':attribute musi być prawidłowym adresem IPv6.',
            ),
            'json' => array(
                'pl' => ':attribute musi być prawidłowym ciągiem JSON.',
            ),
            'lowercase' => array(
                'pl' => ':attribute musi być pisane małymi literami.',
            ),
            'lt.array' => array(
                'pl' => ':attribute musi mieć mniej niż :value elementów.',
            ),
            'lt.file' => array(
                'pl' => ':attribute musi być mniejszy niż :value kilobajtów.',
            ),
            'lt.numeric' => array(
                'pl' => ':attribute musi być mniejszy niż :value.',
            ),
            'lt.string' => array(
                'pl' => ':attribute musi być krótszy niż :value znaków.',
            ),
            'lte.array' => array(
                'pl' => ':attribute nie może mieć więcej niż :value elementów.',
            ),
            'lte.file' => array(
                'pl' => ':attribute musi być mniejszy lub równy :value kilobajtów.',
            ),
            'lte.numeric' => array(
                'pl' => ':attribute musi być mniejszy lub równy :value.',
            ),
            'lte.string' => array(
                'pl' => ':attribute musi być krótszy lub równy :value znaków.',
            ),
            'mac_address' => array(
                'pl' => ':attribute musi być prawidłowym adresem MAC.',
            ),
            'max.array' => array(
                'pl' => ':attribute nie może mieć więcej niż :max elementów.',
            ),
            'max.file' => array(
                'pl' => ':attribute nie może być większy niż :max kilobajtów.',
            ),
            'max.numeric' => array(
                'pl' => ':attribute nie może być większy niż :max.',
            ),
            'max.string' => array(
                'pl' => ':attribute nie może być dłuższy niż :max znaków.',
            ),
            'max_digits' => array(
                'pl' => ':attribute nie może mieć więcej niż :max cyfr.',
            ),
            'mimes' => array(
                'pl' => ':attribute musi być plikiem typu: :values.',
            ),
            'mimetypes' => array(
                'pl' => ':attribute musi być plikiem typu: :values.',
            ),
            'min.array' => array(
                'pl' => ':attribute musi mieć przynajmniej :min elementów.',
            ),
            'min.file' => array(
                'pl' => ':attribute musi mieć przynajmniej :min kilobajtów.',
            ),
            'min.numeric' => array(
                'pl' => ':attribute musi mieć przynajmniej :min.',
            ),
            'min.string' => array(
                'pl' => ':attribute musi mieć przynajmniej :min znaków.',
            ),
            'min_digits' => array(
                'pl' => ':attribute musi mieć przynajmniej :min cyfr.',
            ),
            'multiple_of' => array(
                'pl' => ':attribute musi być wielokrotnością :value.',
            ),
            'not_in' => array(
                'pl' => 'Wybrany :attribute jest nieprawidłowy.',
            ),
            'not_regex' => array(
                'pl' => 'Format :attribute jest nieprawidłowy.',
            ),
            'numeric' => array(
                'pl' => ':attribute musi być liczbą.',
            ),
            'password.letters' => array(
                'pl' => ':attribute musi zawierać co najmniej jedną literę.',
            ),
            'password.mixed' => array(
                'pl' => ':attribute musi zawierać co najmniej jedną dużą i jedną małą literę.',
            ),
            'password.numbers' => array(
                'pl' => ':attribute musi zawierać co najmniej jedną cyfrę.',
            ),
            'password.symbols' => array(
                'pl' => ':attribute musi zawierać co najmniej jeden symbol.',
            ),
            'password.uncompromised' => array(
                'pl' => 'Podany :attribute pojawił się w wycieku danych. Proszę użyć innego :attribute.',
            ),
            'present' => array(
                'pl' => 'Pole :attribute musi być obecne.',
            ),
            'prohibited' => array(
                'pl' => 'Pole :attribute jest zabronione.',
            ),
            'prohibited_if' => array(
                'pl' => 'Pole :attribute jest zabronione, gdy :other ma wartość :value.',
            ),
            'prohibited_unless' => array(
                'pl' => 'Pole :attribute jest zabronione, chyba że :other znajduje się w :values.',
            ),
            'prohibits' => array(
                'pl' => 'Pole :attribute zabrania obecności :other.',
            ),
            'regex' => array(
                'pl' => 'Format :attribute jest nieprawidłowy.',
            ),
            'required' => array(
                'pl' => 'To pole jest wymagane.',
            ),
            'required_array_keys' => array(
                'pl' => 'Pole :attribute musi zawierać wpisy dla: :values.',
            ),
            'required_if' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy :other ma wartość :value.',
            ),
            'required_if_accepted' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy :other jest zaakceptowane.',
            ),
            'required_unless' => array(
                'pl' => 'Pole :attribute jest wymagane, chyba że :other znajduje się w :values.',
            ),
            'required_with' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy :values jest obecne.',
            ),
            'required_with_all' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy :values są obecne.',
            ),
            'required_without' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy :values nie jest obecne.',
            ),
            'required_without_all' => array(
                'pl' => 'Pole :attribute jest wymagane, gdy żadne z :values nie są obecne.',
            ),
            'same' => array(
                'pl' => ':attribute i :other muszą się zgadzać.',
            ),
            'size.array' => array(
                'pl' => ':attribute musi zawierać :size elementów.',
            ),
            'size.file' => array(
                'pl' => ':attribute musi mieć :size kilobajtów.',
            ),
            'size.numeric' => array(
                'pl' => ':attribute musi wynosić :size.',
            ),
            'size.string' => array(
                'pl' => ':attribute musi mieć :size znaków.',
            ),
            'starts_with' => array(
                'pl' => ':attribute musi zaczynać się jednym z następujących: :values.',
            ),
            'string' => array(
                'pl' => ':attribute musi być ciągiem znaków.',
            ),
            'timezone' => array(
                'pl' => ':attribute musi być prawidłową strefą czasową.',
            ),
            'unique' => array(
                'pl' => ':attribute został już wcześniej użyty.',
            ),
            'uploaded' => array(
                'pl' => 'Przesyłanie :attribute nie powiodło się.',
            ),
            'uppercase' => array(
                'pl' => ':attribute musi być zapisany wielkimi literami.',
            ),
            'url' => array(
                'pl' => ':attribute musi być prawidłowym adresem URL.',
            ),
            'ulid' => array(
                'pl' => ':attribute musi być prawidłowym ULID.',
            ),
            'uuid' => array(
                'pl' => ':attribute musi być prawidłowym UUID.',
            ),
            'custom.definition_to.after_or_equal' => array(
                'pl' => 'Data końca etapu musi być późniejsza niż data początku.',
            ),
            'attributes.password' => array(
                'pl' => 'hasło',
            ),
            'attributes.email' => array(
                'pl' => 'adres email',
            ),
            'attributes.site_name' => array(
                'pl' => 'nazwa witryny',
            ),
        );
    }
}
