<?php

namespace App\Http\Livewire;

use App\Models\Warehouse;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Warehouses extends Component
{
    use WithPagination;
    public $isAddingNewItem = false;
    public $isUpdating = false;
    public $isDeleting = false;
    public $warehouseToDelete;
    public $warehouse = [];
    public $itemToDelete;
    public $perPage = 10;
    public $search = "";
    public $singleWarehouse;



    public function store()
    {

        $this->validate([
            'warehouse.title' => "required",
            "warehouse.Address" => "required",
        ]);

        Warehouse::create($this->warehouse);

        $this->isAddingNewItem = false;

        session()->flash('message', 'A new warehouse has been added');
    }

    public function update($id)
    {
        $this->isUpdating = !$this->isUpdating;

        $warehouse = Warehouse::find($id);
        $this->singleWarehouse = $warehouse;
        $this->warehouse = $warehouse->toArray();
    }
    public function edit()
    {
        $warehouse = warehouse::find($this->singleWarehouse)->first();
        $warehouse->update([
            'title' => $this->warehouse['title'],
            'Address' => $this->warehouse['Address'],
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
        Warehouse::find($this->warehouseToDelete['id'])->delete();
        $this->isDeleting = false;
    }
    public function render()
    {

        return view('livewire.warehouse', [
            'warehouses' => Warehouse::search($this->search)->paginate($this->perPage),
        ]);
    }
}
