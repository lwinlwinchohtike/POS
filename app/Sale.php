<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = ['customer_id', 'user_id', 'payment_id','comments'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
