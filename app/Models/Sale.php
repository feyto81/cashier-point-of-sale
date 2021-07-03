<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $guarded = [];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
