<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Storage;
use Livewire\Component;
use Symfony\Component\Console\Input\Input;


class StorageItems extends Component
{
    public $storage;
    public $isAddingNewItem = false;
    public $storageItem = [];
    public $item = [];
    public $quantity ;
    
  

    public function store(){
   

        $storage = Storage::find($this->storage)->first();
        

        for ($i=1; $i <= $this->quantity; $i++) {
            $storage->items()->attach([$this->item]);
          } 

          $this->isAddingNewItem = false;
      
    }


    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

   

    public function mount(Storage $storage)
    {
        $this->storage = $storage;
    }
    
    
    public function render()
    {
        
        $items = Item::all();
            
           
           $Storage = Storage::all();
        //    $Storage = items()->groupBy('item_id');
        //    dd($Storage);
                
        return view('livewire.storage-items', [
            'storage' => $this->storage->items()->groupBy('item_id'),
            
            'items' => $items
            
        ]);
    }
}
