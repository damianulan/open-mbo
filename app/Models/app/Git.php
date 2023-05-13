<?php

namespace App\Models\app;

class Git
{
    public static function head()
    {
        $exec = passthru('git rev-parse --short HEAD 2>&1');
        if($exec){
            return $exec;
        }
        return false;
    }

    public static function branch()
    {
        $exec = passthru('git rev-parse --abbrev-ref HEAD');
        if($exec){
            return $exec;
        }
        return false;
    }

    public static function url()
    {
        $exec = passthru('git remote get-url origin');
        if($exec){
            return $exec;
        }
        return false;
    }

}