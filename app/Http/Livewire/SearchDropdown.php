<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $query;
    public $record = [];


    public function mount()
    {
        $this->rest();
    }
 
    public function rest()
    {
        $this->query = '';
        $this->record = [];
        $this->highlightIndex = 0;
    }
 
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->record) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->record) - 1;
            return;
        }
        $this->highlightIndex--;
    }
 
    public function selectRecord()
    {
        $record = $this->record[$this->highlightIndex] ?? null;
        // if ($record) {
        //     $this->redirect(route('show-contact', $record['id']));
        // }
    }
 
   
    public function updatedQuery()
    {
        $this->record = Vendor::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }
    public function render()
    {
        $record = Vendor::where('name', 'like' , '%', $this->query);
        return view('livewire.search-dropdown');
    }
}
