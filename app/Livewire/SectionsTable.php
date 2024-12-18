<?php

namespace App\Livewire;

use App\Models\School;
use App\Models\Section;
use Illuminate\Routing\Route;
use Livewire\Component;

class SectionsTable extends Component
{
    use DataTable;

    public $id;
    public $name;

    public $school;
    public $class;

    /**
     * Stores a new section or updates an existing one.
     *
     * @return void
     */
    public function store(): void
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        $section = $this->school->classes()->find($this->class->id)->section()->updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'name' => $this->name,
                'school_id' => $this->school->id,
            ]
        );

        if ($section->wasRecentlyCreated) {
            $this->dispatch('notification', ['message' => 'New class section added successfully!', 'type' => 'success']);
        } else {
            $this->dispatch('notification', ['message' => 'Class section updated successfully!', 'type' => 'success']);
        }
        $this->dispatch('hide-modal');
        $this->dispatch('updated-sections-table');
        $this->close();
    }

    /**
     * Edits the specified section.
     *
     * @param Section $section The section to be edited.
     * @return void
     */
    public function edit(Section $section): void
    {
        $this->id = $section->id;
        $this->name = $section->name;
    }

    /**
     * Deletes the specified section.
     *
     * @param Section $class The section to be deleted.
     * @return void
     */
    public function delete(Section $class): void
    {
        $class->delete();
        $this->dispatch('updated-classes-table');
    }

    /**
     * Resets the component's state.
     */
    public function close(): void
    {
        $this->id = null;
        $this->name = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * Initializes the component by setting the current school.
     */
    public function mount()
    {
        $this->school = School::find(helpers()->getCurrentSchool(true)->id);
    }

    /**
     * Retrieves the sections for the current school and class, with optional search and sorting.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator The paginated sections.
     */
    public function getSections()
    {
        $sections = $this->school->classes()
            ->find($this->class->id)->section()
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
        return $sections;
    }

    /**
     * Renders the view for the sections table.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.classes.sections.sections-table', [
            'sections' => $this->getSections(),
        ]);
    }
}
