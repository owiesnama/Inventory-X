<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsStorage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'storage_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'storage_id' => 'integer',
    ];

    public function item()
    {
        return $this->belongsTo(\App\Models\Items::class);
    }

    public function storage()
    {
        return $this->belongsTo(\App\Models\Storages::class);
    }
}
