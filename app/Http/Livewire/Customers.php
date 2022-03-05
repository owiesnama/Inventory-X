<?php

namespace App\Http\Livewire;

use App\Models\Customer;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;
    public $isAddingNewItem = false;
    public $isDeleting = false;
    public $isUpdating = false;
    public $customer = [];
    public $itemToDelete;
    public $perPage = 10;
    public $search = "";
    public $singleCustomer;



    public function store()
    {

        $this->validate([
            'customer.name' => "required",
            "customer.address" => "required",
            "customer.phone_number" => "required",
        ]);

        Customer::create($this->customer);

        $this->isAddingNewItem = false;

        session()->flash('message', 'A new customer has been added');
    }
    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

    public function update($id)
    {
        $this->isUpdating = !$this->isUpdating;

        $customer = Customer::find($id);
        $this->singleCustomer = $customer;
        $this->customer = $customer->toArray();
    }
    public function edit()
    {
        $customer = Customer::find($this->singleCustomer)->first();
        $customer->update([
            'name' => $this->customer['name'],
            'address' => $this->customer['address'],
            'phone_number' => $this->customer['phone_number'],
        ]);

        $this->isUpdating = !$this->isUpdating;
    }

    public function toggleUpdaingModal()
    {
        $this->isUpdating = !$this->isUpdating;
    }


    public function confirmingDeletion($item)
    {
        $this->isDeleting = true;
        $this->itemToDelete = $item;
    }
    public function destroy()
    {
        Customer::find($this->itemToDelete['id'])->delete();
        $this->isDeleting = false;
    }




    public function render()
    {

        
        return view('livewire.customers', [
            'customers' => Customer::search($this->search)->paginate($this->perPage),
           
        ]);
    }
}
