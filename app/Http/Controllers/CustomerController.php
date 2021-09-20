<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Customer;
use \DB;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function checkData(array $data)
    {
        return Validator::make($data, [
            'sso_user_id'=> 'required|integer',
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone'=> 'required|integer',
            'email'=> 'required|string',
            'fonction'=> 'required|string',
            'org_id' => 'required|integer',

        ]);
    }

    public function showAllCustomers()
        {
            return DB::select('call customerShowAll_proc()');
        }

        public function showOneCustomer($customer_id)
        {
            return DB::select('call customerShow_proc(?)', array($customer_id));
        }

        public function createCustomer(Request $request)
        {
            $data=array(
                        'sso_user_id'=>$request->sso_user_id,
                        'name'=>$request->name,
                        'surname'=>$request->surname,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'fonction'=>$request->fonction,
                        'org_id'=>$request->org_id,
                       );
            if($this->checkData ($data))
                    {

                        DB::select(' call customerCreate_proc (?,?,?,?,?,?,?)', array ( $data['sso_user_id'], $data['name'], $data['surname'], $data['phone'],$data['email'], $data['fonction'], $data['org_id']));
                        return response()->json(['status'=>'success 200','message'=>'Customer has created successfully ']);
                    }


                    else
                    {
                        return response()->json(['status'=>'error','message'=>'Customer as not been registred']);

                    }
        }

        public function updateCustomer($customer_id, Request $request)
        {
           $data=array(
                      'customer_id'=>$request->customer_id,
                      'name'=>$request->name,
                      'surname'=>$request->surname,
                      'phone'=>$request->phone,
                      'email'=>$request->email,
                      'fonction'=>$request->fonction,
                      'org_id'=>$request->org_id,
                      );

            return DB::select(' call customerUpdate_proc (?,?,?,?,?,?,?)', array ($customer_id, $data['name'], $data['surname'], $data['phone'], $data['email'], $data['fonction'], $data['org_id']));

        }

        public function deleteCustomer($customer_id)
        {

          DB::select( 'call customerDelete_proc(?)',array($customer_id));
          return response()->json(['status'=>'success','message'=>'Customer has was deleted successfully ']);
        }

}
