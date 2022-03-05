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
    public $isUpdating = false;

    public $item = [];
    public $itemToDelete;
    public $singleItem;

    public function store()
    {

        $this->validate([
            'item.name' => "required",
            "item.price" => "required",
            "item.cost" => "required",
            "item.expire_date" => "nullable",
        ]);

        Item::create($this->item);

        $this->isAddingNewItem = false;

        session()->flash('message', 'A new item has been added');
    }

    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

    public function update($id)
    {
        $this->isUpdating = !$this->isUpdating;

        $item = Item::find($id);
        $this->singleItem = $item;
        $this->item = $item->toArray();
    }
    public function edit()
    {
        $item = Item::find($this->singleItem)->first();
        $item->update([
            'name' => $this->item['name'],
            'price' => $this->item['price'],
            'cost' => $this->item['cost'],
            'expire_date' => $this->item['expire_date'],
        ]);

        $this->isUpdating = !$this->isUpdating;
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
