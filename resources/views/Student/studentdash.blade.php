@extends('layout.app')
  @section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

            <h1>Project Report</h1>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12"> 

          @include ('message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Project List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject</th>
                      <th>Project Name</th>
                      <th>Homework Date</th>
                      <th>Submission Date</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->id}}</td>
                        <td>{{ $value->class_name}}</td>s
                        <td>{{ $value->subject_name}}</td>
                        <td>{{ date('d-m-Y', strtotime($value->project_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->submission_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_date)) }}</td>
                        <td>
                          <form action="{{ url('student/project/https://github.com/Kuhwu/Synco/blob/main/resources/views/Admin/admin/homework/list1.blade.phpproject/submit/'.$value->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('POST') 
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to subject this task?')">Done</button>
                        </form>
                      </td>
                      
                        
                      </tr>

                     @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                  {!! $getRecord->appends(request()->except('page'))->links() !!}
                </div>
              </div>
            </div>
</div>
</div>
    <!-- /.content-header -->

  <!-- /.content-wrapper -->

  @endsection