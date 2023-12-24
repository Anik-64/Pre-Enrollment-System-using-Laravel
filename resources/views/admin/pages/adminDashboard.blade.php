@extends('admin.layout.adminDefault')

@section('content')

<div class="row mr-5 ml-5">
    <!-- Change password status -->
    @if(Session::has('success'))
        <div class="col-md-12">
            <div class="alert alert-success">{{ Session::get('success') }}&nbsp<i class="fas fa-check"></i></div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="col-md-12">
            <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
        </div> 
    @endif
    <!-- End Change password status -->
    
    <div class="col-md-4 mb-4" >
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Course
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $course_data }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-reader fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total teacher
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $teacher_data }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-success" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total department
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $department_data }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row ml-5 mr-5">
    <div class="col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total student
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student_data }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Total enrollment
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment_data }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bell fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row ml-5 mr-5">
    <div class="col-md-6 offset-md-3 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                            Total Overlap Student
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_overlap_student }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection