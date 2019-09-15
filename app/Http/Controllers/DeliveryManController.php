<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class DeliveryManController extends Controller
{
   public function index(){
        return view('pages.deliveryManLogin');
    }
    public function showDashboard(){
        return view('pages.deliveryManDashboard');
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
                            session()->put('deliveryMan_id',$result->deliveryMan_id);


                            //$_SESSION["id"] = $result->deliveryMan_id;

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
            ;
            $all_order_info=DB::table('tbl_order')
                            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                            ->select('tbl_order.*','tbl_customer.customer_name')
                            ->where('order_status','Delivered')
                            ->where('tbl_order.deliveryMan_id', session()->get('deliveryMan_id'))
                            //->where('tbl_order.deliveryMan_id', "3")
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
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['deliveryMan_id'=> session()->get('deliveryMan_id')]);

        DB::table('tbl_order_details')
            ->where('order_id',$order_id)
            ->update(['deliveryMan_id'=> session()->get('deliveryMan_id')]);

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
              ->andWhere('tbl_order.deliveryMan_id', $_SESSION['deliveryMan_id'])
              ->andWhere('tbl_order_details.deliveryMan_id', $_SESSION['deliveryMan_id'])
              ->get();
       $view_order=view('pages.view_delivery')
               ->with('order_by_id',$order_by_id);
       return view('pages.deliveryManLayout')
               ->with('pages.view_delivery',$view_order); 
  }


  //admin opeartions on deliveryMan
  public function all_DeliveryMan(){
        $all_DeliveryMan_info = DB::table('tbl_deliveryMan')->get();
        $manage_DeliveryMan = view('admin.all_deliveryMan')
            ->with('all_DeliveryMan_info',$all_DeliveryMan_info);
        return view('pages.adminLayout')
            ->with('admin.all_deliveryMan',$manage_DeliveryMan);
    }
    public function add_deliveryMan(){
        return view('admin.add_deliveryMan');
    }
    public function save_DeliveryMan(Request $request)
   {
      $data=array();
        $data['deliveryMan_name']=$request->deliveryMan_name;
        $data['deliveryMan_address']=$request->deliveryMan_address;
        $data['deliveryMan_contactno']=$request->deliveryMan_contactno;
        $image=$request->file('deliveryMan_image');
        $data['deliveryMan_email']=$request->deliveryMan_email;
        $data['deliveryMan_password']=md5($request->deliveryMan_password);
    if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='image/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
         $data['deliveryMan_image']=$image_url;
            DB::table('tbl_deliveryMan')->insert($data);
            Session::put('message','Delivery Man added successfully!!');
            return Redirect::to('/add-DeliveryMan');
       }
    }
    $data['deliveryMan_image']='';
            DB::table('tbl_deliveryMan')->insert($data);
            Session::put('message','Delivery Man added successfully without image!!');
            return Redirect::to('/add-deliveryMan');
   }
   public function delete_DeliveryMan($deliveryMan_id)
    {
      DB::table('tbl_deliveryMan')
          ->where('deliveryMan_id',$deliveryMan_id)
          ->delete();
      Session::put('message','Delivery Man Deleted successfully! ');
      return Redirect::to('/all-DeliveryMan');    
    }
    public function edit_DeliveryMan($deliveryMan_id)
    {
        $deliveryMan_info=DB::table('tbl_deliveryMan')
                   ->where('deliveryMan_id',$deliveryMan_id)
                   ->first();

       $deliveryMan_info=view('admin.edit_DeliveryMan')
           ->with('deliveryMan_info',$deliveryMan_info);
       return view('pages.adminLayout')
           ->with('admin.edit_DeliveryMan',$deliveryMan_info);
    }

    public function update_DeliveryMan(Request $request,$deliveryMan_id)
    {
        $data=array();
        $data['deliveryMan_name']=$request->deliveryMan_name;
        $data['deliveryMan_address']=$request->deliveryMan_address;
        $data['deliveryMan_contactno']=$request->deliveryMan_contactno;
        $data['deliveryMan_email']=$request->deliveryMan_email;
        $data['deliveryMan_password']=md5($request->deliveryMan_password);
       
        
        DB::table('tbl_deliveryMan')
           ->where('deliveryMan_id',$deliveryMan_id)
           ->update($data);

        Session::put('message','Delivery Man updated successfully !');
        return Redirect::to('/all-DeliveryMan');
    }

}
