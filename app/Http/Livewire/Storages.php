<?php

namespace App\Http\Livewire;

use App\Models\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Storages extends Component
{
    use WithPagination;
    public $isAddingNewItem = false;
    public $isDeleting = false;
    public $storage = [];
    public $itemToDelete;


    public function store()
    {
        
        $this->validate([
            'storage.title' => "required",
             "storage.Address" => "required",
        ]);

        Storage::create($this->storage);

        $this->isAddingNewItem = false;

        session()->flash('message', 'A new storage has been added');
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
        Storage::find($this->itemToDelete['id'])->delete();
        $this->isDeleting = false;
    }
    public function render()
    {
        
        return view('livewire.storage', [
            'storages' => Storage::paginate(10),
        ]);
    }
}
