
@extends('Backend.Layouts.master')

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
<!-- Main contents starts here -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->

            <div class="card">
              <div class="card-header">
                <h3>Order details(Request)</h3>
                  <a class="btn btn-success btn-sm float-right" href="{{ route('orders.approved.list') }}">
                    <i class="fa fa-list"></i>
                    Approved list
                  </a>
              </div><!-- /.card-header -->

              <div class="card-body">
          <table class="txt-center myTable" width="100%" border="1">

            <tr>
              <td width="30%">
                <strong>Billing information</strong><br>
                <span><strong>Order no: #</strong>{{$order->order_no}}</span>
              </td>
              <td width="70%" colspan="2" style="text-align: left;">
                <span><strong>Name: </strong>{{$order['shipping']['name']}}</span> &nbsp;&nbsp;
                <span><strong>Phone no: </strong>{{$order['shipping']['mobile']}}</span><br>
                <span><strong>Email: </strong>{{$order['shipping']['email']}}</span>&nbsp;&nbsp; 
                <span><strong>Address: </strong>{{$order['shipping']['address']}}</span><br>
                <span><strong>Payment type: </strong>{{$order['payment']['payment_method']}}</span>&nbsp;&nbsp;&nbsp; 
              </td>
            </tr>

            <tr>
              <td colspan="3" style="text-align: center;"><h3><b>Order details</b></h3></td>
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
              <td colspan="2" style="text-align: right;"><strong>Grand total=</strong></td>
              <td><strong>{{$order->order_total}} Tk</strong></td>
            </tr>
          </table>
              </div><!-- /.card-body -->
            </div>

            <!-- /.card -->
          </section>
          <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Main content ends here -->
@endsection

