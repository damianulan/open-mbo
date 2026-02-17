<?php

namespace App\Builders\Eloquent;

use App\Casts\Enigma;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;

class EnigmaBuilder extends Builder
{
    /**
     * Override where() to redirect encrypted fields.
     *
     * @param  mixed  $column
     * @param  null|mixed  $operator
     * @param  null|mixed  $value
     * @param  mixed  $boolean
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if (config('app.enigma_models')) {

            // Handle where('email', 'value')
            if (2 === func_num_args()) {
                $value = $operator;
                $operator = '=';
            }

            // Get encrypted fields from model
            $encrypted = $this->getModel()->getEncryptedAttributes() ?? [];

            if (in_array($column, $encrypted)) {
                $column = $column . '_hash';
                $value = Enigma::hashValue($value);
            }

        }

        return parent::where($column, $operator, $value, $boolean);
    }

    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        if (config('app.enigma_models')) {
            if ($values instanceof Arrayable) {
                $values = $values->toArray();
            }

            $encrypted = $this->getModel()->getEncryptedAttributes() ?? [];
            if (in_array($column, $encrypted)) {
                $column = $column . '_hash';
                $values = array_map(fn ($value) => Enigma::hashValue($value), $values);
            }
        }

        return parent::whereIn($column, $values, $boolean, $not);
    }
}
