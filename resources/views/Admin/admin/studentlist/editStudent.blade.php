@extends('layout.app')
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Student</h1>
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
                            <input type="text" class="form-control" name="name" value = "{{old('name', $getStudent->name)}}" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="last_name" value = "{{old('last_name', $getStudent->last_name)}}" placeholder="Last Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender<span style="color: red;">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{  (old('gender', $getStudent->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{  (old('gender', $getStudent->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>  

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Subject<span style="color: red;">*</span></label>
                            <select class="form-control" required name="class_id">
                                <option value="">Select Subject</option>
                                @foreach($getSubject as $value)
                                  <option {{  (old('class_id', $getStudent->class_id) == $value->id) ? 'selected' : '' }} value ="{{ $value->id }}">{{ $value->name }}</option> 
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth<span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value = "{{old('date_of_birth', $getStudent->date_of_birth)}}" name="date_of_birth">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Profile Picture<span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="profile_pic">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status<span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{ (old('status', $getStudent->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status', $getStudent->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>  

                            </select>
                        </div>
                    </div>
                    
                    <hr />

                  <div class="form-group">
                    <label>Email address<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" name="email" value = "{{old('email',  $getStudent->email)}}"  placeholder="Email" required>
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