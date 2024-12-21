<?php

namespace App\Helpers;

use App\Models\Setting;

class Settings
/**
 * Settings helper class.
 *
 * This class provides helper methods for getting app settings and constants.
 */
{
    static public function getValue($name, $default = null)
    {
        $value = Setting::where('name', $name)->first();
        if (!$value && !$default) {
            return 'the term ' . $name . ' does not exist';
        } elseif (!$value && $default) {
            return $default;
        }
        return $value->value;
    }

    static public function getId($name, $default = null)
    {
        $value = Setting::where('name', $name)->first();
        if (!$value && !$default) {
            return 'the term ' . $name . ' does not exist';
        } elseif (!$value && $default) {
            return $default;
        }
        return $value->id;
    }


    static public function getDescription($name, $default = null)
    {
        $value = Setting::where('name', $name)->first();
        if (!$value && !$default) {
            return 'the term ' . $name . ' does not exist';
        } elseif (!$value && $default) {
            return $default;
        }
        return $value->description;
    }

    static public function setValue($name, $value)
    {
        $setting = Setting::where('name', $name)->first();
        if (!$setting) {
            $setting = new Setting();
            $setting->name = $name;
        }
        $setting->value = $value;
        $setting->save();
    }
}
