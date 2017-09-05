<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Customer extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = ['name', 'email', 'phonenumber','address','company_name'];
}
