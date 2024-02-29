@extends('layout.app')
  @section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student List (Total: {{ $getStudent->total() }} )</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('manager/student/add')}}" class="btn btn-primary"> Add New Student</a>
          </div>

        </div>
      </div>
    </section>

   
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12"> 

          @include ('message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getStudent as $value)
                      <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>
                          <a href="{{url('manager/student/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                          <a href="{{url('manager/student/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                  {!! $getStudent->appends(request()->except('page'))->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endsection