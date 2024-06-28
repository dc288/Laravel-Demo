<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table="customers";
    protected $primaryKey="id";

    function setFirstNameAttribute($value){
        $this->attributes["firstname"]=ucwords($value);
    }
    function setLastNameAttribute($value){
        $this->attributes["lastname"]=ucwords($value);
    }
    function setAddressAttribute($value){
        $this->attributes["address"]=ucwords($value);
}

}
