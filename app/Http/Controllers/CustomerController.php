<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class CustomerController extends Controller
{
	public function index(){

            $all_order_info=DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->select('tbl_order.*','tbl_customer.customer_name')
            ->where('tbl_customer.customer_id',session()->get('customer_id'))
            ->get();
            $manage_order=view('pages.customerDashboard')
            ->with('all_order_info',$all_order_info);
            return view('pages.customerLayout')
            ->with('pages.customerDashboard',$manage_order);
        
    }
    public function login_check()
    {
      return view('pages.login1');
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
               session()->put('customer_name',$result->customer_name);
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

    public function my_orders(){
            $all_order_info=DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->select('tbl_order.*','tbl_customer.customer_name')
            ->where('tbl_customer.customer_id',session()->get('customer_id'))
            ->get();
            $manage_order=view('pages.customerDashboard')
            ->with('all_order_info',$all_order_info);
            return view('pages.customerLayout')
            ->with('pages.customerDashboard',$manage_order);                  
    }
    
     public function view_delivery($order_id){
            $order_by_id=DB::table('tbl_order')
              ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
              ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
              ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
              ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
              ->where('tbl_order.order_id',$order_id)
              ->get();
       $view_order=view('pages.view_delivery1')
               ->with('order_by_id',$order_by_id);
       return view('pages.customerLayout')
               ->with('pages.view_delivery1',$view_order); 
     }
     public function wishlist()
      {
       $all_wishlist_info=DB::table('tbl_wishlist')
                     ->join('tbl_category','tbl_wishlist.category_id','=','tbl_category.category_id')
                     ->join('tbl_manufacture','tbl_wishlist.manufacture_id','=','tbl_manufacture.manufacture_id')
                     ->select('tbl_wishlist.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                     ->get();
       $manage_wishlist=view('pages.wishlist')
               ->with('all_wishlist_info',$all_wishlist_info);
       return view('pages.customerLayout')
               ->with('pages.wishlist',$manage_wishlist); 
                       
   }
   public function delete_wishlist_item($product_id)
    {  
      DB::table('tbl_wishlist')
          ->where('product_id',$product_id)
          ->delete();
      Session::get('message','Wishlisted Item Deleted successfully! ');
      return Redirect::to('/wishlist');
    }
}
