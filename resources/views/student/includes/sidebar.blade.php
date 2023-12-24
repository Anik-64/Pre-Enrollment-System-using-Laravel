<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('student-dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Student<sub>panel</sub></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('student-dashboard') }}">
            <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
            <i class="fas fa-fire"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Creation
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(\Request::is('enrollment'))
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('') }}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-yin-yang"></i>
            <span>Enrollment section</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom sections:</h6>
                <a class="collapse-item active" href="{{ url('enrollment') }}">Enrollment</a>
                <a class="collapse-item" href="{{ url('pending-enrollment') }}">Pending list</a>
            </div>
        </div>
    </li>
    @elseif(\Request::is('pending-enrollment'))
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('') }}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-yin-yang"></i>
            <span>Enrollment section</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom sections:</h6> -->
                <a class="collapse-item" href="{{ url('enrollment') }}">Enrollment</a>
                <a class="collapse-item active" href="{{ url('pending-enrollment') }}">Pending list</a>
            </div>
        </div>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('') }}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-yin-yang"></i>
            <span>Enrollment section</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom sections:</h6> -->
                <a class="collapse-item" href="{{ url('enrollment') }}">Enrollment</a>
                <a class="collapse-item" href="{{ url('pending-enrollment') }}">Pending list</a>
            </div>
        </div>
    </li>
    @endif
    
    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Addons
    </div> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login details</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->