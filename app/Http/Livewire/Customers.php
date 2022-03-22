<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use Livewire\Component;

class Customers extends Component
{
    use WithPerPagePagination, WithSorting;
    public $showModal = false;
    public $customer;
    public $deleting;
    public $search = "";
    public $singleWarehouse;


    protected $rules = [
        'deleting' => 'sometimes',
        'customer.name' => "required",
        "customer.address" => "required",
        "customer.phone_number" => "required",

    ];

    public function save()
    {
        $this->validate();
        $this->customer->save();
        $this->showModal = false;
        session()->flash('message', 'A new customer has been added');
    }


    public function create()
    {
        $this->customer = $this->makeBlankItem();
        $this->showModal = true;
    }
    public function makeBlankItem()
    {
        return Customer::make(['name' => ""]);
    }


    public function edit(Customer $customer)
    {
        $this->customer = $customer;
        $this->showModal = true;
    }

    public function showModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function delete(Customer $customer)
    {
        $this->deleting = $customer;
    }

    public function destroy()
    {
        $this->deleting->delete();
        $this->deleting = "";
    }



    public function render()
    {


        return view('livewire.customers', [
            'customers' => $this->applyPagination($this->applySorting(Customer::search($this->search))),

        ]);
    }
}
