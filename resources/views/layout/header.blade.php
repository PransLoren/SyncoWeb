
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('assets/adminassets/dist/img/Syncologo.png')}}" alt="SyncoLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Synco</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('assets/adminassets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::user()->user_type == 1)
        <li class="nav-item">
            <a href="{{url ('admin/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{url ('admin/admin/list')}}" class="nav-link @if(Request::segment(2) =='admin') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Admin
              </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url ('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) =='teacherList') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Teacher
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url ('admin/student/list')}}" class="nav-link @if(Request::segment(2) =='studentList') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Student
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url ('admin/subject/list')}}" class="nav-link @if(Request::segment(2) =='classList') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Subject
              </p>
            </a>
        </li>
        
        <!-- Project Section -->
<li class="nav-item @if(Request::segment(2) == 'project') menu-is-opening menu-open @endif">
  <a href="#" class="nav-link  @if(Request::segment(2) =='project') active @endif">
    <i class="nav-icon fas fa-table"></i>
    <p>
      Project
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{url ('admin/project/project/add')}}" class="nav-link @if(Request::segment(3) =='project') active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>
          Create Project
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="tables/jsgrid.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>
          Project Report
        </p>
      </a>
    </li>
  </ul>
</li>
        @elseif(Auth::user()->user_type == 2)
        <li class="nav-item">
            <a href="{{url ('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url ('teacher/student/list')}}" class="nav-link @if(Request::segment(2) =='studentLists') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Students
              </p>
            </a>
        </li>
        <li class="nav-item">
              <a href="tables/jsgrid.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
               Project Report
               </p>
            </a>
        </li>
        @elseif(Auth::user()->user_type == 3)
        <li class="nav-item">
            <a href="{{url ('student/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Projects
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="tables/jsgrid.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
               Project Report
               </p>
            </a>
        </li>
          <li class="nav-item">
            <a href="{{url ('/profile')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Profile
              </p>
            </a>
        </li>

        @elseif(Auth::user()->user_type == 4)
        <li class="nav-item">
            <a href="{{url ('manager/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{url ('manager/manager/list')}}" class="nav-link @if(Request::segment(2) =='manager') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Admin
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url ('manager/teacher/list')}}" class="nav-link @if(Request::segment(2) =='teacherList') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Teacher
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url ('manager/student/list')}}" class="nav-link @if(Request::segment(2) =='studentLists') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Student
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url ('manager/subject/list')}}" class="nav-link @if(Request::segment(2) =='subjectLists') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Subject
              </p>
            </a>
        </li>
        <li class="nav-item">
              <a href="tables/jsgrid.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
               Project Report
               </p>
            </a>
        </li>
        
        @endif
        <li class="nav-item">
            <a href="{{url ('logout')}}" class="nav-link ">
              <i class="nav-icon far fa-user"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
