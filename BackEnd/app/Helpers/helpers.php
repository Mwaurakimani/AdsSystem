<?php

namespace App\Helpers;

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('ddh')) {
    #[NoReturn] function ddh($var)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd($var);
    }
}

/*
 * dump() with headers
 */
if (!function_exists('dumph')) {
    function dumph($var): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dump($var);
    }
}
