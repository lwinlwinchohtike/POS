<?php
// Author: Nwe Ni Ei Kyaw 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = ['product_id', 'user_id', 'in_out_qty', 'remarks'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}
