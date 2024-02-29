@extends('layout.app')
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Subject</h1>
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
                        <div class="form-group col-md-12">
                            <label>Subject Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value = "{{ $getRecord->name }}" name="name" placeholder="Class Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Status<span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option {{ ($getRecord->status == 0) ? 'selected' : ''}} value="0">Active</option>
                                <option {{ ($getRecord->status == 1) ? 'selected' : ''}} value="1">Inactive</option>  

                            </select>
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