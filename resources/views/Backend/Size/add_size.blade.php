
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
            <h1 class="m-0 text-dark">Manage Size</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">size</li>
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
                  @if (isset($editSizeData))
                    Edit size
                  @else
                  Add size
                  @endif
                  
                  <a class="btn btn-success btn-sm float-right" href="{{ route('sizes.view') }}">
                    <i class="fa fa-list"></i>
                    Color list
                  </a>

                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">

                <form method="POST"
                   action="
                    @if (isset($editSizeData))
                      {{ route('sizes.update',$editSizeData->id) }}
                    @else
                      {{ route('sizes.store') }}
                     
                   @endif" 
                    id="myForm" enctype="multipart/form-data">

                  @csrf
                  


                <div class="container">
                    <div class="row">

                      <div class="col-md-6">
                        <label for="description">Color name</label>
                        <input type="text" name="name" value="{{@$editSizeData->name}}" class="form-control" placeholder="Write color name">

                        <font color="red">
                          {{
                            ($errors->has('name'))?($errors->first('name')):''
                          }}
                        </font>
                      </div>
                      <div class="col-md-6" >
                        
                       {{--  <input type="submit" value="submit" class="btn btn-md btn-primary" style="margin-top: 32px; width: 150px;"> --}}
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px; width: 150px;">
                            @if (isset($editSizeData))
                              Update
                            @else
                            Submit
                            @endif
                        </button>
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

 