<?php

use App\Helpers\Helpers;
use App\Helpers\Settings;

if (!function_exists('my_custom_function')) {
    function my_custom_function()
    {
        // Your custom function's code here
    }
}

/**
 * Get an instance of the Helper class.
 *
 * This provides access to helper functions and data.
 * Uses the singleton pattern to only instantiate Helper once.
 */
if (!function_exists('helpers')) {
    function helpers()
    {
        static $helper = null;
        if ($helper === null) {
            $helper = new Helpers();
        }
        return $helper;
    }
}

/**
 * Get an instance of the Settings class.
 *
 * This provides access to settings data.
 * Uses the singleton pattern to only instantiate Settings once.
 */
if (!function_exists('settings')) {
    function settings()
    {
        static $helper = null;
        if ($helper === null) {
            $helper = new Settings();
        }
        return $helper;
    }
}
