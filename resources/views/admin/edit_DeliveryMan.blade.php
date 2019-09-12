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
		<a href="#">Update Delivery Man</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Delivery Man</h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" action="{{ url('/update-DeliveryMan',$deliveryMan_info->deliveryMan_id) }}" method="post">
				{{ csrf_field() }}
			  <fieldset>
				<div class="control-group">
				  <label class="control-label" for="date01">Name</label>
				  <div class="controls">
				<input type="text" class="input-xlarge" name="deliveryMan_name" value="{{$deliveryMan_info->deliveryMan_name}}">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Address</label>
				  <div class="controls">
				<input type="text" class="input-xlarge" name="deliveryMan_address" value="{{$deliveryMan_info->deliveryMan_address}}">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Contact No</label>
				  <div class="controls">
				<input type="text" class="input-xlarge" name="deliveryMan_contactno" value="{{$deliveryMan_info->deliveryMan_contactno}}">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Email</label>
				  <div class="controls">
				<input type="text" class="input-xlarge" name="deliveryMan_email" value="{{$deliveryMan_info->deliveryMan_email}}">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="date01">Password </label>
				  <div class="controls">
				<input type="text" class="input-xlarge" name="deliveryMan_password" value="">
				  </div>
				</div>
       
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">save</button>		 
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection