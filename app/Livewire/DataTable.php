<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

trait DataTable
{
    use WithPagination, WithoutUrlPagination;

    /**
     * The number of records to display per page in the data table.
     *
     * @var int
     */
    public $perPage = 10;

    /**
     * The search term used to filter the data in the data table.
     *
     * @var string
     */
    public $search = '';

    /**
     * Indicates the direction to sort the data, either 'ASC' for ascending or 'DESC' for descending.
     *
     * @var string
     */
    public $direction = 'DESC';

    /**
     * The column to sort the data by.
     *
     * @var string
     */
    public $column = 'id';

    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * The ID of the record to be deleted.
     *
     * @var int|null
     */
    public $deleteId = null;

    /**
     * Sorts the data in the schools table based on the given column.
     *
     * @param string $column The column to sort the data by.
     * @return void
     */
    public function doSort($column): void
    {
        if ($this->column !== $column) {
            $this->column = $column;
        }

        $this->direction = $this->direction == 'DESC' ? 'ASC' : 'DESC';
        $this->resetPage();
    }

    /**
     * Resets the page and hides the modal when the search input is updated.
     *
     * @return void
     */
    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    /**
     * Handles updating the search query.
     *
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion($id)
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatch('confirming-delete');

        $this->confirmingUserDeletion = true;

        $this->deleteId = $id;
    }

    /**
     * Confirms the user's password and deletes the account with the given ID.
     *
     * @return void
     */
    public function confirm()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $this->delete($this->deleteId);

        $this->confirmingUserDeletion = false;
    }

    public function paginationView()
    {
        return 'components.paginate';
    }
}
