<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class SearchVendor extends Component
{
    public $query;
    public $vendors = [];


    public function mount()
    {
        $this->rest();
    }
 
    public function rest()
    {
        $this->query = '';
        $this->vendors = [];
        $this->highlightIndex = 0;
    }
 
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->vendors) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->vendors) - 1;
            return;
        }
        $this->highlightIndex--;
    }
 
    public function selectContact()
    {
        $contact = $this->contacts[$this->highlightIndex] ?? null;
        if ($contact) {
            $this->redirect(route('show-contact', $vendor['id']));
        }
    }
 
   
    public function updatedQuery()
    {
        $this->vendors = Vendor::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }
    public function render()
    {
        $vendor = Vendor::where('name', 'like' , '%', $this->query);
        return view('livewire.search-vendor');
    }
}
