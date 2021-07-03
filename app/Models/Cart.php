<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
