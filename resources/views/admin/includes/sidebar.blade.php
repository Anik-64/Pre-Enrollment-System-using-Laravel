<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin-dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>panel</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(\Request::is('admin-dashboard')) active @endif">
        <a class="nav-link" href="{{ url('admin-dashboard') }}">
        <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
        <i class="fas fa-seedling"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(\Request::is('create-session')) active @endif">
        <a class="nav-link @if(!\Request::is('create-session')) collapsed @endif" href="#" data-toggle="collapse" data-target="#sessionmanagement"
            aria-expanded="true" aria-controls="sessionmanagement">
            <i class="fas fa-hourglass-start"></i>
            <span>Manage Session</span>
        </a>
        <div id="sessionmanagement" class="collapse @if(\Request::is('create-session')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Components:</h6> -->
                <a class="collapse-item @if(\Request::is('create-session')) active @endif" href="{{ url('create-session') }}">Create session</a>
            </div>
        </div>
    </li>

    <li class="nav-item @if(\Request::is('create-department') || \Request::is('departments')) active @endif">
        <a class="nav-link @if(!\Request::is('create-department') || !\Request::is('departments')) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-building"></i>
            <span>Mange Departments</span>
        </a>
        <div id="collapseTwo" class="collapse @if(\Request::is('create-department') || \Request::is('departments')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Components:</h6> -->
                <a class="collapse-item @if(\Request::is('create-department')) active @endif" href="{{ url('create-department') }}">Create department</a>
                <a class="collapse-item @if(\Request::is('departments')) active @endif" href="{{ url('departments') }}">Departments</a>
            </div>
        </div>
    </li>

    <li class="nav-item @if(\Request::is('create-course') || \Request::is('courses')) active @endif">
        <a class="nav-link @if(!\Request::is('create-course') || !\Request::is('courses')) collapsed @endif" href="#" data-toggle="collapse" data-target="#managecourse"
            aria-expanded="true" aria-controls="managecourse">
            <i class="fas fa-book"></i>
            <span>Manage Courses</span>
        </a>
        <div id="managecourse" class="collapse @if(\Request::is('create-course') || \Request::is('courses')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Components:</h6> -->
                <a class="collapse-item @if(\Request::is('create-course')) active @endif" href="{{ url('create-course') }}">Create course</a>
                <a class="collapse-item @if(\Request::is('courses')) active @endif" href="{{ url('courses') }}">Courses</a>
            </div>
        </div>
    </li>

    <li class="nav-item @if(\Request::is('create-teacher') || \Request::is('teachers')) active @endif">
        <a class="nav-link @if(!\Request::is('create-teacher') || !\Request::is('teachers')) collapsed @endif" href="#" data-toggle="collapse" data-target="#manageteacher"
            aria-expanded="true" aria-controls="manageteacher">
            <i class="fas fa-user-circle"></i>
            <span>Manage Teachers</span>
        </a>
        <div id="manageteacher" class="collapse @if(\Request::is('create-teacher') || \Request::is('teachers')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Components:</h6> -->
                <a class="collapse-item @if(\Request::is('create-teacher')) active @endif" href="{{ url('create-teacher') }}">Create teacher</a>
                <a class="collapse-item @if(\Request::is('teachers')) active @endif" href="{{ url('teachers') }}">Teachers</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item @if(\Request::is('pre-enrollment')) active @endif">
        <a class="nav-link" href="{{ url('pre-enrollment') }}">
            <i class="fas fa-braille"></i>
            <span>Pre-enrollment Details</span>
        </a>
    </li>

    <li class="nav-item @if(\Request::is('enrollment-details')) active @endif">
        <a class="nav-link" href="{{ url('enrollment-details') }}">
            <i class="fas fa-info-circle"></i>
            <span>Enrollment Details</span>
        </a>
    </li>

    <li class="nav-item @if(\Request::is('login-details')) active @endif">
        <a class="nav-link" href="{{ url('login-details') }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login Details</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->