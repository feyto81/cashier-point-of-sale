<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stockout';
    protected $primaryKey = 'stockout_id';
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
