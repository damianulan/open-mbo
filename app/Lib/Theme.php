<?php

namespace App\Lib;

use Symfony\Component\Finder\Finder;

class Theme
{
    public $current = 'light';
    public $available;

    public function __construct()
    {
        $directories = [];

        foreach (Finder::create()->in(public_path('themes'))->directories()->depth(0)->sortByName() as $dir) {
            $d = $dir->getFilename();
            if($d !== 'vendors'){
                $directories[] = $d;
            }
        }
    }

    public static function getAvailable()
    {
        return (new self())->available;
    }
}