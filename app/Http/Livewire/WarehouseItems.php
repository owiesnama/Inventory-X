<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\ItemsWarehouse;
use Livewire\Component;



class WarehouseItems extends Component
{
    public $warehouse;
    public $isAddingNewItem = false;
    public $isUpdating = false;
    public $isDeleting = false;
    public ItemsWarehouse $stock;
    public $stockToDelete;
    public $perPage = 10;
    public $search = "";

    protected $rules = [
        'stock.item_id' => 'required',
        'stock.quantity' => 'required',
    ];


    public function store()
    {
        $this->validate();
        $this->warehouse->addStock($this->stock);
        $this->isAddingNewItem = false;
    }

    public function confirmingDeletion($stock)
    {
        $this->isDeleting = true;
        $this->stockToDelete = $stock;
    }

    public function destroy()
    {
        ItemsWarehouse::find($this->stockToDelete['id'])->delete();
        $this->isDeleting = false;
    }

    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }
    
    public function mount(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
        $this->stock = new ItemsWarehouse;
    }

    public function render()
    {
        return view('livewire.warehouse-items', [
            'items' =>  Item::all(),
            'stocks' =>  $this->warehouse->stock()->paginate($this->perPage),
        ]);
    }
}
