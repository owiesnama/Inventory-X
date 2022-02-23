<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Items extends Component
{
    public $state = [];
    
    // ADD Items
    public function AddItem()
    {
      
        $validatedDate = Validator::make($this->state, [
            
            'name' => "required",
            "price" => "required",
            "cost" => "required",
            "expired_date" => "nullable",
            
        ])->validate();
        Item::create($validatedDate);
        return back();
    }

    

        // Delete
    public function delete($ItemID)
    {
        
        $item = Item::findOrFail($ItemID)->delete();
        return back();
        
    }

    
    public function render()
    {
        $items = Item::all();
        return view('livewire.items', [
            'items' => $items,
        ]);
    }
}
