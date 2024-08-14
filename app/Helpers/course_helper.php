<?php

if (!function_exists('generateSlug')) {
    function generateSlug($title)
    {
        // Convert to lowercase, remove special characters and replace spaces with hyphens
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
    }
}
