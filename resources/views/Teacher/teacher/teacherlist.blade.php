@extends('layout.app')
  @section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teacher List (Total: {{ $getRecord->total() }} )</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('admin/teacher/add')}}" class="btn btn-primary"> Add New Teacher</a>
          </div>

        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search </h3>
              </div>
              <form action="" method="GET">
              {{csrf_field()}}
                <div class="card-body">
                  <div class="row">
                <div class="form-group col-md-4">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value = "{{old('name')}}" placeholder="Name" >
                  </div>
                  <div class="form-group col-md-4">
                    <label>Email address</label>
                    <input type="text" class="form-control" name="email" value = "{{old('email')}}"  placeholder="Email" >
                    <div style="color:red">{{$errors->first('email')}}</div>
                  </div>

                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;"> Search</button>
                    <a href="{{url('admin/teacher/list')}}" class="btn btn-success" style="margin-top: 30px;" > Reset</a>
                  </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12"> 

          @include ('message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Teacher List</h3>
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
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>
                          <a href="{{url('admin/teacher/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                          <a href="{{url('admin/teacher/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
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