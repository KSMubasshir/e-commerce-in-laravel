@extends('pages.adminLayout')
@section('adminContent')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="index.html">Home</a>
		<i class="icon-angle-right"></i> 
	</li>
	<li>
		<i class="icon-edit"></i>
		<a href="#">Add Delivery Man</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Delivery Man</h2>
		</div>
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
		<div class="box-content">
			<form class="form-horizontal" action="{{ url('/save-DeliveryMan') }}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="control-group">
				  <label class="control-label" for="date01">Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="deliveryMan_name" required="">
				  </div>
				</div>
                <div class="control-group">
					<label class="control-label" for="selectError3">Address</label>
				 	<div class="controls">
						<input type="text" class="input-xlarge" name="deliveryMan_address" required="">
				  	</div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="date01">Contact No</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="deliveryMan_contactno" required="">
				  </div>
				</div>
                <div class="control-group">
				  <label class="control-label" for="fileInput">Image </label>
				  <div class="controls">
					<input class="input-file uniform_on" name="deliveryMan_image" id="fileInput" type="file">
				  </div>
				</div>  
				<div class="control-group">
					<label class="control-label" for="selectError3">Email</label>
				 	<div class="controls">
						<input type="text" class="input-xlarge" name="deliveryMan_email" required="">
				  	</div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="date01">Password</label>
				  <div class="controls">
					<input type="password" placeholder="Password" name="deliveryMan_password" required=""/>
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Add Delivery Man </button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection