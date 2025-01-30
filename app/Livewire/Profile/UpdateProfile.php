<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use App\Helpers\Helpers;
use App\Models\Wallet;
use App\Services\Paystack;

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
    public $state;
    public $lga;

    public function update()
    {
        $this->validate([
            'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'dob' => 'required',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required',
            'address' => 'required',
            'nationality' => 'required',
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
        $user->nationalities_id = $this->nationality;
        $user->gender = strtolower($this->gender);
        $user->dob = $this->dob;
        $user->updated_at = now();
        $user->profile_updated_at = now();
        $user->save();
        $wallet = new Wallet();
        $wallet->user_id = auth()->user()->id;
        $wallet->save();

        $this->dispatch('notification', [
            'message' => 'Profile updated successfully',
            'type' => 'success',
        ]);
        $this->dispatch('redirect', url: route('dashboard'));
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

    public function mount()
    {
        $user = User::find(auth()->user()->id);
        $this->username = $user->user_name;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->middle_name = $user->middle_name;
        $this->dob = $user->dob;
        $this->gender = $user->gender;
        $this->phone_number = $user->phone;
        $this->address = $user->address;
        $this->nationality = $user->nationalities_id;
        $this->state = $user->states_id;
        $this->lga = $user->lgas_id;
    }

    public function render()
    {
        return view('profile.wizard',[
            'nationalities' => Helpers::getNationalities(),
            'states' => Helpers::getStates(),
            'lgas' => $this->getLga(),
        ]);
    }
}
