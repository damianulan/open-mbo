<?php

namespace App\Models\app;

class Git
{
    public static function head()
    {
        $file = file_get_contents(base_path().'/.git/HEAD');
        $ref = "ref: refs/heads/";
        return trim(substr($file, strpos($file, $ref)+strlen($ref)));
    }

}