<?php

namespace App\Helpers;

class MyFuncs
{
    public static function full_name($first_name, $last_name)
    {
        echo $first_name . ', ' . $last_name;
    }

    public static function pre($array, $die = false)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';

        if ($die) {
            die();
        }
    }
}