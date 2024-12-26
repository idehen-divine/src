<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class Helpers

{

    /**
     * get auth users details
     * @return mixed
     */
    // public function getAuthUser()
    // {
    //     $user = auth()->user();
    //     if (!$user) {
    //         throw new \Exception('No authenticated user found');
    //     }

    //     return $user;
    // }

    /**
     * Generates a unique identifier (UID) with a fixed length of 10 characters.
     *
     * @return string The generated UID.
     */
    public function generateUid()
    {
        return str_pad(random_int(0, 999999), 10, '0', STR_PAD_LEFT);
    }

    /**
     * Generates a 6-character referral code by hashing a unique identifier.
     *
     * @return string The generated referral code.
     */
    public function generateReferralCode()
    {
        $referralCode = substr(md5(uniqid(rand(), true)), 0, 6);
        return $referralCode;
    }

    /**
     * Retrieves all nationalities from the database.
     *
     * @return \Illuminate\Support\Collection A collection of nationality records.
     */
    public static function getNationalities()
    {
        return DB::table('nationalities')->get();
    }

    /**
     * Retrieves all states from the database.
     *
     * @return \Illuminate\Support\Collection A collection of state records.
     */
    public static function getStates()
    {
        return DB::table('states')->get();
    }

    /**
     * Retrieves all local government areas (LGAs) for the given state ID.
     *
     * @param int $state_id The ID of the state to retrieve LGAs for.
     * @return \Illuminate\Support\Collection A collection of LGA records.
     */
    public static function getLgas($state_id)
    {
        return DB::table('lgas')->where('state_id', $state_id)->get();
    }

    /**
     * Retrieves the name of the nationality with the given ID.
     *
     * @param int $id The ID of the nationality to retrieve.
     * @return string The name of the nationality.
     */
    public static function nation($id)
    {
        return DB::table('nationalities')->where('id', $id)->first()->name;
    }

    /**
     * Retrieves the name of the country with the given ID.
     *
     * @param int $id The ID of the country to retrieve.
     * @return string The name of the country.
     */
    public static function country($id)
    {
        return DB::table('countries')->where('id', $id)->first()->name;
    }

    /**
     * Retrieves the name of the state with the given ID.
     *
     * @param int $id The ID of the state to retrieve.
     * @return string The name of the state.
     */
    public static function state($id)
    {
        return DB::table('states')->where('id', $id)->first()->name;
    }

    /**
     * Retrieves the name of the local government area (LGA) with the given ID.
     *
     * @param int $id The ID of the LGA to retrieve.
     * @return string The name of the LGA.
     */
    public static function lga($id)
    {
        return DB::table('lgas')->where('id', $id)->first()->name;
    }

    /**
     * Checks if the current authenticated user has the 'ADMIN' role.
     *
     * @return bool True if the user has the 'ADMIN' role, false otherwise.
     */
    public static function isAdmin()
    {
        return auth()->user()->role == 'ADMIN';
    }

    /**
     * Checks if the current authenticated user has the 'MANAGER' role.
     *
     * @return bool True if the user has the 'MANAGER' role, false otherwise.
     */
    public static function isManager()
    {
        return auth()->user()->role == 'MANAGER';
    }

    /**
     * Checks if the current authenticated user has the 'USER' role.
     *
     * @return bool True if the user has the 'USER' role, false otherwise.
     */
    public static function isUser()
    {
        return auth()->user()->role == 'USER';
    }

    /**
     * Retrieves the initials of the given name.
     *
     * @param string $name The name to get the initials for.
     * @return string The initials of the name.
     */
    public function getInitials($name)
    {
        $return = trim(collect(explode(' ', $name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(''));

        return $return;
    }

    /**
     * Generates the game time string based on the provided game object.
     *
     * @param \App\Models\Game $game The game object to generate the time string for.
     * @return string The formatted game time string.
     */
    public function getGameTime($game)
    {
        $recurrenceMap = [
            'hourly' => 'Every Hour',
            'every_2_hours' => 'Every 2 Hours',
            'every_4_hours' => 'Every 4 Hours',
            'every_8_hours' => 'Every 8 Hours',
            'every_12_hours' => 'Every 12 Hours',
            'daily' => 'Every Day',
            'twice_a_week' => 'Every Tuesday and Saturday',
            'weekly' => 'Every Saturday',
            'bi_weekly' => 'Every Other Saturday',
            'monthly' => 'Every 1st of the Month',
            'every_2_months' => 'Every 2 Months',
            'every_3_months' => 'Every 3 Months',
            'every_6_months' => 'Every 6 Months',
            'yearly' => 'Every Year',
        ];

        $recurrenceText = $recurrenceMap[$game->recurrence] ?? 'Unknown Recurrence';
        $drawTime = \Carbon\Carbon::createFromFormat('H:i:s', $game->draw_time)->format('g:i A');

        return "{$recurrenceText} at {$drawTime}";
    }

    /**
     * Generates an array of random lucky numbers.
     *
     * @param int $count The number of lucky numbers to generate.
     * @return string The JSON-encoded array of lucky numbers.
     */
    public function generateLuckyNumbers($count)
    {
        $luckyNumbers = collect(range(1, 99))->random($count)->values()->toArray();
        return json_encode($luckyNumbers);
    }

    public function showJackpot()
    {
        return false;
    }
}
