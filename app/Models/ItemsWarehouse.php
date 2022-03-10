<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class ItemsWarehouse extends Model
{
    use HasFactory, Searchable;

    protected $appends = ['totalCost'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'warehouse_id',
        'quantity'
    ];
    public function getTotalCostAttribute()
    {
        return  $this->item ? $this->quantity * $this->item->cost : 0 ;
    }

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'cost' => $this->cost,
        ];
    }
}
