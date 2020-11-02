
@extends('Frontend.Layouts.master')
	@section('content')

	<style type="text/css">
		.prof li{
			background-color: #1781BF;
			padding:7px;
			margin:3px;
			border-radius: 15px;
		}

		.prof li a{
			color: white;
			padding-left: 15px;

		}

		.myTable tr td{
			padding: 10px;
		}
	</style>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('../public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			My order details
		</h2>
	</section>	

	<!-- Customer dashboard Section -->
		<div class="container" style="margin-top:50px; margin-bottom: 200px;">
			<div class="row" style="padding-top: 15px 0px 15px 0px">
				<div class="col-md-2">
					<ul class="prof">
						<li><a href="{{ route('dashboard') }}">My profile</a></li>
						<li><a href="{{ route('customer.password.change') }}">Password change</a></li>
						<li><a href="{{ route('customer.order.list') }}">My orders</a></li>
					</ul>
				</div>
				<div class="col-md-10">
					<table class="txt-center myTable" width="100%" border="1">
						<tr>
							<td width="40%">
						<!-- Logo desktop -->		
						<img src="{{url('public/Upload/Logo_images/'.$logo->image)}}">
							</td>
							<td width="30%">
								<h4><strong>Kanti furniture</strong></h4>
								<span><strong>Mobile no: </strong>{{$contact->mobile}}</span><br>
								<span><strong>Email: </strong>{{$contact->email}}</span><br>
								<span><strong>Address: </strong>{{$contact->address}}</span>
							</td>
							<td width="30%">
								<span><strong>Order no: #</strong>{{$order->order_no}}</span>
							</td>
						</tr>

						<tr>
							<td><strong>Billing information</strong></td>
							<td colspan="2" style="text-align: left;">
								<span><strong>Name: </strong>{{$order['shipping']['name']}}</span> &nbsp;&nbsp;
								<span><strong>Phone no: </strong>{{$order['shipping']['mobile']}}</span><br>
								<span><strong>Email: </strong>{{$order['shipping']['email']}}</span>&nbsp;&nbsp; 
								<span><strong>Address: </strong>{{$order['shipping']['address']}}</span><br>
								<span><strong>Payment type: </strong>{{$order['payment']['payment_method']}}</span>&nbsp;&nbsp;&nbsp; 
							</td>
						</tr>

						<tr>
							<td colspan="3"><strong>Order details</strong></td>
						</tr>
						<tr>
							<td><strong>Product name and image</strong></td>
							<td><strong>Product color and size</strong></td>
							<td><strong>Product quantity and price</strong></td>
						</tr>
						@foreach ($order['order_details'] as $details)
							<tr>
								<td>
									<img
									src="{{url('public/Upload/Product_images/'.$details['product']['image'])}}"
									style="height: 60px; width: 65px; border: 1px solid #000;" alt="User profile picture"><br>
									 {{$details['product']['name']}}
								</td>
								<td>
									<strong>Color: </strong>{{$details['color']['name']}}<br>
									<strong>Size: </strong>{{$details['size']['name']}}
								</td>
								<td>
									@php
										$subTotal= $details->quantity*$details['product']['price'];
									@endphp

									{{$details->quantity}} × {{$details['product']['price']}} = {{$subTotal}}

								</td>
						    </tr>	
						@endforeach
						<tr>
							<td colspan="2" style="text-align: right;"><strong>Grand total</strong></td>
							<td><strong>{{$order->order_total}} Tk</strong></td>
						</tr>
					</table>
				</div>
			</div>
		</div>



	@endsection