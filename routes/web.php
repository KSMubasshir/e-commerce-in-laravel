<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//FrontEnd Site
Route::get('/','HomeController@index');
Route::get('/contactus','HomeController@contactus');
Route::get('/wishlist','CustomerController@wishlist');
Route::get('/delete-from-wishlist/{product_id}','CustomerController@delete_wishlist_item');

//search products
Route::post('/search','HomeController@show_product_by_search');
//show category wise product here
Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');

//cart routes are here----------------
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');
//checkout routes are here======
Route::get('/login-check','CheckoutController@login_check');
Route::get('/login-check1','CustomerController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::post('/customer_registration1','CustomerController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');
Route::get('/customerOrders','CustomerController@my_orders');
//customer login and logout are here------------------------------------
Route::post('/customer_login','CheckoutController@customer_login');
Route::post('/customer_login1','CustomerController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');

Route::get('/customer-profile','CustomerController@index');

Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');

Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/new-order','CheckoutController@new_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');




//BackEnd Site
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');



//delivery man routes
Route::get('/deliveryMan', 'DeliveryManController@index');
Route::get('/deliveryManDashboard', 'SuperAdminController@deliveryManIndex');
Route::get('/deliveryManlogout', 'SuperAdminController@deliveryManlogout');
Route::post('/deliveryMan-dashboard', 'DeliveryManController@dashboard');

Route::get('/deliveryManOrders', 'DeliveryManController@myOrders');
Route::get('/deliveryManDeliverdOrders', 'DeliveryManController@myDeliveredOrders');
Route::get('/view-delivery/{order_id}', 'DeliveryManController@view_delivery');
Route::get('/view-delivery1/{order_id}', 'CustomerController@view_delivery');
Route::get('/active-delivery/{order_id}', 'DeliveryManController@active_delivery');

//admin operation on delivery man
Route::get('/add-DeliveryMan', 'DeliveryManController@add_DeliveryMan');
Route::get('/all-DeliveryMan', 'DeliveryManController@all_DeliveryMan');
Route::get('/edit-DeliveryMan/{DeliveryMan_id}', 'DeliveryManController@edit_DeliveryMan');
Route::get('/delete-DeliveryMan/{DeliveryMan_id}', 'DeliveryManController@delete_DeliveryMan');
Route::post('/save-DeliveryMan', 'DeliveryManController@save_DeliveryMan');
Route::post('/update-DeliveryMan/{DeliveryMan_id}', 'DeliveryManController@update_DeliveryMan');


//Category
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/inactive_category/{category_id}', 'CategoryController@inactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');

//Manufactures/Brands
Route::get('/add-manufacture', 'ManufactureController@index');
Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
Route::get('/all-manufacture', 'ManufactureController@all_manufacture');
Route::get('/delete-manufacture/{manufacture_id}', 'ManufactureController@delete_manufacture');
Route::get('/edit-manufacture/{manufacture_id}','ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufacture_id}','ManufactureController@update_manufacture');
Route::get('/inactive_manufacture/{manufacture_id}','ManufactureController@inactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}','ManufactureController@active_manufacture');

//products routes are here
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/inactive_product/{product_id}','ProductController@inactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//slider routes are here
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');

//order routes are here
Route::get('/inactive-order/{order_id}','OrderController@inactive_order');
Route::get('/active-order/{order_id}','OrderController@active_order');


