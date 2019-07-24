<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
{
    public function inactive_order($order_id)
    {
     	DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status'=>'Pending']);
            Session::put('message','Order Cancelled!');
            return Redirect::to('manage-order');       
    }
    public function active_order($order_id)
    {
    	DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status'=>'Approved']);
            Session::put('message','Order Approved!');
            return Redirect::to('manage-order');
    }

    /*

	public function view_order($order_id)
  {
      $order_by_id=DB::table('tbl_order')
              ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
              ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
              ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
              ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
              ->where('tbl_order.order_id',$order_id)
              ->get();

       $view_order=view('admin.view_order')
               ->with('order_by_id',$order_by_id);
       return view('pages.adminLayout')
               ->with('admin.view_order',$view_order); 

                     // echo "<pre>";
                     //  print_r($order_by_id);
                     // echo "</pre>";

  }

	public function inactive_category($category_id){
            DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>0]);
            Session::put('message','Category Inactivated Successfully!');
            return Redirect::to('all-category');
      }
      public function active_category($category_id){
        DB::table('tbl_category')
        ->where('category_id',$category_id)
        ->update(['publication_status'=>1]);
        Session::put('message','Category Activated Successfully!');
        return Redirect::to('all-category');
      }
    */
    
}
