<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Settings as HelpersSettings;

class Settings extends Component
{
    public $app_name;
    public $app_description;
    public $app_key_words;
    public $app_email;
    public $app_phone;
    public $app_address;
    public $app_timezone;
    public $app_currency;
    public $app_currency_logo;
    public $app_instagram;
    public $app_facebook;
    public $app_twitter;
    public $app_youtube;


    public function save()
    {
        $validator = Validator::make([
            'app_name' => $this->app_name,
            'app_description' => $this->app_description,
            'app_key_words' => $this->app_key_words,
            'app_email' => $this->app_email,
            'app_phone' => $this->app_phone,
            'app_address' => $this->app_address,
            'app_timezone' => $this->app_timezone,
            'app_currency' => $this->app_currency,
            'app_currency_logo' => $this->app_currency_logo,
            'app_instagram' => $this->app_instagram,
            'app_facebook' => $this->app_facebook,
            'app_twitter' => $this->app_twitter,
            'app_youtube' => $this->app_youtube,
        ], [
            'app_name' => 'required',
            'app_description' => 'required',
            'app_key_words' => 'sometimes',
            'app_email' => 'required|email',
            'app_phone' => 'required',
            'app_address' => 'required',
            'app_timezone' => 'required|string',
            'app_currency' => 'required',
            'app_currency_logo' => 'required',
            'app_instagram' => 'sometimes|url',
            'app_facebook' => 'sometimes|url',
            'app_twitter' => 'sometimes|url',
            'app_youtube' => 'sometimes|url',
        ]);

        if ($validator->fails()) {
            $this->dispatch('triggerToast', $validator->errors()->all());
            return;
        }

        $needsUpdate = HelpersSettings::getValue('app_name') != $this->app_name || HelpersSettings::getValue('app_timezone') != $this->app_timezone;

        HelpersSettings::setValue('app_name', $this->app_name);
        HelpersSettings::setValue('app_description', $this->app_description);
        HelpersSettings::setValue('app_key_words', $this->app_key_words);
        HelpersSettings::setValue('app_email', $this->app_email);
        HelpersSettings::setValue('app_phone', $this->app_phone);
        HelpersSettings::setValue('app_address', $this->app_address);
        HelpersSettings::setValue('app_timezone', $this->app_timezone);
        HelpersSettings::setValue('app_currency', $this->app_currency);
        HelpersSettings::setValue('app_currency_logo', $this->app_currency_logo);
        HelpersSettings::setValue('app_instagram', $this->app_instagram);
        HelpersSettings::setValue('app_facebook', $this->app_facebook);
        HelpersSettings::setValue('app_twitter', $this->app_twitter);
        HelpersSettings::setValue('app_youtube', $this->app_youtube);

        $this->dispatch('notification', [
            'message' => 'Settings updated successfully!',
            'type' => 'success',
        ]);

        if ($needsUpdate) {
            $envPath = base_path('.env');
            $envContent = file_get_contents($envPath);
            $updatedContent = preg_replace('/^APP_NAME=.*$/m', "APP_NAME=\"{$this->app_name}\"", $envContent);
            $updatedContent = preg_replace('/^APP_TIMEZONE=.*$/m', "APP_TIMEZONE={$this->app_timezone}", $updatedContent);
            file_put_contents($envPath, $updatedContent);
            Artisan::call('config:cache');
        }

    }

    public function boot()
    {
        $this->app_name = HelpersSettings::getValue('app_name');
        $this->app_description = HelpersSettings::getValue('app_description');
        $this->app_key_words = HelpersSettings::getValue('app_key_words');
        $this->app_email = HelpersSettings::getValue('app_email');
        $this->app_phone = HelpersSettings::getValue('app_phone');
        $this->app_address = HelpersSettings::getValue('app_address');
        $this->app_timezone = HelpersSettings::getValue('app_timezone');
        $this->app_currency = HelpersSettings::getValue('app_currency');
        $this->app_currency_logo = HelpersSettings::getValue('app_currency_logo');
        $this->app_instagram = HelpersSettings::getValue('app_instagram');
        $this->app_facebook = HelpersSettings::getValue('app_facebook');
        $this->app_twitter = HelpersSettings::getValue('app_twitter');
        $this->app_youtube = HelpersSettings::getValue('app_youtube');
    }

    public function render()
    {
        // dd(now());
        return view('admin.settings.settings');
    }
}
