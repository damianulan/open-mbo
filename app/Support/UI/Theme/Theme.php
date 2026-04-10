<?php

namespace App\Support\UI\Theme;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

class Theme
{
    public $current;

    public $available;

    public $mode;

    protected $images_path;

    public function __construct()
    {
        $this->available = self::getAvailable();
        $this->current = current_theme();
        $this->images_path = 'themes/' . $this->current . '/images/';
        $this->mode = settings('general.theme_mode', 'light');
    }

    public static function getAvailable(): Collection
    {
        $directories = new Collection();
        foreach (Finder::create()->in(public_path('themes'))->directories()->depth(0)->sortByName() as $dir) {
            $d = $dir->getFilename();
            if (! in_array($d, ['js', 'vendors', 'images'])) {
                $directories->push($d);
            }
        }

        return $directories;
    }

    public static function getModes(): array
    {
        return [
            'light' => 'Light',
            'dark' => 'Dark',
        ];
    }

    public static function imagePath()
    {
        return (new self())->images_path;
    }
}
