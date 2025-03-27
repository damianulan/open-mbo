<?php

namespace App\Traits;

trait VirginModel
{
    public function empty()
    {
        return empty($this->id) || !$this->exists();
    }

    public function notEmpty()
    {
        return !empty($this->id) && $this->exists();
    }
}
