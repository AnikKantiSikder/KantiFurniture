
@extends('Frontend.Layouts.master')
	@section('content')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Customer billing information
		</h2>
	</section>	

	<!-- Customer checkout -->
		<section class="about_us" style="margin-bottom: 200px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 style="padding-top: 15px;padding-bottom: 5px;border-bottom: 1px solid black;width: 11%;">
					Checkout</h3><br><br>

				<form method="POST" action="{{ route('customer.checkout.store') }}" id="checkout-form">
						@csrf 

				{{-- Row one --}}
						<div class="row">
							<div class="col-md-6">
								<label>Full name</label>
								<input type="text" name="name" class="form-control">
								<font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}
                                </font>
							</div>
							<div class="col-md-6">
								<label>Email</label>
								<input type="email" name="email" class="form-control">
							</div>
						</div><br>
				{{-- Row two --}}
						<div class="row">
							<div class="col-md-6">
								<label>Phone number</label>
								<input type="text" name="mobile" class="form-control">
								<font style="color: red;">{{($errors->has('mobile'))?($errors->first('mobile')):''}}
                                </font>
							</div>
							<div class="col-md-6">
								<label>Address</label>
								<input type="text" name="address" class="form-control" >
								<font style="color: red;">{{($errors->has('mobile'))?($errors->first('mobile')):''}}
                                </font>
							</div>

						</div><br>
				{{-- Row three --}}
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Submit</button>
							</div>
							<div class="col-md-4"></div>
							
						</div>
					
					</form>
					
				</div>
			</div>
		</div>
	</section>


<!-- Page specific script -->
<script>
$(function () {
  
  $('#checkout-form').validate({
    rules: {

      name: {
        required: true,
      },
      mobile: {
        required: true,
      },
      address: {
        required: true,
      },
    },
    messages: {

      name: {
        required: "Please enter your full name", 
      },
      mobile: {
        required: "Please enter your mobile number",
      },
      address: {
        required: "Please enter your address",
      },

    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

	@endsection