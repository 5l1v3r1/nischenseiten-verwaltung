<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Some Helperfunctions for our views
 */
class ViewHelper
{

    /**
     * Generate the hostname from a given string
     *
     * We need this since api.metrics only accepts the hostname, but within the
     * frontend everyone likes to use the full URL.
     *
     * @param string $url Full URL, e.g. https://www.domain.de/
     *
     * @return string|null Hostname, e.g. www.domain.de
     */
    public static function cleanUrl(string $url)
    {
        $urldata = parse_url($url);

        if (isset($urldata['host'])) {
            return strtolower($urldata['host']);
        }

        return null;
    }

    /**
     * Get Number of days till deadline
     *
     * @param string|null        $deadline Datetime in format dd.mm.yyyy
     *
     * @return \Carbon\Carbon Laravels default datetime package
     */
    public static function deadlineWarning($deadline)
    {
        if (is_null($deadline) || $deadline == '') {
            return 2;
        }

        return Carbon::now()->diffInDays(Carbon::createFromFormat('d.m.Y', $deadline), false);
    }
}
