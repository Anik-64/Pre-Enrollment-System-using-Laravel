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
            {{ Session::get('t_name') }}{{ Session::get('duplicate_error') }}&nbsp<i class="fas fa-times"></i>
        </div>
    @endif

    <div class="row offset-2">
        <div class="col-md-4">
            <input type="number" name="create_teacher" id="create_teacher" 
            class="form-control" placeholder="Number of teacher fields" min="1">                
        </div>
        <div class="col-md-4">
            <select id="department" class="form-control">
                <option value="">Select department</option>
                @foreach( $departments as $department )
                    <option value="{{ $department->dept_abbreviation }}">{{ $department->dept_abbreviation }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-info btn-md" id="add_text_field">
                <i class="fas fa-arrow-circle-down"></i>
                Create Teacher
            </button>
        </div>                        
    </div>
    <hr>
    
    <div class="default-img-container">
        <img src="{{ asset('img/nature4.gif') }}" alt="" class="img-fluid mx-auto d-block mt-5" id="default-img" style="width: 60%; height: auto">
    </div>

    <form method="post" action="{{ url('store-teacher') }}">
        @csrf
        <div class="card" style="display: none">
            <div class="card-header">
                <h5 class="text-center">Input Teacher Information</h5>
            </div>
            <div class="card-body">
                <!-- Main content -->
            </div>
            <div class="card-footer d-flex">
                <button class='btn btn-info btn-md mr-2' id="add_teacher_button" style="display: none">
                    <i class="fas fa-plus-circle"></i>
                    Add Teacher
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

            if( $('#department').val() != '' && $('#create_teacher').val() != '' ){

                $('#department').css('border', '1px solid #d1d3e2');
                $('#create_teacher').css('border', '1px solid #d1d3e2');
                $('.default-img-container').hide('slow');

                var department = $('#department').val();
                $('#hidden_value').val(department);
                var number_of_field = parseInt($('#create_teacher').val());
                var element = 
                "<div class='row mb-3'>\
                    <div class='col-4'>\
                        <input type='text' name='t_name[]' class='form-control' placeholder='Teacher name' required>\
                    </div>\
                    <div class='col-4'>\
                        <input type='email' name='t_email[]' class='form-control' placeholder='Teacher email' required>\
                    </div>\
                    <div class='col-4'>\
                        <select name='t_designation[]' class='form-control' required>\
                            <option value='' class='bg-gray-200'>Select designation</option>\
                            <option value='Lecturer' class='bg-gray-200'>Lecturer</option>\
                            <option value='Assistant lecturer' class='bg-gray-200'>Assistant lecturer</option>\
                            <option value='Professor' class='bg-gray-200'>Professor</option>\
                            <option value='Assistant Professor' class='bg-gray-200'>Assistant Professor</option>\
                            <option value='Associate Professor' class='bg-gray-200'>Associate Professor</option>\
                        </select>\
                    </div>\
                </div>";
    
                for(let i=0; i<number_of_field; i++){
                    $('.card-body').append(element);
                }
                if($('#create_teacher').val() != ''){
                    $('.card').css('display', 'block');
                    $('#add_teacher_button').css('display', 'block');
                    $('#remove_all_button').css('display', 'block');
                }
            }
            else if( $('#create_teacher').val() != '' && $('#department').val() == '' ){
                $('#department').css('border', '1px solid red');
                $('#create_teacher').css('border', '1px solid #d1d3e2');
            }
            else if( $('#create_teacher').val() == '' && $('#department').val() != '' ){
                $('#create_teacher').css('border', '1px solid red');
                $('#department').css('border', '1px solid #d1d3e2');
            }
            else{
                $('#department').css('border', '1px solid red');
                $('#create_teacher').css('border', '1px solid red');
            }
        });

        $('#remove_all_button').click(function(e){
            e.preventDefault();
            $('#create_teacher').val('');
            $('#department').val('');
            $('#hidden_value').val('');
            $('.card-body').empty(); // it removes child element
            $('.card').css('display', 'none');
            $('.default-img-container').show(800);
            $('#add_teacher_button').css('display', 'none');                
            $('#remove_all_button').css('display', 'none');
        });

        $('#add_teacher_button').click(function(){
            $('.default-img-container').css('display', 'block');
            $('.card-body').empty(); // it removes child element
            $('.card').css('display', 'none');
        })

    });
    
</script>
@endsection