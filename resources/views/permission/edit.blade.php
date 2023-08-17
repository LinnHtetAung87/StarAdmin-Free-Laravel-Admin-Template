@extends('layout.app')
@section('title', 'Edit Permission List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Permission List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Permission List</li>
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
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->

            <!-- /.card -->

            <!-- DIRECT CHAT -->

            <!--/.direct-chat -->

            <!-- Permission List -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('permissionlist',[$permission->id]) }}" method="POST">
                        @method('PATCH')@csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Guest Name</label>
                        <input type="text" class="form-control" name="guard_name" value="{{$permission->guard_name}}" />
                    </div>


                    <button type="submit" class="btn btn-primary">Update permission</button>
                    </form>
                </div>
            </div>
          </section>
</div><!-- /.container-fluid -->
</section>
@endsection






