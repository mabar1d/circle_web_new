@extends('layout/dashboardLayout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List News</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List News</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>News Category</th>
                      <th>Title</th>
                      <th>Created By</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($artikels as $artikel)
                    <tr>
                      <td>{{$artikel->news_category_id}}</td>
                      <td>{{$artikel->title}}</td>
                      <td>{{$artikel->created_by}}</td>
                      <td><span class="tag tag-success">{{$artikel->status}}</span></td>
                      <td>{{$artikel->created_at}}</td>
                      <td>{{$artikel->updated_at}}</td>
                      <td>
                      <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection