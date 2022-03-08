<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\ItemsWarehouse;
use Livewire\Component;
use Livewire\WithPagination;



class WarehouseItems extends Component
{
    public $warehouse;
    public $isAddingNewItem = false;
    public $isUpdating = false;
    public $isDeleting = false;
    public $warehouseItem = [];
    public $item = [];
    public $itemToDelete;
    public $quantity ;
    public $perPage = 10;
    public $search = "";
    
  

    public function store(){
     
        
        $quantity = ItemsWarehouse::where('item_id' , $this->item)->first();

        if($quantity){

            $warehouse = ItemsWarehouse::updateOrCreate(['item_id' => $this->item],[
                'warehouse_id' => $this->warehouse->id,
                'quantity' => ($this->quantity) + ($quantity->quantity),
                
            ]);

        }else {

            $warehouse = ItemsWarehouse::updateOrCreate(['item_id' => $this->item],[
                'warehouse_id' => $this->warehouse->id,
                'quantity' => ($this->quantity),
                
            ]);

        }
        
        
          $this->isAddingNewItem = false;
      
    }

    public function confirmingDeletion($item)
    {
        $this->isDeleting = true;
        $this->itemToDelete = $item;
    }

    public function destroy()
    {
        ItemsWarehouse::find($this->itemToDelete['id'])->delete();
        $this->isDeleting = false;
    }


    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

   

    public function mount(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
        
        
    }
    
    



    public function render()
    {
        
        $items = Item::all();     
        return view('livewire.warehouse-items', [
            'items' => $items,
            'data' => ItemsWarehouse::where('warehouse_id', $this->warehouse->id)->paginate($this->perPage), 
            
        ]);
    }
}
