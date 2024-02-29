@extends('layout.app')
  @section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('admin/project/project/add')}}" class="btn btn-primary"> Add New Project</a>
          </div>

    </section>

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
                        <td>{{ $value->class_name}}</td>
                        <td>{{ $value->subject_name}}</td>
                        <td>{{ date('d-m-Y', strtotime($value->project_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->submission_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_date)) }}</td>
                        <td>
                          <a href="{{ url('admin/project/project/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                          <form action="{{ url('admin/project/project/delete/'.$value->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('POST') 
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
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
      </div>
  @endsection