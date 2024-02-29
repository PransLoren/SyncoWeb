@extends('layout.app')
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Teacher</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <!-- form start -->
              <form action="" method="POST">
              {{csrf_field()}}
                <div class="card-body">
                    <div class = "row">
                        <div class="form-group col-md-6">
                            <label>First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" value = "{{old('name', $getTeacher->name)}}" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="last_name" value = "{{old('last_name', $getTeacher->last_name)}}" placeholder="Last Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender<span style="color: red;">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{  (old('gender', $getTeacher->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{  (old('gender', $getTeacher->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>  

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Class<span style="color: red;">*</span></label>
                            <select class="form-control" required name="class_id">
                                <option value="">Select Class</option>
                                @foreach($getSubject as $value)
                                  <option {{  (old('class_id', $getTeacher->class_id) == $value->id) ? 'selected' : '' }} value ="{{ $value->id }}">{{ $value->name }}</option> 
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth<span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value = "{{old('date_of_birth', $getTeacher->date_of_birth)}}" name="date_of_birth">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Profile Picture<span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="profile_pic">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status<span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{ (old('status', $getTeacher->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status', $getTeacher->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>  

                            </select>
                        </div>
                    </div>
                    
                    <hr />

                  <div class="form-group">
                    <label>Email address<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" name="email" value = "{{old('email',  $getTeacher->email)}}"  placeholder="Email" required>
                    <div style="color:red">{{$errors->first('email')}}</div>
                  </div>
                  <div class="form-group">
                    <label>Password<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="password" placeholder="Password" required>
                    <p>Do you want to change your password? Add a password. </p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  @endsection