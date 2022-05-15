<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesInvoices extends Component
{

    public $isAddingNewItem = false;


    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

    public function render()
    {
        return view('livewire.sales-invoices');
    }
}
