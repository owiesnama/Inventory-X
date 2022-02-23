<?php

namespace App\Http\Livewire;

use App\Models\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Storages extends Component
{
    public $state = [];

    public function AddStorage()
    {
        $validatedDate = Validator::make($this->state, [
            
            'title' => "required",
            "Address" => "required",

        ])->validate();

        Storage::create($validatedDate);
        return back();
    }

    
    // Delete
    public function delete($ItemID)
    {
        
        $item = Storage::findOrFail($ItemID)->delete();
        return back();
        
    }

    public function render()
    {
        $storage = Storage::all();
        return view('livewire.storage', [
            'storage' => $storage,
        ]);
    }
}
