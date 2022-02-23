<?php

namespace App\Http\Livewire;

use App\Models\Items as ItemModel;
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
        ItemModel::create($validatedDate);
        return back();
    }

    

        // Delete
    public function delete($ItemID)
    {
        
        $item = ItemModel::findOrFail($ItemID)->delete();
        return back();
        
    }

    
    public function render()
    {
        $items = ItemModel::all();
        return view('livewire.items', [
            'items' => $items,
        ]);
    }
}
