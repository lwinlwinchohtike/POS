<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Product extends Model implements HasMedia
{ 
    use HasMediaTrait;

	protected $fillable = ['name',
						   'code',
						   'purchase_price',
						   'retail_price',
						   'quantity',
						   'description',
						   'category_id'];

	public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
