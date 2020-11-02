
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
			Edit profile
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
					
					<form method="post" action="{{ route('customer.update.profile') }}"
					enctype="multipart/form-data">
						@csrf 
				{{-- Row one --}}
						<div class="row">
							<div class="col-md-12 img-circle txt-center">
								
								<img id="show_image" src="{{(!empty($editUser->image))?url('public/Upload/User_images/'.$editUser->image):url('public/Upload/no_image.png') }}"
		                        style="height: 160px; width: 180px; border: 1px solid #000;"
		                        alt="User profile picture">
							
							</div>
						</div><br>
				{{-- Row two --}}
						<div class="row">
							<div class="col-md-4">
								<label>Full name</label>
								<input type="text" name="name" class="form-control" value="{{$editData->name}}">
								<font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}
                                </font>
							</div>
							<div class="col-md-4">
								<label>Email</label>
								<input type="email" name="email" class="form-control" value="{{$editData->email}}">
								<font style="color: red;">{{($errors->has('email'))?($errors->first('email')):''}}
                                </font>
							</div>
							<div class="col-md-4">
								<label>Phone number</label>
								<input type="text" name="mobile" class="form-control" value="{{$editData->mobile}}">
								<font style="color: red;">{{($errors->has('mobile'))?($errors->first('mobile')):''}}
                                </font>
							</div>
						</div><br>
				{{-- Row three --}}
						<div class="row">
							<div class="col-md-4">
								<label>Address</label>
								<input type="text" name="address" class="form-control" value="{{$editData->address}}">
							</div>
							<div class="col-md-4">
								<label>Gender</label>
								<select name="gender" class="form-control">
									<option value="">Select gender</option>
									<option value="Male" {{($editData->gender=="Male")?"selected":""}}>Male</option>
									<option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Image</label>
								<input type="file" name="image" class="form-control" id="image">
							</div>
						</div><br>
				{{-- Row four --}}
						<div class="row">
							<div class="col-md-4">

							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Update</button>
							</div>
						</div>
					
					</form>
				</div>
			</div>
		</div>



	@endsection