@extends('layout.app')
@section('title', 'permission List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permission List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/permissionlist/create">Permission List</li>
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
              <div class="card-header">
                {{-- <form action="{{ url('permissionlist/searchprocess') }}" method="GET">
                    <input type="search" name="keyword1" id="">
                    <input type="search" name="keyword2" id="">
                    <button type="submit">Search</button>
                </form> --}}

                @can('permission-create')
                    <a href="{{ route('permissionlist.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add New Permission</a>
                @endcan

                @if (count($data) === 1)
                    one record!
                @elseif (count($data) > 1)
                    multiple records!
                @else
                    any records!
                @endif

                @empty ($data)
                    // $record is "empty" .....
                @endempty

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div style="overflow-x:auto;">
                <table class="table">
                    <thead class="thead-dark">



                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Guard Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                <tbody>


                @foreach ($data as $permission)
                    <tr>

                        <th scope="row">{{ $permission->id }}</th>
                        <td><a href="/permissionlist/{{ $permission->id }}/edit">{{ $permission->name }}</a></td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>

                            @if(isset($permission))
                                {{ $permission->created_at->toFormattedDateString() }}
                            @endif
                            <td>
                                @can('permission-edit')
                                    <a href="{{ url('permissionlist/'.$permission->id.'/edit') }}">


                                        <button type="button" class= "btn btn-warning">Edit</button>

                                    </a>&nbsp;
                                @endcan
                                {{-- <a href="{{ url('permissionlist/'.$permission->id.'/delete') }}">
                                    <button type="button" class= "btn btn-danger">Delete</button>

                                </a>&nbsp; --}}

                                {{-- <a href="{{ url('/deletepermission', ['id' => $permission->id]) }}">
                                    <button class="btn btn-default">
                                    Delete
                                    </button>
                                  </a> --}}
                                  @can('permission-delete')
                                    <form action="{{ url('/permissionlist', ['id' => $permission->id]) }}" method="post">
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                  @endcan

                                {{-- <a href="{{ route('permission.edit',['permissionlist'=>$permission->id]) }}"></a>&nbsp; --}}
                                {{-- <form action="{{ url('permission.edit',[$permission->id]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="submit" class="btn btn-danger" value="Delete">
                                </form> --}}
                            </td>
                        </td>

                    </tr>
                @endforeach
                </tbody>
                </table>
                </div>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

