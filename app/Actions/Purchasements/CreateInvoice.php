<?php

namespace App\Actions\Purchasements;

use App\Models\ItemPurchasement;
use App\Models\ItemsWarehouse;
use App\Models\Purchasement;
use App\Models\Vendor;
use App\Models\Warehouse;
use Illuminate\Support\Collection;

class CreateInvoice
{
    public $vendor;
    public $items;
    public function __invoke(Collection $items, $vendor)
    {
        $this->items = $items;
        $this->vendor = $vendor;
        $this->saveInvoice()->addStockToWarehouses();
    }
    
    public function addStockToWarehouses()
    {
        foreach ($this->items as $item) {
            Warehouse::find($item['warehouse'])->addStock(new ItemsWarehouse($item));
        }
        return $this;
    }

    public function saveInvoice()
    {
        $purchasement = Purchasement::create([
            'vendor_id' => $this->getVendor()->id,
            'total_cost' => $this->getTotalCost(),
        ]);

        ItemPurchasement::insert($this->transformtItems($purchasement));

        return $this;
    }

    public function getVendor()
    {
        return Vendor::whereName($this->vendor)->firstOrCreate([
            "name" => $this->vendor
        ]);
    }

    public function getTotalCost()
    {
        return $this->items->reduce(fn ($carry, $item) => $carry += $item['quantity'] * $item['cost'], 0);
    }

    public function transformtItems($purchasement)
    {
        return $this->items->map(function ($item) use ($purchasement) {
            return [
                'item_id' => $item['item_id'],
                'warehouse_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'purchasement_id' => $purchasement->id,
            ];
        })->toArray();
    }
}
