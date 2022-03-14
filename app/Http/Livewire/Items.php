<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    use WithPerPagePagination, WithSorting;

    public $search = '';
    public $editing;
    public $deleting;
    public $showModal;
    public $showConfirmationModal;

    protected $rules = [
        'deleting' => 'sometimes',
        'editing.name' => "required",
        "editing.price" => "required",
        "editing.expire_date" => "nullable",
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showModal = false;
        session()->flash('message', 'A new item has been added');
    }

    public function create()
    {
        $this->editing = $this->makeBlankItem();
        $this->showModal = true;
    }
    public function edit(Item $item)
    {
        $this->editing = $item;
        $this->showModal = true;
    }

    public function makeBlankItem()
    {
        return Item::make(['expire_date' => now()->addYear(4)->toDateString()]);
    }

    public function delete(Item $item)
    {
        $this->deleting = $item;
        $this->showConfirmationModal = true;
    }

    public function destroy()
    {
        $this->deleting->delete();
        $this->showConfirmationModal = true;
    }

    public function render()
    {
        return view('livewire.items', [
            'items' => $this->applyPagination($this->applySorting(Item::search($this->search))),
        ]);
    }
}
