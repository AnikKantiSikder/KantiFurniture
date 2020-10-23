
@extends('Frontend.Layouts.master')
	@section('content')

	<style type="text/css">
		body {
		  margin: 0;
		  padding: 0;
		  background-color: #4fd6cc;
		  height: 150vh;
		}
		#login .container #login-row #login-column #login-box {
		  margin-top: 40px;
		  margin-bottom: 100px;
		  max-width: 600px;
		  height: 370px;
		  border: 1px solid #9C9C9C;
		  background-color: #EAEAEA;
		}
		#login .container #login-row #login-column #login-box #login-form {
		  padding: 20px;
		}
		#login .container #login-row #login-column #login-box #login-form #register-link {
		  margin-top: -85px;
		}
	</style>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/Frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Customer login
		</h2>
	</section>

    <div id="login">
        {{-- <h3 class="text-center text-white pt-5">Login form</h3> --}}
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Log in</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                {{-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> --}}
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Log in"
                                style="background-color: "><br><br>
                                <i class="fa fa-user"></i> No account yet?
                                <a href="{{ route('customer.signup') }}"><span>Create account</span></a>
                            </div><br>
{{--                             <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



	@endsection