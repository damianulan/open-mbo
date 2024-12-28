<?php

namespace App\Lib;

use App\Settings\GeneralSettings;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Collection;

class Theme
{
    public $current;
    public $available;
    protected $images_path;

    public function __construct()
    {
        $this->available = self::getAvailable();
        $this->current = current_theme();
        $this->images_path = 'themes/'.$this->current.'/images/';
    }

    public static function getAvailable(): Collection
    {
        $directories = new Collection();
        foreach (Finder::create()->in(public_path('themes'))->directories()->depth(0)->sortByName() as $dir) {
            $d = $dir->getFilename();
            if(!in_array($d, ['js','vendors','images'])){
                $directories->push($d);
            }
        }
        return $directories;
    }

    public static function imagePath()
    {
        return (new self())->images_path;
    }
}
