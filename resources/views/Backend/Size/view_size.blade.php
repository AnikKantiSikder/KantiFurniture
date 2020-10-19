
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
                <h3>Size list
                  
                  <a class="btn btn-success btn-sm float-right" href="{{ route('sizes.add') }}">
                    <i class="fa fa-plus-circle"></i>
                    Add size
                  </a>
                  

                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped" style="text-align: center;">
                      <thead>
                        <tr>
                          <th>SL.</th>
                          <th>Size name</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>

                      @foreach ($allData as $key=> $size)

                      @php
                        $countSize= App\Model\ProductSize::where('size_id',$size->id)->count();
                      @endphp
                      <tr>
                        <td> {{$key+1}} </td>

                        <td style="text-align: justify;">{{$size->name}}</td>


                        <td>
                          <a title="Edit" class="btn btn-sm btn-info"
                           href="{{ route('sizes.edit', $size->id) }}">
                          <i class="fa fa-edit"></i></a>
                          
                          @if ($countSize<1)
                                                      <a title="Delete" id="delete" class="btn btn-sm btn-danger"
                           href="{{ route('sizes.delete', $size->id) }}">
                          <i class="fa fa-trash"></i></a>
                          @endif

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

