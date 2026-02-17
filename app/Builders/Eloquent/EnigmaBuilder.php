<?php

namespace App\Builders\Eloquent;

use App\Casts\Enigma;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Arrayable;

class EnigmaBuilder extends Builder
{
    /**
     * Override where() to redirect encrypted fields.
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if(config('app.enigma_models')){

            // Handle where('email', 'value')
            if (func_num_args() === 2) {
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
        if(config('app.enigma_models')){
            if ($values instanceof Arrayable) {
                $values = $values->toArray();
            }

            $encrypted = $this->getModel()->getEncryptedAttributes() ?? [];
            if (in_array($column, $encrypted)) {
                $column = $column . '_hash';
                $values = array_map(function ($value) {
                    return Enigma::hashValue($value);
                }, $values);
            }
        }

        return parent::whereIn($column, $values, $boolean, $not);
    }
}
