<?php

if (!function_exists('timeAgo')) {
    /**
     * Convert a timestamp to a time ago format (e.g., "2 hours ago").
     *
     * @param string $datetime The timestamp to convert.
     * @param bool $full If true, show the full time (e.g., "2 hours, 5 minutes ago").
     * @return string The time ago string.
     */
    function timeAgo($datetime, $full = false) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        // Manually calculate weeks since DateInterval does not support weeks
        $weeks = floor($diff->d / 7);
        $diff->d -= $weeks * 7;

        // Time strings
        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];

        // Handle the time difference string
        foreach ($string as $k => &$v) {
            if ($k === 'w' && $weeks > 0) {
                $v = $weeks . ' ' . $v . ($weeks > 1 ? 's' : '');
            } elseif ($k !== 'w' && $diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        // Limit to the first time unit if not full
        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
