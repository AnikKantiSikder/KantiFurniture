 
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
                <h3>Product details
                  
                  <a class="btn btn-success btn-sm float-right" href="{{ route('products.view') }}">
                    <i class="fa fa-list"></i>
                    Product list
                  </a>
                  

                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                <table class="table table-bordered table-hover table-sm">
                   <tbody>
                     <tr>
                       <td width="30%"><b>Name</b></td>
                       <td width="70%">{{$detailsData->name}}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Category</b></td>
                       <td width="70%">{{$detailsData['category']['name'] }}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Brand</b></td>
                       <td width="70%">{{$detailsData['brand']['name']}}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Price</b></td>
                       <td width="70%">{{$detailsData->price}}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Short details</b></td>
                       <td width="70%">{{$detailsData->short_desc}}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Long details</b></td>
                       <td width="70%">{{$detailsData->long_desc}}</td>
                     </tr>
                     <tr>
                       <td width="30%"><b>Image</b></td>
                       <td width="70%">
                         <img src="{{(!empty($detailsData->image))?url('public/Upload/Product_images/'.$detailsData->image):
                         url('public/Upload/no_image.png') }}"
                         style="height: 100px; width: 150px; border: 1px solid #000;" alt="User profile picture">
                       </td>
                     </tr>
                     <tr>
                       <td><b>Colors</b></td>
                       <td>
                         @php
                           $colors= App\Model\ProductColor::where('product_id', $detailsData->id)->get();
                         @endphp
                         @foreach ($colors as $colorData)
                           {{$colorData['color']['name']}}|
                         @endforeach
                       </td>
                     </tr>
                     <tr>
                       <td><b>Sizes</b></td>
                       <td>
                         @php
                           $sizes= App\Model\ProductSize::where('product_id', $detailsData->id)->get();
                         @endphp
                         @foreach ($sizes as $sizeData)
                           {{$sizeData['size']['name']}}|
                         @endforeach
                       </td>
                     </tr>
                     <tr>
                       <td><b>Additional images</b></td>
                       <td>
                         @php
                           $subImages= App\Model\ProductSubImage::where('product_id', $detailsData->id)->get();
                         @endphp
                         @foreach ($subImages as $imgs)
                         <img src="{{url('public/Upload/Product_images/Product_sub_images/'.$imgs->sub_image) }}"
                         style="height: 100px; width: 150px; border: 1px solid #000;" alt="User profile picture">
                         @endforeach
                       </td>
                     </tr>

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

