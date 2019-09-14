<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
class CustomerController extends Controller
{
	public function index(){
        return view('pages.deliveryManDashboard');
    }
    public function login_check()
    {
      return view('pages.login1');
    }
    public function showDashboard(){
        return view('pages.deliveryManDashboard');
    }

    public function customer_login(Request $request)
    {
      $customer_email=$request->customer_email;
      $password=md5($request->password);
      $result=DB::table('tbl_customer')
              ->where('customer_email',$customer_email)
              ->where('password',$password)
              ->first();
             if ($result) {
               Session::put('customer_id',$result->customer_id);
               session()->put('customer_id',$result->customer_id);
               return Redirect::to('/customer-profile');
             }else{
                return Redirect::to('/login-check');
             }
    }

    public function customer_registration(Request $request)
    {
      $data=array();
      $data['customer_name']=$request->customer_name;
      $data['customer_email']=$request->customer_email;
      $data['password']=md5($request->password);
      $data['mobile_number']=$request->mobile_number;
        $customer_id=DB::table('tbl_customer')
                    ->insertGetId($data);
               Session::put('customer_id',$customer_id);
               Session::put('customer_name',$request->customer_name);
               session()->put('customer_id',$customer_id);
               return Redirect('/customer-profile');
    }

    public function dashboard(Request $request){
        $deliveryMan_email = $request->deliveryMan_email ;
        $deliveryMan_password = md5($request->deliveryMan_password) ;
        $result = DB::table('tbl_deliveryMan')
                        ->where('deliveryMan_email',$deliveryMan_email)
                        ->where('deliveryMan_password',$deliveryMan_password)
                        ->first();
                        if($result){
                            Session::put('deliveryMan_name',$result->deliveryMan_name);
                            Session::put('deliveryMan_id',$result->deliveryMan_id);

                            $all_order_info=DB::table('tbl_order')
                            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                            ->select('tbl_order.*','tbl_customer.customer_name')
                            ->where('order_status','Approved')
                            ->get();
                            $manage_order=view('pages.deliveryManDashboard')
                            ->with('all_order_info',$all_order_info);
                            return view('pages.deliveryManLayout')
                            ->with('pages.deliveryManDashboard',$manage_order);
                        }else{
                            Session::put('message','Incorrect credentials');
                            return Redirect::to('/deliveryMan');
                        }
    }
    public function myOrders(){
            $all_order_info=DB::table('tbl_order')
                            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                            ->select('tbl_order.*','tbl_customer.customer_name')
                            ->where('order_status','Delivered')
                            ->get();
                            $manage_order=view('pages.deliveryManDashboard')
                            ->with('all_order_info',$all_order_info);
                            return view('pages.deliveryManLayout')
                            ->with('pages.deliveryManDashboard',$manage_order);                     
    }
    public function myDeliveredOrders(){
            $all_order_info=DB::table('tbl_order')
                            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                            ->select('tbl_order.*','tbl_customer.customer_name')
                            ->where('order_status','Approved')
                            ->get();
                            $manage_order=view('pages.deliveryManDashboard')
                            ->with('all_order_info',$all_order_info);
                            return view('pages.deliveryManLayout')
                            ->with('pages.deliveryManDashboard',$manage_order);
    }

    public function inactive_delivery($order_id)
    {
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status'=>'Approved']);
            Session::put('message','Order not Delivered!');
            return Redirect::to('deliveryManOrders');       
    }
    public function active_delivery($order_id)
    {
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status'=>'Delivered']);
            Session::put('message','Order Delivered!');
            return Redirect::to('deliveryManOrders');
    }
     public function view_delivery($order_id)
  {
      $order_by_id=DB::table('tbl_order')
              ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
              ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
              ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
              ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
              ->where('tbl_order.order_id',$order_id)
              ->get();
       $view_order=view('pages.view_delivery')
               ->with('order_by_id',$order_by_id);
       return view('pages.deliveryManLayout')
               ->with('pages..view_delivery',$view_order); 
  }
   public function delete_delivery($order_id){
            DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->delete();
            Session::put('message','Deilvery Deleted Successfully!');
            return Redirect::to('deliveryManOrders');
  }
}
