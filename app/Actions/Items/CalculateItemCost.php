<?php

namespace App\Actions\Purchasements;

use Illuminate\Support\Collection;

class CalculateItemCost{
    public $items; 
    
    public function __invoke(Collection $items)
    {
        $this->items = $items;
    }
}