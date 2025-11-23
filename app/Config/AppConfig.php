<?php

namespace App\Config;

use Lucent\Console\Git;

class AppConfig
{
    public static function getReleasesOptions(): array
    {
        $releases = [];
        $custom = ['stable', 'non-stable', 'dev'];
        $raw = array_merge($custom, Git::getTags());

        foreach ($raw as $release) {
            $text = $release;
            if (in_array($release, $custom)) {
                $text = __('forms.version.' . $release);
            }
            $releases[$release] = $text;
        }

        return $releases;
    }
}
