<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class ItemsWarehouse extends Model
{
    use HasFactory,Searchable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'warehouse_id' => 'integer',
        
    ];
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'cost' => $this->cost,
        ];
    }

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class);
    }
}
