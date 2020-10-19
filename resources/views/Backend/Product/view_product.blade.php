 
@extends('Backend.Layouts.master')

@section('content')
<!-- Main contents starts here -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">product</li>
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
                <h3>Product list
                  
                  <a class="btn btn-success btn-sm float-right" href="{{ route('products.add') }}">
                    <i class="fa fa-plus-circle"></i>
                    Add product
                  </a>
                  

                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped" style="text-align: center;">
                      <thead>
                        <tr>
                          <th>SL.</th>
                          <th>Product name</th>
                          <th>Category</th>
                          <th>Brand</th>
                          <th>Price</th>
                          <th>Short description</th>
                          <th>Long description</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>

                      @foreach ($allData as $key=> $product)
                      <tr>
                        <td> {{$key+1}} </td>

                        <td style="text-align: center;">{{$product->name}}</td>
                        <td style="text-align: center;">{{$product['category']['name'] }}</td>
                        <td style="text-align: center;">{{$product['brand']['name']}}</td>
                        <td style="text-align: center;">{{$product->price}}</td>
                        <td style="text-align: justify;">{{$product->short_desc}}</td>
                        <td style="text-align: justify;">{{$product->long_desc}}</td>
                        <td>
                         <img src="{{(!empty($product->image))?url('public/Upload/Product_images/'.$product->image):
                         url('public/Upload/no_image.png') }}"
                         style="height: 60px; width: 65px; border: 1px solid #000;" alt="User profile picture">
                        </td>


                        <td>
                          <a title="Edit" class="btn btn-sm btn-info"
                           href="{{ route('products.edit', $product->id) }}">
                          <i class="fa fa-edit"></i></a><br><br>

                          <a title="Details" class="btn btn-sm btn-success"
                           href="{{ route('products.details', $product->id) }}">
                          <i class="fa fa-eye"></i></a><br><br>
                          
                          <a title="Delete" id="delete" class="btn btn-sm btn-danger"
                           href="{{ route('products.delete', $product->id) }}">
                          <i class="fa fa-trash"></i></a>
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

