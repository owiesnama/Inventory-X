<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchasement extends BaseModel
{
    use HasFactory;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
