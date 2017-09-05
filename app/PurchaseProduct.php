<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = ['purchase_id',
						   'product_id',
						   'purchase_price',						  
						   'quantity',
						   'total_purchase'
						   ];
    
	public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
