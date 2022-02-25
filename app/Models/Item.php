<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{
    use HasFactory,Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'cost',
        'expire_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'expire_date' => 'timestamp',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'cost' => $this->cost,
        ];
    }

    public function storages(){
      
            return $this->belongsToMany(Storage::class);
       
    }
}
