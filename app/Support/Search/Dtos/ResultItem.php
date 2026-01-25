<?php

namespace App\Support\Search\Dtos;

use DTOs\Dto;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;

class ResultItem extends Dto
{
    protected $fillable = [
        'title',
        'description',
        'link'
    ];

    public function setSearchedPhrase(string $phrase): self
    {
        foreach($this->attributes as $key => $value){
            $phraseFound = "<strong>".Str::upper($phrase)."</strong>";
            $this->$key = Str::replace($phrase, $phraseFound, $value, false);
        }

        return $this;
    }

    public function render(): Renderable
    {
        return view('components.search.results.default', $this->toArray());
    }
}
