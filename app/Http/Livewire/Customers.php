<?php

namespace App\Http\Livewire;

use App\Models\Customer;

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
        Customer::create($validatedDate);
        return back();
    }

        // Delete
        public function delete($id)
        {
            
            $item = Customer::findOrFail($id)->delete();
            return back();
            
        }

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.customers', [
            'customers' => $customers,
        ]);
    }
}
