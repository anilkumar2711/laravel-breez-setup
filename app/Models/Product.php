<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name', 'description', 'quantity'];
    protected $casts = [
        'quantity' => 'integer',
    ];

    public function transactions() {
        return $this->hasMany(StockTransaction::class);
    }

}
