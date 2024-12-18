<?php

namespace App\Traits;

trait MustUpdateProfile
{
    public function hasUpdatedPrfofile() : bool
    {
        return ! is_null($this->profile_updated_at);
    }


}
