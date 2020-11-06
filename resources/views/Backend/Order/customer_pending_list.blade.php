
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
                <h3>Pending order list</h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped" style="text-align: center;">
                      <thead>
                        <tr>
                          <th>Sl.</th>
                          <th>Order number</th>
                          <th>Total amount</th>
                          <th>Payment type</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>

                      @foreach ($orders as $key=> $order)


                      <tr>
                        <td> {{$key+1}} </td>
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
                          <a title="Approve" id="approve" class="btn btn-sm btn-primary"
                           href="{{ route('orders.approve', $order->id) }}">
                          <i class="fa fa-check"></i></a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>

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

