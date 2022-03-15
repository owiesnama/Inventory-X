<?php

namespace App\Http\Livewire;

use App\Models\Warehouse;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use Livewire\Component;


class Warehouses extends Component
{
    use WithPerPagePagination, WithSorting;
    public $showModal = false;
    public $warehouse;
    public $deleting;
    public $search = "";
    public $singleWarehouse;


    protected $rules = [
        'deleting' => 'sometimes',
        'warehouse.title' => "required",
        "warehouse.Address" => "required",

    ];

    public function save()
    {

        $this->validate();
        $this->warehouse->save();
        $this->showModal = false;
        session()->flash('message', 'A new warehouse has been added');
    }


    public function create()
    {
        $this->warehouse = $this->makeBlankItem();
        $this->showModal = true;
    }
    public function makeBlankItem()
    {
        return Warehouse::make(['title' => ""]);
    }


    public function edit(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
        $this->showModal = true;
    }

    public function showModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function delete(Warehouse $warehouse)
    {
        $this->deleting = $warehouse;
    }

    public function destroy()
    {
        $this->deleting->delete();
        $this->deleting = "";
    }

    public function render()
    {

        return view('livewire.warehouse', [
            'warehouses' => $this->applyPagination($this->applySorting(Warehouse::search($this->search))),
        ]);
    }
}
