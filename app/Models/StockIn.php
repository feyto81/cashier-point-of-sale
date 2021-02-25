<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Supplier;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stockin';
    protected $primaryKey = 'stockin_id';
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
