<?php

namespace App\Http\Livewire;

use App\Models\Customers as ModelsCustomers;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Customers extends Component
{
    public $state = [];
    public function AddCustomer()
    {
      
        $validatedDate = Validator::make($this->state, [
            
            'name' => "required",
            "address" => "required",
            "phone_number" => "required",
            
            
        ])->validate();
        ModelsCustomers::create($validatedDate);
        return back();
    }

        // Delete
        public function delete($id)
        {
            
            $item = ModelsCustomers::findOrFail($id)->delete();
            return back();
            
        }

    public function render()
    {
        $customers = ModelsCustomers::all();
        return view('livewire.customers', [
            'customers' => $customers,
        ]);
    }
}
