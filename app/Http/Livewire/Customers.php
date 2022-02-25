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
    public $customer = [];
    public $itemToDelete;
    public $perPage = 10;
    public $search = 10;

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
