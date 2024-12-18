<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use App\Helpers\Helpers;

class UpdateProfile extends Component
{
    public $username;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $dob;
    public $gender;
    public $phone_number;
    public $address;
    public $nationality;
    public $country;
    public $state;
    public $lga;

    public function update()
    {
        $this->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'sometimes',
            'dob' => 'required',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'country' => 'required',
            'state' => 'required',
            'lga' => 'required'
        ]);

        $user = User::find(auth()->user()->id);
        $user->user_name = strtolower($this->username);
        $user->first_name = strtolower($this->first_name);
        $user->last_name = strtolower($this->last_name);
        $user->middle_name = strtolower($this->middle_name);
        $user->phone = $this->phone_number;
        $user->address = $this->address;
        $user->lgas_id = $this->lga;
        $user->states_id = $this->state;
        $user->countries_id = $this->country;
        $user->nationalities_id = $this->nationality;
        $user->gender = strtolower($this->gender);
        $user->dob = $this->dob;
        $user->updated_at = now();
        $user->profile_updated_at = now();
        $user->save();
        return redirect(route('dashboard'));
    }

    public function updatedState()
    {
        $this->lga = null;
        $this->getLga();
    }

    public function getLga()
    {
        return Helpers::getLgas($this->state);
    }

    public function render()
    {
        return view('profile.wizard',[
            'nationalities' => Helpers::getNationalities(),
            'countries' => Helpers::getCountries(),
            'states' => Helpers::getStates(),
            'lgas' => $this->getLga(),
        ]);
    }
}
