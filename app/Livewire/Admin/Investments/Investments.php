<?php

namespace App\Livewire\Admin\Investments;

use Livewire\Component;
use App\Models\DailyCheckin;

class Investments extends Component
{

    public function render()
    {
        return view('admin.investments.investments',
            [
                // 'investments' => Investment::all()
            ]
        );
    }
}
