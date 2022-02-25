<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Storage;
use Livewire\Component;

class StorageItems extends Component
{
    public $storage;
    


    public function mount(Storage $storage){
     $this->storage = $storage;
    }

   
    public function render()
    {
       
        return view('livewire.storage-items', [
            'storage' => $this->storage,
        ]);
    }
}
