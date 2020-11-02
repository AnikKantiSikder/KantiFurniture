@extends('Frontend.Layouts.master')
	@section('content')

	<style type="text/css">
		.sss{
			float: left;
		}
		.s888{
			height: 42px;
			border: 1px solid #e6e6e6;
		}

	</style>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Payment
		</h2>
	</section>
		
	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 30px;">
					<div class="wrap-table-shopping-cart">
						<table class="table table-bordered">
							<tr class="table_head">
								<th>Product</th>
								<th>Image</th>
								<th>Size</th>
								<th>Color</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Action</th>
							</tr>

							@php
								$contents= Cart::content();
								$total= 0;
								
							@endphp
							@foreach ($contents as $cartContent)
							<tr class="table_row">
								<td>{{$cartContent->name}}</td>
								<td>
									<div class="how-itemcart1">
										<img src="{{asset('public/Upload/Product_images/'.$cartContent->options->image)}}" alt="IMG">
									</div>
								</td>
								<td>{{$cartContent->options->size_name}}</td>
								<td>{{$cartContent->options->color_name}}</td>
								
								<td>{{$cartContent->price}} Tk</td>
								<td style="width: 200px;min-width: 200px;">
									{{-- Update product quantity in the cart --}}
									<form method="POST" action="{{ route('cart.update') }}">
										@csrf
										<div>
											<input class="mtext-104 cl3 txt-center num-product form-control sss" id="qty" type="text" name="qty" value="{{$cartContent->qty}}">

											<input type="hidden" name="rowId" value="{{$cartContent->rowId}}">
											<input type="submit" value="Update" class="flex-c-m stext-101 cl2 bg8 s888 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
										</div>
									</form>
								</td>
								<td>{{$cartContent->subtotal}} Tk</td>
								<td>
									<a href="{{ route('cart.delete',$cartContent->rowId) }}" class="btn btn-danger">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							@php
								$total+= $cartContent->subtotal;
							@endphp
							@endforeach

							<tr>
								<td colspan="6" style="text-align: right;"><b>Grand total</b></td>
								<td colspan="2"><b>{{$total}} Tk</b></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<h3>Select payment method</h3><br>
					<div class="row">
						<div class="col-md-12">
							
							<h3 class="show_field" id="payment_method"
							style="display: none;">
							<img src="public/Upload/Payment_images/2.png" style="height: 65px;width: 200px;"></h3>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					{{-- Validation message show --}}
		            @if (Session::get('message'))
                        <div class="alert alert-danger alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    {{-- Validation message show --}}

					<form id="login-form" method="post" action="{{ route('customer.payment.store') }}">
						@csrf
						@foreach ($contents as $cartContent)
						<input type="hidden" name="product_id" value="{{$cartContent->id}}">
						@endforeach
						{{-- Passing grand total taka --}}
						<input type="hidden" name="order_total" value="{{$total}}">
						{{-- Grand total --}}
						<select name="payment_method" class="form-control" id="payment_method">
						   <option value="">Select payment type</option>
						   <option value="Hand cash">Hand cash</option>
						   <option value="Bkash">Bkash</option>
					    </select><br>

					    <font style="color: red;">{{($errors->has('payment_method'))?($errors->first('payment_method')):''}}
                        </font>

					    <div class="show_field" style="display: none;">
					    	<span>Bkash number: <b>01521451993</b></span>
					    	<input type="text" name="transaction_no" class="form-control"
					    	placeholder="Write transaction number">
					    </div>
					    <button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Submit</button>
					</form>

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).on('change', '#payment_method', function(){
			var payment_method= $(this).val();
			if(payment_method == 'Bkash'){
				$('.show_field').show();
			}else{
				$('.show_field').hide();
			}
		});
	</script>

	<!-- Page specific script -->
<script type="text/javascript">
$(function () {
  

  $('#login-form').validate({
    rules: {

      payment_method: {
        required: true,
      },
    },
    messages: {

      payment_method: {
        required: "Please select your payment method",
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