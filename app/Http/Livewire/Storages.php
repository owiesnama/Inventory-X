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
    public $isUpdating = false;
    public $isDeleting = false;
    public $storageToDelete;
    public $storage = [];
    public $itemToDelete;
    public $perPage = 10;
    public $search = "";
    public $singleStorage;



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

    public function update($id)
    {
        $this->isUpdating = !$this->isUpdating;

        $storage = Storage::find($id);
        $this->singleStorage = $storage;
        $this->storage = $storage->toArray();
    }
    public function edit()
    {
        $storage = Storage::find($this->singleStorage)->first();
        $storage->update([
            'title' => $this->storage['title'],
            'Address' => $this->storage['Address'],
        ]);

        $this->isUpdating = !$this->isUpdating;
    }

    public function toggleUpdaingModal()
    {
        $this->isUpdating = !$this->isUpdating;
    }



    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }




    public function confirmingDeletion($storage)
    {
        $this->isDeleting = true;
        $this->storageToDelete = $storage;
    }

    public function destroy()
    {
        Storage::find($this->storageToDelete['id'])->delete();
        $this->isDeleting = false;
    }
    public function render()
    {

        return view('livewire.storage', [
            'storages' => Storage::search($this->search)->paginate($this->perPage),
        ]);
    }
}
