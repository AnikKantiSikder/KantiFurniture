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
			Shopping Cart
		</h2>
	</section>
		
	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 30px;">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Product</th>
								<th class="column-2"></th>
								<th class ="column-2">Size</th>
								<th class="column-2">Color</th>
								<th class="column-3">Price</th>
								<th class="column-4">Quantity</th>
								<th class="column-5">Total</th>
								<th class="column-5">Action</th>
							</tr>

							@php
								$contents= Cart::content();
								$total= 0;
								
							@endphp
							@foreach ($contents as $cartContent)
							<tr class="table_row">
								<td class="column-1">{{$cartContent->name}}</td>
								<td class="column-2">
									<div class="how-itemcart1">
										<img src="{{asset('public/Upload/Product_images/'.$cartContent->options->image)}}" alt="IMG">
									</div>
								</td>
								<td class="column-2">{{$cartContent->options->size_name}}</td>
								<td class="column-2">{{$cartContent->options->color_name}}</td>
								
								<td class="column-3">{{$cartContent->price}} Tk</td>
								<td class="column-4">
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
								<td class="column-5">{{$cartContent->subtotal}} Tk</td>
								<td class="column-5">
									<a href="{{ route('cart.delete',$cartContent->rowId) }}" class="btn btn-danger">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							@php
								$total+= $cartContent->subtotal;
							@endphp
							@endforeach




						</table>
					</div>
				</div>

				<div class="col-md-12 col-lg-12 col-xl-12">
					<div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">
                                    <h5>What would you like to do next?</h5>
                                    <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                                </th>
                            </tr>
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="total_area">
                                        <ul>
                                        <li>Cart Sub Total <span>{{$total}} Tk</span></li>
                                        <li>Eco Tax <span>0.00</span> Tk</li>
                                        <li>Shipping Cost <span>Free</span></li>
                                        <li>Grand total <span>{{$total}} Tk</span></li>
                                    </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <a href="{{ route('product.list') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Continue Shopping</a>
                            &nbsp;&nbsp;

                            <a href="login-check.html" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Checkout</a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

    @endsection