<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    private $service;

    public function __construct(CustomerService $service){

        $this->service = $service;

    }
    
    // Save Customers
    public function store($info){

        return $this->service->saveCustomer( $info );

    }

    // Save Customers
    public function upd($info){

        return $this->service->updateCustomer( $info );

    }

    // Search Customers
    public function searchCustomers($search){

        return $this->service->searchCustomers( $search );

    }

    // Search Customer Address
    public function searchCustomerAdrressByCustomerId($customer_id){

        return $this->service->searchCustomerAdrressByCustomerId( $customer_id );

    }


    
}
