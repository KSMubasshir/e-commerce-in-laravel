<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SuperAdminController extends Controller
{
	  public function index()
    {
    	$this->AdminAuthCheck();
    	return view('admin.dashboard');
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
