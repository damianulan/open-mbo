<?php

namespace App\Builders\Eloquent;

use App\Casts\Enigma;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;

class EnigmaBuilder extends Builder
{
    /**
     * @param null|mixed $operator
     * @param null|mixed $value
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and'): Builder
    {
        if (config('app.enigma_models')) {
            if (func_num_args() === 2) {
                $value = $operator;
                $operator = '=';
            }

            $encrypted = $this->getModel()->getEncryptedAttributes() ?? [];

            if (in_array($column, $encrypted)) {
                $column = $column . '_hash';
                $value = Enigma::hashValue($value);
            }
        }

        return parent::where($column, $operator, $value, $boolean);
    }

    public function whereIn($column, $values, $boolean = 'and', $not = false): Builder
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
