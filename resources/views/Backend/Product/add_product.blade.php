
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
                <h3>
                  @if (isset($editProductData))
                    Edit product
                  @else
                  Add product
                  @endif
                  
                  <a class="btn btn-success btn-sm float-right" href="{{ route('products.view') }}">
                    <i class="fa fa-list"></i>
                    Product list
                  </a>

                </h3>
              </div><!-- /.card-header -->

          <div class="card-body">

                <form method="POST"
                   action="
                    @if (isset($editProductData))
                      {{ route('products.update',$editProductData->id) }}
                    @else
                      {{ route('products.store') }}
                     
                   @endif" 
                    id="myForm" enctype="multipart/form-data">

                  @csrf
                  


                <div class="container-fluid">
                    <div class="row">

<!--Product name------------------------------------------------------------->
                      <div class="col-md-4">
                        <label for="description">Product name</label>
                        <input type="text" name="name" value="{{@$editProductData->name}}" class="form-control" placeholder="Write product name">

                        <font color="red">
                          {{
                            ($errors->has('name'))?($errors->first('name')):''
                          }}
                        </font>
                      </div>
<!--Category----------------------------------------------------------------->
                      <div class="col-md-4">
                        <label for="category">Category</label>
                        <select name="category_id" class="form-control">
                          <option>Select category</option>
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                              {{(@$editProductData->category_id==$category->id)?"selected":""}}>
                              {{$category->name}}</option>
                          @endforeach
                        </select>
                        

                        <font color="red">
                          {{
                            ($errors->has('category_id'))?($errors->first('category_id')):''
                          }}
                        </font>
                      </div>
<!--Brand-------------------------------------------------------------------->
                      <div class="col-md-4">
                        <label for="brand">Brand</label>
                        <select name="brand_id" class="form-control">
                          <option>Select brand</option>
                          @foreach ($brands as $brand)
                            <option value="{{$brand->id}}"
                              {{(@$editProductData->brand_id==$brand->id)?"selected":""}}>
                              {{$brand->name}}</option>
                          @endforeach
                        </select>
                        

                        <font color="red">
                          {{
                            ($errors->has('brand_id'))?($errors->first('brand_id')):''
                          }}
                        </font>
                      </div>
<!--Color-------------------------------------------------------------------->
                      <div class="col-md-6">
                        <label for="brand">Color</label>
                        <select name="color_id[]" class="form-control select2" multiple>
                          
                          @foreach ($colors as $color)
                            <option value="{{$color->id}}"
                              {{(@in_array(['color_id'=>$color->id],$color_array))?"selected":""}}>
                              {{$color->name}}</option>
                          @endforeach
                        </select>
                        

                        <font color="red">
                          {{
                            ($errors->has('color_id'))?($errors->first('color_id')):''
                          }}
                        </font>
                      </div>

<!--Size-------------------------------------------------------------------->
                      <div class="col-md-6">
                        <label for="size">Size</label>
                        <select name="size_id[]" class="form-control select2" multiple>
                          
                          @foreach ($sizes as $size)
                            <option value="{{$size->id}}"
                              {{(@in_array(['size_id'=>$size->id],$size_array))?"selected":""}}>
                              {{$size->name}}</option>
                          @endforeach
                        </select>
                        

                        <font color="red">
                          {{
                            ($errors->has('color_id'))?($errors->first('color_id')):''
                          }}
                        </font>
                      </div>
<!--Short description------------------------------------------------------------->

                      <div class="col-md-12">
                        <label for="short description">Short description</label>
                        <textarea name="short_desc" class="form-control" rows="2">
                          {{@$editProductData->short_desc}}
                        </textarea>

                        <font color="red">
                          {{
                            ($errors->has('short_desc'))?($errors->first('short_desc')):''
                          }}
                        </font>
                      </div>
<!--Long description------------------------------------------------------------->

                      <div class="col-md-12" style="margin-bottom: 15px;">
                        <label for="long description">Long description</label>
                        <textarea name="long_desc" class="form-control" rows="4">
                          {{@$editProductData->long_desc}}
                        </textarea>

                        <font color="red">
                          {{
                            ($errors->has('long_desc'))?($errors->first('long_desc')):''
                          }}
                        </font>
                      </div>
<!--Price------------------------------------------------------------->
                      <div class="col-md-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" value="{{@$editProductData->price}}" class="form-control" placeholder="Write product price">

                        <font color="red">
                          {{
                            ($errors->has('price'))?($errors->first('price')):''
                          }}
                        </font>
                      </div>
<!--Image------------------------------------------------------------->
                      <div class="col-md-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                      </div>

                      <div class="col-md-3">
                        <img id="show_image"

                         src="{{(!empty($editProductData->image))?url('public/Upload/Product_images/'.$editProductData->image):
                         url('public/Upload/no_image.png') }}"
                         style="height: 120px; width: 150px; border: 1px solid #000;" alt="User profile picture">
                      </div>

                      <div class="col-md-3">
                        <label for="image">Sub image</label>
                        <input type="file" name="sub_image[]" class="form-control" multiple>
                      </div>



                  </div>
                  <div class="row">
                    <div class="col-md-12" >
                      
                     {{--  <input type="submit" value="submit" class="btn btn-md btn-primary" style="margin-top: 32px; width: 150px;"> --}}
                      <button type="submit" class="btn btn-primary" style="margin-top: 32px; width: 150px;">
                          @if (isset($editProductData))
                            Update
                          @else
                          Submit
                          @endif
                      </button>
                    </div>
                  </div>

                </div>
          </div>


                                      
                      
                    
                    
                  </form>
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


<script>
  
$(function () {
  
  // $.validator.setDefaults({
  //   submitHandler: function () {
  //     alert( "Form successful submitted!" );
  //   }
  // });

  $('#myForm').validate({
    rules: {

      name: {
        required: true,
      },
      category_id: {
        required: true,
      },
      brand_id: {
        required: true,
      },
      short_desc: {
        required: true,
      },
      long_desc: {
        required: true,
      },
      price: {
        required: true,
      },

    },
    messages: {

    },

    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

@endsection

 