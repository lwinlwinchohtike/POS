<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
	protected $fillable = ['sale_id',
						   'product_id',
						   'purchase_price',
						   'retail_price',
						   'quantity',
						   'total_purchase',
						   'total_retail'];
    
	public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
