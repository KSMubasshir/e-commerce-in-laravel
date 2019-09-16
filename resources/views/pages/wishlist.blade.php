@extends('pages.customerLayout')
@section('customerContent')
<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="{{URL::to('/customer-profile')}}">Home</a> 
				<i class="icon-angle-right"></i>
			</li>
			<li><a href="#">Wishlist</a></li>
		</ul>
          <p class="alert-success">
			<?php
			$message=Session::get('message');
			if($message)
			{
				echo $message;
				Session::put('message',null);

			}
           ?>
		</p>
		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon user"></i><span class="break"></span>Products</h2>
				</div>
				<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
					  <thead>
						  <tr>
							  <th>Product Name</th>
							  <th>Product Image</th>
							  <th>Product price</th>
							  <th>category Name</th>
							  <th>manufactue Name</th>
							  <th>Actions</th>
						  </tr>
					  </thead> 
                 @foreach( $all_wishlist_info as $v_wishlist)
					  <tbody>
						<tr>
						<td class="center">{{ $v_wishlist->product_name }}</td>
                        <td> <img src="{{URL::to($v_wishlist->product_image)}}" style="height: 80px; width: 80px;"></td>
                        <td class="center">{{ $v_wishlist->product_price }} Tk</td>
                        <td class="center">{{ $v_wishlist->category_name }}</td>
                        <td class="center">{{ $v_wishlist->manufacture_name }}</td>
                        <td class="center">
	                        <a class="btn btn-default" href="{{URL::to('/view_product/'.$v_wishlist->product_id)}}">Add to Cart</a>
							<a class="btn btn-danger" href="{{URL::to('/delete-from-wishlist/'.$v_wishlist->product_id)}}" id="delete">Remove</a>
						</td>
						</tr>				
					  </tbody>
                   @endforeach
				  </table>            
				</div>
			</div><!--/span-->
		</div><!--/row-->
@endsection