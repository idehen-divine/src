<?php

namespace App\Livewire\User\History;

use App\Livewire\DataTable;
use Livewire\Component;

class History extends Component
{
    use DataTable;

    public function render()
    {
        return view('user.history.history', [
            'histories' => $this->getHistories()
        ]);
    }

    public function getHistories()
    {
        return helpers()->getAuthUser()->transactions()->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
    }
}
