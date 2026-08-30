<?php

namespace App\Support\Search\Dtos;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class ResultItem extends Data
{
    public function __construct(
        public string $title,
        public ?string $description,
        public string $link,
    ) {
    }

    public function setSearchedPhrase(string $phrase): self
    {
        foreach ($this->all() as $key => $value) {
            $phraseFound = '<strong>' . Str::upper($phrase) . '</strong>';
            $this->{$key} = Str::replace($phrase, $phraseFound, $value, false);
        }

        return $this;
    }

    public function render(): Renderable
    {
        return view('components.search.results.default', $this->toArray());
    }
}
