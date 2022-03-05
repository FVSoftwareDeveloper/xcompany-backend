<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddressModel extends Model
{
    //
    protected $table = 'public.customer_address';
   

    protected $fillable = ['id_customer', 'description','created_at', 'updated_at']; 
}
