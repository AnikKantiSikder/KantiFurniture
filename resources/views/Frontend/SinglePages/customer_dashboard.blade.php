
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
	</style>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			My profile
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
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-body">
									<div class="img-circle txt-center">
										<img src="{{(!empty($userData->image))?url('public/Upload/User_images/'.$userData->image):url('public/Upload/no_image.png') }}"
										    style="height: 160px;width: 180px;border-radius: 5px;">
									</div><br>

									<div>
										<h3 class="txt-center">{{$userData->name}}</h3>
									    <p class="txt-center">{{$userData->address}}</p>
									</div>
									<br>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>Phone number:</td>
												<td>{{$userData->mobile}}</td>
											</tr>
											<tr>
												<td>Email:</td>
												<td>{{$userData->email}}</td>
											</tr>
											<tr>
												<td>Gender:</td>
												<td>{{$userData->gender}}</td>
											</tr>
										</tbody>
									</table>
									<a class="btn btn-primary btn-block"
									href="{{ route('customer.edit.profile') }}">Edit profile</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	@endsection