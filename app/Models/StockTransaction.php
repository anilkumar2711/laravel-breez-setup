<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    //
    protected $fillable = ['product_id', 'quantity', 'transaction_type', 'description'];
    protected $casts = [
        'quantity' => 'integer',
        'transaction_type' => 'string',
    ];
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
