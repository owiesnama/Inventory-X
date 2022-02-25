<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $isAddingNewItem = false;
    public $isDeleting = false;
    public $item = [];
    public $itemToDelete;

    public function store()
    {

        $this->validate([
            'item.name' => "required",
            "item.price" => "required",
            "item.cost" => "required",
            "item.expired_date" => "nullable",
        ]);

        Item::create($this->item);

        $this->isAddingNewItem = false;

        session()->flash('message', 'A new item has been added');
    }

    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

    public function confirmingDeletion($item)
    {
        $this->isDeleting = true;
        $this->itemToDelete = $item;
    }

    public function destroy()
    {
        Item::find($this->itemToDelete['id'])->delete();
        $this->isDeleting = false;
    }
    public function render()
    {
        return view('livewire.items', [
            'items' => Item::search($this->search)->paginate($this->perPage),
        ]);
    }
}
