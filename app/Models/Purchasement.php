<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasement extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'items' => AsCollection::class
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class,'item_purchasements')->withPivot([
            'quantity',
            'warehouse_id',
        ]);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
