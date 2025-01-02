<?php

namespace App\Livewire\Jetstream;

use App\Models\Transaction;
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
            'pendingTransactions' => $this->getPendingTransactions(),
        ]);
    }

    public function getPendingTransactions()
    {
        return Transaction::where('status', 'pending')->count();
    }
}
