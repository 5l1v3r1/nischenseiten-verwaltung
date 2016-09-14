<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Carbon\Carbon;

class ViewHelper
{
    public static function cleanUrl(string $url)
    {
        $urldata = parse_url($url);
        
        if( isset($urldata['host']) ) {
            return strtolower($urldata['host']);
        }
        
        return null;
        
    }
    
    public static function deadlineWarning($deadline) {
        //deadline in format: dd.mm.yyyy
        if(is_null($deadline) || $deadline == '' ) {
            return 2;
        }
        
        return Carbon::now()->diffInDays(Carbon::createFromFormat('d.m.Y', $deadline), false);
    }
}