@extends('admin.layout.adminDefault')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-info" role="alert">{{ Session::get('success') }}&nbsp<i class="fas fa-check"></i></div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
    @endif

    @if(Session::has('department_error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('department_error') }}&nbsp<i class="fas fa-times"></i>
        </div>
    @endif

    @if(Session::has('duplicate_error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('course_name') }}{{ Session::get('duplicate_error') }}&nbsp<i class="fas fa-times"></i>
        </div>
    @endif

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <input type="number" name="create_course" id="create_course" 
            class="form-control" placeholder="Number of course fields" min="1">                
        </div>
        <div class="col-md-4">
            <select id="department" class="form-control">
                <option value="">Select department</option>
                @foreach( $departments as $department )
                    <option value="{{ $department->dept_abbreviation }}">{{ $department->dept_abbreviation }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-info btn-md" id="add_text_field">
                <i class="fas fa-arrow-circle-down"></i>
                Create Course
            </button>
        </div>                        
    </div>
    <hr>
    <div class="default-img-container">
        <img src="{{ asset('img/courses_01.jpg') }}" alt="" class="img-fluid mx-auto d-block" id="default-img" style="height: auto; width: 60%">
    </div>
    <form method="post" action="{{ url('store-course') }}">
        @csrf
        <div class="card mb-2" style="display: none">
            <div class="card-header">
                <h5 class="text-center">Input Course Information</h5>
            </div>
            <div class="card-body">
                <!-- Main content -->
            </div>
            <div class="card-footer d-flex">
                <button class='btn btn-info btn-md mr-2' id="add_course_button" style="display: none">
                    <i class="fas fa-plus-circle"></i>
                    Add course
                </button>
                <button class='btn btn-danger btn-md' id="remove_all_button" style="display: none">
                    <i class="fas fa-trash"></i>
                    Remove all
                </button>
            </div>
        </div>
        <input type='hidden' name='department' value='' id="hidden_value">
    </form>

@endsection

@section('script')
<script>
    $(document).ready(function(){

        $('#add_text_field').click(function(){

            if( $('#department').val() != '' && $('#create_course').val() != '' ){

                $('#department').css('border', '1px solid #d1d3e2');
                $('#create_course').css('border', '1px solid #d1d3e2');
                $('.default-img-container').hide('slow');

                var department = $('#department').val();
                $('#hidden_value').val(department);
                var number_of_field = parseInt($('#create_course').val());
                var element = "<div class='row mb-3'>\
                    <div class='col-5'>\
                        <input type='text' name='course_name[]' class='course_name form-control' placeholder='Course name' required>\
                    </div>\
                    <div class='col-2'>\
                        <input type='text' name='course_code[]' class='course_code form-control' placeholder='Course code' required>\
                    </div>\
                    <div class='col-2'>\
                        <select name='credit_hour[]' class='credit_hour form-control' required>\
                            <option value=''>Credit hour</option>\
                            <option value='1'>1</option>\
                            <option value='2'>2</option>\
                            <option value='3'>3</option>\
                            <option value='3.5'>3.5</option>\
                            <option value='4'>4</option>\
                        </select>\
                    </div>\
                    <div class='col-3'>\
                        <select name='semester[]' class='semester form-control' required>\
                            <option value=''>Select semester</option>\
                            <option value='1st'>1st</option>\
                            <option value='2nd'>2nd</option>\
                            <option value='3rd'>3rd</option>\
                            <option value='4th'>4th</option>\
                            <option value='5th'>5th</option>\
                            <option value='6th'>6th</option>\
                            <option value='7th'>7th</option>\
                            <option value='8th'>8th</option>\
                        </select>\
                    </div>\
                </div>";
    
                for(let i=0; i<number_of_field; i++){
                    $('.card-body').append(element);
                }
                if($('#create_course').val() > 0){
                    $('.card').css('display', 'block');
                    $('#add_course_button').css('display', 'block');
                    $('#remove_all_button').css('display', 'block');
                }

            }
            else if( $('#create_course').val() != '' && $('#department').val() == '' ){
                $('#create_course').css('border', '1px solid #d1d3e2');
                $('#department').css('border', '1px solid red');
            }
            else if( $('#create_course').val() == '' && $('#department').val() != '' ){
                $('#department').css('border', '1px solid #d1d3e2');
                $('#create_course').css('border', '1px solid red');
            }
            else{
                $('#department').css('border', '1px solid red');
                $('#create_course').css('border', '1px solid red');
            }
        });

        $('#remove_all_button').click(function(e){
            e.preventDefault();
            $('#create_course').val('');
            $('#department').val('');
            $('#hidden_value').val('');
            $('.card-body').empty(); // it removes child element
            $('.card').css('display', 'none');
            $('.default-img-container').show(800);
            $('#add_course_button').css('display', 'none');                
            $('#remove_all_button').css('display', 'none');
        });

        $('#add_course_button').click(function(){
            $('.default-img-container').css('display', 'block');
        })
        // $(document).on('keyup', '.course_name', function(){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: "/check-duplicate-course",
        //         type: "post",
        //         dataType: "json",
        //         data:{
        //             courseName: $('.course_name').val()
        //         },
        //         success: function(response){
        //             if(response != 'Not found'){
        //                 $('.duplicate').text('Dulicate entry');
        //                 $('.duplicate').css('display', 'block');
        //             }else{

        //                 $('.duplicate').text('');
        //                 $('.duplicate').css('display', 'none');
        //             }
        //         }
        //     })
        // });
    });
</script>
@endsection