<?php

namespace App\Services;

use App\CustomerModel;
use App\CustomerAddressModel;

class CustomerService{

    /**
     * Method to save Customer
     * 
     * @param $info
     */
    public function saveCustomer( $info ){
        //echo "Entro en el Servicio";

        $valores = json_decode( $info, true );

        //return print_r($valores);

        //return sizeof($valores[0]['address']);
        // exit;
        try{

            $add_customer = new CustomerModel();
            $add_customer->tax_id = $valores[0]['taxId'];
            $add_customer->description = strtoupper($valores[0]['name']);
            $add_customer->phone = $valores[0]['phone'];
            $add_customer->email = $valores[0]['email'];
            $add_customer->save();

            foreach($valores[0]['address'] as $Address){
                //return $Address['Address'];
                $add_customer_address = new CustomerAddressModel();
                $add_customer_address->id_customer = $add_customer->id;
                $add_customer_address->description = $Address['Address'];
                $add_customer_address->save();

            }
            

        } catch(Exception $e){
            return $e->getMessage();
        }


        return response()->json("Saved!!");

    }


    /**
     * Method to update Customer
     * 
     * @param $info
     */
    public function updateCustomer( $info ){
        //echo "Entro en el Servicio";

        $valores = json_decode( $info, true );

        //return print_r($valores);

        //return sizeof($valores[0]['address']);
        // exit;
        try{

            $upd_customer = CustomerModel::where('id', $valores[0]['customerId'])
            ->update([
                'tax_id' => strtoupper($valores[0]['taxId']),
                'description' => strtoupper($valores[0]['name']),
                'phone' => strtoupper($valores[0]['phone']),
                'email' => strtoupper($valores[0]['email']),
            ]);
             
            $del_address = CustomerAddressModel::where('id_customer', $valores[0]['customerId'])->delete();

             

            foreach($valores[0]['address'] as $Address){
                // return $Address['description'];
                $add_customer_address = new CustomerAddressModel();
                $add_customer_address->id_customer = $valores[0]['customerId'];
                $add_customer_address->description = $Address['Address'];
                $add_customer_address->save();

            }
            

        } catch(Exception $e){
            return $e->getMessage();
        }


        return response()->json("Updated!!");

    }

    /**
     * Method to save Customer
     * 
     * @param $info
     */
    public function searchCustomers( $search ){

        $result = CustomerModel::select('id','tax_id', 'description','phone', 'email')
        ->where('description','like', '%' . strtoupper($search) . '%')->get();

        return response()->json($result);
    }

    /**
     * Method to save Customer
     * 
     * @param $info
     */
    public function searchCustomerAdrressByCustomerId( $customer_id ){

        $result = CustomerAddressModel::select('description as Address')
        ->where('id_customer',$customer_id)->get();

        return response()->json($result);
    }

}