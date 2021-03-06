<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends BaseModel
{
    use HasFactory;
   
    protected $fillable = ['name','address','phone_number'];


}
