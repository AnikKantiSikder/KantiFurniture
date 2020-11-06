<!DOCTYPE html>
<html>
<head>
	<title>Customer invoice</title>
	<style type="text/css">
		.myTable tr td{
			padding: 10px;
		}
	</style>
</head>
<body>
	<center>
			<table class="myTable" width="900px;" border="1">
						<tr style="text-align: center;">
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

						<tr style="text-align: center;">
							<td><strong>Billing information</strong></td>
							<td colspan="2" style="text-align: left;">
								<span><strong>Name: </strong>{{$order['shipping']['name']}}</span> &nbsp;&nbsp;
								<span><strong>Phone no: </strong>{{$order['shipping']['mobile']}}</span><br>
								<span><strong>Email: </strong>{{$order['shipping']['email']}}</span>&nbsp;&nbsp; 
								<span><strong>Address: </strong>{{$order['shipping']['address']}}</span>&nbsp;&nbsp; 
								<span><strong>Payment type: </strong>{{$order['payment']['payment_method']}}</span>&nbsp;&nbsp;&nbsp; 
							</td>
						</tr>

						<tr style="text-align: center;">
							<td colspan="3"><strong>Order details</strong></td>
						</tr>
						<tr style="text-align: center;">
							<td><strong>Product name and image</strong></td>
							<td><strong>Product color and size</strong></td>
							<td><strong>Product quantity and price</strong></td>
						</tr>
						@foreach ($order['order_details'] as $details)
							<tr style="text-align: center;">
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
						<tr style="text-align: center;">
							<td colspan="2" style="text-align: right;"><strong>Grand total</strong></td>
							<td><strong>{{$order->order_total}} Tk</strong></td>
						</tr>
					</table>
	</center>
</body>
</html>