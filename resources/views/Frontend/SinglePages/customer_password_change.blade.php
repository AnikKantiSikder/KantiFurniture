
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
      Password change
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
           
             <form method="POST" action="{{ route('customer.password.update') }}"
              id="myForm" enctype="multipart/form-data">
                  @csrf
                  
                    <div class="row">

                      <div class="col-md-4">
                        <label for="current_password">Current password</label>
                        <input type="password" name="current_password"  class="form-control" placeholder="Your current password" id="current_password" >
                      </div>

                      <div class="col-md-4">
                        <label for="new_password">New password</label>
                        <input class="form-control" type="password"  name="new_password" placeholder="Your new password" id="new_password">
                      </div>
 
                      <div class="col-md-4">
                        <label for="confirm_new_password">Confirm new password</label>
                        <input class="form-control" type="password" name="confirm_new_password" placeholder="User mobile" id="confirm_new_password">
                      </div>

                    </div><br>
                    <div class="row">
                      
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-md btn-success btn-block">Password update</button>
                    </div>
                    </div>

                    
                  </form>
          </div>
      </div>
    </div>



  @endsection