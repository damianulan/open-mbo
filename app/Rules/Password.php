<?php

namespace App\Rules;

use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Validation\UncompromisedVerifier;

class Password extends PasswordRule
{
    public function __construct()
    {
        $min = settings('users.password_min_length');

        parent::__construct($min);

        $this->letters = settings('users.password_min_letters');
        $this->numbers = settings('users.password_min_numbers');
        $this->symbols = settings('users.password_min_symbols');
    }

    public function passes($attribute, $value)
    {
        $this->messages = [];

        $validator = Validator::make(
            $this->data,
            [$attribute => [
                'string',
                'min:'.$this->min,
                ...($this->max ? ['max:'.$this->max] : []),
                ...$this->customRules,
            ]],
            $this->validator->customMessages,
            $this->validator->customAttributes
        )->after(function ($validator) use ($attribute, $value) {
            if (! is_string($value)) {
                return;
            }

            if ($this->mixedCase && ! preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value)) {
                $validator->addFailure($attribute, 'password.mixed');
            }

            if ($this->letters && ! preg_match_all('/\pL/u', $value, $matches) >= $this->letters) {
                $validator->addFailure($attribute, 'password.letters');
            }

            if ($this->symbols && ! preg_match_all('/\p{Z}|\p{S}|\p{P}/u', $value, $matches) >= $this->symbols) {
                $validator->addFailure($attribute, 'password.symbols');
            }

            if ($this->numbers && ! preg_match_all('/\pN/u', $value, $matches) >= $this->numbers) {
                $validator->addFailure($attribute, 'password.numbers');
            }
        });

        if ($validator->fails()) {
            return $this->fail($validator->messages()->all());
        }

        if ($this->uncompromised && ! Container::getInstance()->make(UncompromisedVerifier::class)->verify([
            'value' => $value,
            'threshold' => $this->compromisedThreshold,
        ])) {
            $validator->addFailure($attribute, 'password.uncompromised');

            return $this->fail($validator->messages()->all());
        }

        return true;
    }
}
