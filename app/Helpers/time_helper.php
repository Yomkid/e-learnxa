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

        // Manually calculate weeks
        $weeks = floor($diff->d / 7);
        $diff->d -= $weeks * 7; // Adjust days to remove full weeks

        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => $weeks, // Use calculated weeks
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];

        foreach ($string as $k => &$v) {
            if ($diff->$k || $k === 'w') {
                $v = ($k === 'w' ? $weeks : $diff->$k) . ' ' . $v . (($k === 'w' ? $weeks : $diff->$k) > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
