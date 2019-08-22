<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class SuperAdminController extends Controller
{
	  public function index()
    {
    	$this->AdminAuthCheck();
      $all_product_info=DB::table('tbl_products')
                     ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                     ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                     ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                     ->get();
       $manage_product=view('admin.all_product')
               ->with('all_product_info',$all_product_info);
       return view('pages.adminLayout')
               ->with('admin.all_product',$manage_product);
    }
    public function deliveryManIndex()
    {
      $this->deliveryManAuthCheck();
      return view('pages.deliveryManDashboard');
    }
    public function deliveryManlogout(){
        Session::flush();
        return Redirect::to('/deliveryMan');
    }
    public function logout(){
        Session::flush();
        return Redirect::to('/admin');
    }
    public function AdminAuthCheck()
    {
      $admin_id=Session::get('admin_id');
      
      if ($admin_id) {
      	 return;
      }else{
         return Redirect::to('/admin')->send();
      }
    }
    public function deliveryManAuthCheck()
    {
      $deliveryMan_id=Session::get('deliveryMan_id');
      
      if ($deliveryMan_id) {
         return;
      }else{
         return Redirect::to('/deliveryMan')->send();
      }
    }
}
