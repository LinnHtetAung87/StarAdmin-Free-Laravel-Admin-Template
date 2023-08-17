@extends('layout.app')
@section('title', 'Create Permission List')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Permission List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/permissionlist/#">Home</a></li>
              <li class="breadcrumb-item "><a href="#">Create Permission List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->

              <!-- /.card -->

              <!-- DIRECT CHAT -->

              <!--/.direct-chat -->

              <!-- Permission List -->
              <div class="card">

                <div class="card-body">
                    <form action="{{ url('permissionlist') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Guard Name</label>
                        <input type="text" class="form-control" name="guard_name" />
                    </div>

                    <button type="submit" class="btn btn-primary">Create Permission</button>
                    </form>
                </div>
              </div>
            </section>
</div><!-- /.container-fluid -->
</section>
@endsection

