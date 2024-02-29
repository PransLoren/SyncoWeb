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
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#assigned">Assigned</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#missing">Missing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#done">Done</a>
                </li>
                <!-- Add more navigation items here -->
            </ul>
        </div>
    </nav>
    <hr>
    
    </div>
    </div>
</div>
</div>
    <!-- /.content-header -->

  <!-- /.content-wrapper -->

  @endsection