@extends('pages.adminLayout')
@section('adminContent')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Delivery Men</a></li>
			</ul>

			<p class="alert-success">
					<?php
						$message = Session::get('message');
						
						if($message){
							echo $message ;
							Session::put('message',NULL);
						}

						?>
					</p>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Delivery Men</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ID</th>
								  <th>Name</th>
								  <th>Image</th>
								  <th>Address</th>
								  <th>Contact No</th>
								  <th>E-Mail</th>
							  </tr>
						  </thead>   

						@foreach ( $all_DeliveryMan_info as $v_deliveryMan)
						  <tbody>
							<tr>
								<td>{{$v_deliveryMan->deliveryMan_id}}</td>
								<td class="center">{{$v_deliveryMan->deliveryMan_name}}</td>
								<td> <img src="{{URL::to($v_deliveryMan->deliveryMan_image)}}" style="height: 80px; width: 80px;"></td>
								<td class="center">{{$v_deliveryMan->deliveryMan_address}}</td>
								<td class="center">{{$v_deliveryMan->deliveryMan_contactno}}</td>
								<td class="center">{{$v_deliveryMan->deliveryMan_email}}</td>

								<td class="center">
									<a class="btn btn-info" href="{{URL::to('/edit-DeliveryMan/'.$v_deliveryMan->deliveryMan_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-DeliveryMan/'.$v_deliveryMan->deliveryMan_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						  </tbody>
					@endforeach

					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->





@endsection