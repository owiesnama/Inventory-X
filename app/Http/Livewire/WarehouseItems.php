<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Warehouse;
use Livewire\Component;
use Symfony\Component\Console\Input\Input;


class WarehouseItems extends Component
{
    public $warehouse;
    public $isAddingNewItem = false;
    public $isUpdating = false;
    public $warehouseItem = [];
    public $item = [];
    public $quantity ;
    
  

    public function store(){
        $warehouse = Warehouse::find($this->warehouse)->first();
        dd($warehouse->id);
        
        for ($i=1; $i <= $this->quantity; $i++) {
            $warehouse->items()->attach([$this->item]);
          } 
          $this->isAddingNewItem = false;
      
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
            
           
           $warehouse = Warehouse::all();
        
                
        return view('livewire.warehouse-items', [
            'warehouse' => $this->warehouse->items()->groupBy('item_id'),
            'items' => $items
            
        ]);
    }
}
