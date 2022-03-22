<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\ItemsWarehouse;
use Livewire\Component;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;


class WarehouseItems extends Component
{

    use WithPerPagePagination, WithSorting;

    public $warehouse;
    public $isAddingNewItem = false;
    public $isDeleting = false;
    public $ItemsWarehouse;
    public $stockToDelete;
   
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
