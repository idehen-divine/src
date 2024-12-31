<?php

namespace App\Livewire\Jetstream;

use Livewire\Component;

class NavigationMenu extends Component
{
    public $activePage;

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function mount()
    {
        $this->activePage = request()->route()->getName();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('navigation-menu', [
            'balance' =>  auth()->user()->wallet ? auth()->user()->wallet->balance : 0.00,
        ]);
    }
}
