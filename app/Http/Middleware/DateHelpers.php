<?php

namespace App\Http\Middleware;

use Carbon\Carbon;

class DateHelpers
{
    public static function formatDate_dmY($value) {
	    return Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d');
    }
    
    public static function formatFloatValue($value) {
        $value = preg_replace('/\,/', '.', preg_replace('/\./', '', $value));
        return number_format($value, 2, '.', '');
    }
}
