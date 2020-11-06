
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

		.table th{
			text-align: center;
		}

		.table td{
			text-align: center;
		}

		.table td .order_deny{
			background-color: #f92525;
			color: white;
			padding: 5px 10px 5px 10px;
			border-radius: 20px; 
		}

		.table td .order_confirm{
			background-color: #06ad29;
			color: white;
			padding: 5px 10px 5px 10px;
			border-radius: 20px; 
		}
	</style>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			My order list
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

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Order number</th>
								<th>Total amount</th>
								<th>Payment type</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $order)
								<tr>
									<td># {{$order->order_no}}</td>
									<td>{{$order->order_total}}</td>
									<td>
										{{$order['payment']['payment_method']}}<br>
										@if ($order['payment']['payment_method'] == 'Bkash')
											(Transaction no: {{$order['payment']['transaction_no']}})
										@endif
									</td>
									<td>
										@if ($order->status == '0')
											<span class="order_deny">Pending</span>
										@elseif($order->status == '1')
										    <span class="order_confirm">Confirmed</span>
										@endif
									</td>
									<td>
										<a title="Details" href="{{route('customer.order.details',$order->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

										<a title="Print" target="_blank" href="{{route('customer.order.print',$order->id)}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>



	@endsection