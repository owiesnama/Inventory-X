<?php

namespace App\Http\Livewire;

use App\Actions\Purchasements\CreateInvoice;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\Item;
use App\Models\Purchasement;
use App\Models\Warehouse;
use Livewire\Component;

class Purchasements extends Component
{
    use WithPerPagePagination;
    public $isAddingNewItem = false;
    public $isUpdating = false;
    public $isDeleting = false;
    public $invoice;
    public $invoiceItems;
    public $invoiceToDelete;
    public $search = "";

    protected $rules = [
        'invoice.vendor' => "required",
        'invoiceItems' => "required",
        'invoiceItems.*.item_id' => "required",
        'invoiceItems.*.quantity' => "required",
        'invoiceItems.*.warehouse' => "required",
        'invoiceItems.*.cost' => "required",
    ];

    protected $messages = [
        'invoice.vendor.required' => "Vendor name must be present",
        'invoiceItems.required' => "At least one item should be present",
        'invoiceItems.*.item_id.required' => "Items should be selected",
        'invoiceItems.*.quantity.required' => "Quantity must be present",
        'invoiceItems.*.warehouse.required' => "Warehouse must be selected",
        'invoiceItems.*.cost.required' => "Cost must be present",
    ];

    public function store()
    {
        $this->validate();
        (new CreateInvoice)(collect($this->invoiceItems), $this->invoice['vendor']);
        $this->isAddingNewItem = false;
    }

    public function confirmingDeletion($stock)
    {
        $this->isDeleting = true;
        $this->stockToDelete = $stock;
    }

    public function destroy()
    {
        Purchasement::find($this->invoiceToDelete['id'])->delete();
        $this->isDeleting = false;
    }

    public function toggleAddingModal()
    {
        $this->isAddingNewItem = !$this->isAddingNewItem;
    }

    public function render()
    {
        return view('livewire.purchasements', [
            'warehouses' =>  Warehouse::all(),
            'items' =>  Item::all(),
            'purchasements' =>  Purchasement::with('vendor')->paginate($this->perPage),
        ]);
    }
}
