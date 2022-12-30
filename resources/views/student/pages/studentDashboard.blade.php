@extends('student.layout.studentDefault')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    @if( $data->image )
        <style>
            .col-md-8{
                margin-top: -60px;
            }
        </style>
    @else
        <style>
            .col-md-8{
                margin-top: -80px;
            }
        </style>
    @endif
@endsection

@section('content')

    <div class="container emp-profile">
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}&nbsp<i class="fas fa-check"></i></div>
        @endif
        
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if( $data->image )
                        <img src="{{ asset('thumbnail/'.$data->image) }}" id="profile-image" class="img-fluid rounded" alt=""/>
                    @else
                        @if( $data->gender == '0' )
                            <img src="{{ asset('img/gif-avatars-boy.gif') }}" class="img-fluid rounded" style="height: auto; width: 100%" alt=""/>
                        @elseif( $data->gender == '1' )
                            <img src="{{ asset('img/lady-avatar3.gif') }}" class="img-fluid rounded" style="height: auto; width: 100%" alt=""/>
                        @else
                            <img src="{{ asset('img/blank.gif') }}" class="img-fluid rounded" style="height: auto; width: 100%" alt=""/>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>{{ Session::get('name') }}</h5>
                    <h6>Department of Computer Science and Engineering</h6>
                    <br><br>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Others</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="qr-tab" data-toggle="tab" href="#qr" role="tab" aria-controls="qr" aria-selected="false">QR</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn-group-vertical">
                    <button type="submit" class="btn btn-dark" name="btnAddMore" value="Edit Profile" data-toggle="modal" data-target="#exampleModal">Edit profile</button>
                    @if( $data->image )
                        <button class="btn btn-info circle-image">Circle image</button>
                    @endif
                </div>
                <!-- Edit modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit personal information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('update-personal-data') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" value="{{ Session::get('name') }}" id="" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Student Id</label>
                                                <input type="text" value="{{ Session::get('student_id') }}" id="" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" value="{{ Session::get('student_email') }}" id="" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" value="{{ $data->phone }}" name="phone" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" value="{{ $data->address }}" name="address" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Father name</label>
                                                <input type="text" value="{{ $data->father_name }}" name="father_name" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Mother name</label>
                                                <input type="text" value="{{ $data->mother_name }}" name="mother_name" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Blood group</label>
                                                <input type="text" value="{{ $data->blood_group }}" name="blood_group" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" value="0" @if($data->gender == '0') checked @endif type="radio" name="gender" id="male">
                                                    <label class="form-check-label" for="male">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" value="1" @if($data->gender == '1') checked @endif type="radio" name="gender" id="female">
                                                    <label class="form-check-label" for="female">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group custom-btn btn-block">
                                                Choose image
                                                <input type="file" name="image" id="image_file" class="hide_file">
                                            </div>
                                        </div>
                                        <div class="col-md-4 image-preview-section">
                                            <span style="display: none" class="mb-2 preview">Image preview</span>
                                            <div class="image-preview mb-2">
                                                <!-- Image section -->
                                            </div>
                                            <button style="display: none" class="btn btn-info btn-sm btn-block remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit modal end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work bar">
                    @if( $account_setup == '3' )
                        <h4 class="small font-weight-bold">Account Setup (30%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '4' )
                        <h4 class="small font-weight-bold">Account Setup (40%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '5' )
                        <h4 class="small font-weight-bold">Account Setup (50%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '6' )
                        <h4 class="small font-weight-bold">Account Setup (60%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '7' )
                        <h4 class="small font-weight-bold">Account Setup (70%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '8' )
                        <h4 class="small font-weight-bold">Account Setup (80%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '9' )
                        <h4 class="small font-weight-bold">Account Setup (90%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif( $account_setup == '10' )
                        <h4 class="small font-weight-bold">Account Setup (100%) <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Student Id</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ Session::get('student_id') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ Session::get('name') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ Session::get('student_email') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->phone )
                                    <p>{{ $data->phone }}</p>
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Address</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->address )
                                    <p>{{ $data->address }}</p>
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Blood group</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->blood_group )
                                    @if( $data->blood_group == 'A+' || $data->blood_group == 'a+' )
                                        <p>{{ $data->blood_group }} (A positive)</p>
                                    @elseif( $data->blood_group == 'A-' || $data->blood_group == 'a-' )
                                        <p>{{ $data->blood_group }} (A negative)</p>
                                    @elseif( $data->blood_group == 'B+' || $data->blood_group == 'b+' )
                                        <p>{{ $data->blood_group }} (B positive)</p>
                                    @elseif( $data->blood_group == 'B-' || $data->blood_group == 'b-' )
                                        <p>{{ $data->blood_group }} (B negative)</p>
                                    @elseif( $data->blood_group == 'O+' || $data->blood_group == 'o+' )
                                        <p>{{ $data->blood_group }} (O positive)</p>
                                    @elseif( $data->blood_group == 'O-' || $data->blood_group == 'o-' )
                                        <p>{{ $data->blood_group }} (O negative)</p>
                                    @elseif( $data->blood_group == 'AB+' || $data->blood_group == 'ab+' )
                                        <p>{{ $data->blood_group }} (AB positive)</p>
                                    @elseif( $data->blood_group == 'AB-' || $data->blood_group == 'ab-' )
                                        <p>{{ $data->blood_group }} (AB negative)</p>
                                    @endif
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Father name</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->father_name )
                                    <p>{{ $data->father_name }}</p>
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mother name</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->mother_name )
                                    <p>{{ $data->mother_name }}</p>
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Gender</label>
                            </div>
                            <div class="col-md-6">
                                @if( $data->gender )
                                    @if( $data->gender == '0' )
                                        <p>Male</p>
                                    @elseif( $data->gender == '1' )
                                        <p>Female</p>
                                    @endif
                                @else
                                    <p>N \ A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="qr" role="tabpanel" aria-labelledby="qr-tab">
                        <div class="row ml-5">
                            <div class="col-md-6">
                                @if( $data->gender == '0' )
                                    {!! QrCode::size(220)
                                        ->color(53, 49, 49)
                                        ->errorCorrection('H')
                                        ->generate('Student ID: '.$data->student_id.' ** '.
                                                    'Name: '.$data->name.' ** '.
                                                    'Email: '.$data->email.' ** '.
                                                    'Phone: '.$data->phone.' ** '.
                                                    'Address: '.$data->address.' ** '.
                                                    'Father name: '.$data->father_name.' ** '.
                                                    'Mother name: '.$data->mother_name.' ** '.
                                                    'Blood group: '.$data->blood_group.' ** '.
                                                    'Gender: Male' 
                                                    ); 
                                    !!}
                                @elseif( $data->gender == '1' )
                                    {!! QrCode::size(220)
                                        ->color(53, 49, 49)
                                        ->errorCorrection('H')
                                        ->generate('Student ID: '.$data->student_id.' ** '.
                                                    'Name: '.$data->name.' ** '.
                                                    'Email: '.$data->email.' ** '.
                                                    'Phone: '.$data->phone.' ** '.
                                                    'Address: '.$data->address.' ** '.
                                                    'Father name: '.$data->father_name.' ** '.
                                                    'Mother name: '.$data->mother_name.' ** '.
                                                    'Blood group: '.$data->blood_group.' ** '.
                                                    'Gender: Female' 
                                                    ); 
                                    !!}
                                @else
                                    {!! QrCode::size(220)
                                        ->color(53, 49, 49)
                                        ->errorCorrection('H')
                                        ->generate('Student ID: '.$data->student_id.' ** '.
                                                    'Name: '.$data->name.' ** '.
                                                    'Email: '.$data->email.' ** '.
                                                    'Phone: '.$data->phone.' ** '.
                                                    'Address: '.$data->address.' ** '.
                                                    'Father name: '.$data->father_name.' ** '.
                                                    'Mother name: '.$data->mother_name.' ** '.
                                                    'Blood group: '.$data->blood_group.' ** '.
                                                    'Gender: Not selected' 
                                                    ); 
                                    !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        document.querySelector('#image_file').addEventListener('change', function(e){
            var image_preview = document.querySelector('.image-preview');
            document.querySelector('.preview').style.display = "block";
            document.querySelector('.remove-btn').style.display = "block";
            $('.custom-btn').css('display', 'none');
            var image = document.createElement('img');
            image.setAttribute('class', 'preImage');
            image.setAttribute('width', '100%');
            image.setAttribute('height', 'auto');
            image.setAttribute('src', URL.createObjectURL(e.target.files[0]));
            image_preview.appendChild(image);
        });

        $(document).ready(function(){
            $('.remove-btn').click(function(e){
                e.preventDefault();
                $('.image-preview').empty();
                $('.remove-btn').css('display', 'none');
                $('.preview').css('display', 'none');
                $('.custom-btn').css('display', 'block');
            });
    
            $('.circle-image').click(function(e){
                e.preventDefault();
                if($(this).text() == 'Circle image'){
                    $('#profile-image').attr('class', 'img-fluid rounded-circle');
                    $(this).text('Rounded image');
                }
                else if($(this).text() == 'Rounded image'){
                    $('#profile-image').attr('class', 'img-fluid rounded');
                    $(this).text('Circle image');
                }
            });
        });
    </script>
@endsection


 