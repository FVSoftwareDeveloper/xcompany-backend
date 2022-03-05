<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    //
    protected $table = 'public.customers';

    protected $fillable = ['tax_id', 'description', 'phone', 'email', 'active','created_at', 'updated_at']; 

    
}
