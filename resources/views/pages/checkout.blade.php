@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="register-req">
				<p>Please fillup this form............</p>
			</div><!--/register-req-->
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Shipping Details</p>
							<div class="form-one">
								<form action="{{url('/save-shipping-details')}}" method="post">
									{{csrf_field()}}
								<input type="text" name="shipping_email"  placeholder="Email*" required="" value="ksmubasshir@gmail.com">
								<input type="text" name="shipping_first_name"  placeholder="First Name *" required="" value="Kazi">
								<input type="text"  name="shipping_last_name" placeholder="Last Name *" required=""value="Samin">
								<input type="text" name="shipping_address"  placeholder="Address *" value="SBH,BUET">
								<input type="text" name="shipping_mobile_number"  placeholder="Mobile Number *" required="" value="01521332253">
                                <input type="text" name="shipping_city"  placeholder="city *" required="" value="Dhaka"> 
                                <input type="submit" class="btn btn-default" value="Done" required="" value="">
								</form>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection