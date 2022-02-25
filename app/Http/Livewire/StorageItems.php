<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Storage;
use Livewire\Component;

class StorageItems extends Component
{
    public $storageId;
    


    public function mount($id){
     $this->storageId = $id;
    }

   
    public function render()
    {
       
        $storage = Storage::where('id', $this->storageId)->first();
        return view('livewire.storage-items', [
            'storage' => $storage,
        ]);
    }
}
