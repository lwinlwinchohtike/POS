<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
// Author: Nwe Ni Ei Kyaw 
class Supplier extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = ['company_name','suppliername', 'email', 'phoneno', 'address'
    //, 'tax'
    ];
}
