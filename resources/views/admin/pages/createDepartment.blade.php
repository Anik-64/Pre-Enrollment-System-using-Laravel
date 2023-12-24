@extends('admin.layout.adminDefault')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('success') }}&nbsp<i class="fas fa-check"></i>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}&nbsp<i class="fas fa-times"></i>
        </div>
    @endif

    @if(Session::has('duplicate_error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('dept_name') }}{{ Session::get('duplicate_error') }}&nbsp<i class="fas fa-times"></i>
        </div>
    @endif

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <input type="number" name="create_department" id="create_department" 
            class="form-control" placeholder="Number of department fields" min="1">                
        </div>
        <div class="col-md-3">
            <button class="btn btn-info btn-md" id="add_text_field">
                <i class="fas fa-arrow-circle-down"></i>
                Create department
            </button>
        </div>                        
    </div>
    <hr>
    
    <div class="default-img-container">
        <img src="{{ asset('img/department_02.jpg') }}" alt="" class="img-fluid mx-auto d-block" id="default-img">
    </div>
    <!-- width: auto; height: 100px; -->
    <form method="post" action="{{ url('store-department') }}">
        @csrf
        <div class="card mb-2" style="display: none">
            <div class="card-header">
                <h5 class="text-center">Input Deparment Information</h5>
            </div>
            <div class="card-body">
                <!-- Main content -->
            </div>
            <div class="card-footer d-flex">
                <button class='btn btn-info btn-md mr-2' id="add_dept_button" style="display: none">
                    <i class="fas fa-plus-circle"></i>
                    Add department
                </button>
                <button class='btn btn-danger btn-md' id="remove_all_button" style="display: none">
                    <i class="fas fa-trash"></i>
                    Remove all
                </button>
            </div>
        </div>
    </form>

@endsection

@section('script')

<script>
    $(document).ready(function(){

        $('#add_text_field').click(function(){

            if( $('#create_department').val() > 0 ){

                // $('#default-img').hide('slow');
                $('.default-img-container').hide('slow');
                $('#create_department').css('border', '1px solid #d1d3e2');

                var number_of_field = parseInt($('#create_department').val());
                var element = 
                "<div class='row mb-3'>\
                    <div class='col-6'>\
                        <input type='text' name='dept_name[]' class='form-control' placeholder='Department full name' required>\
                    </div>\
                    <div class='col-3'>\
                        <select name='dept_abbreviation[]' class='form-control' required>\
                            <option value='' class='bg-gray-200'>Select abbreviation</option>\
                            <option value='CE' class='bg-gray-200'>CE</option>\
                            <option value='CSE' class='bg-gray-200'>CSE</option>\
                            <option value='EEE' class='bg-gray-200'>EEE</option>\
                            <option value='ME' class='bg-gray-200'>ME</option>\
                            <option value='LAW' class='bg-gray-200'>LAW</option>\
                            <option value='MATH' class='bg-gray-200'>MATH</option>\
                        </select>\
                    </div>\
                    <div class='col-3'>\
                        <input type='text' name='dept_contact_no[]' class='form-control' placeholder='Department Contact number' required>\
                    </div>\
                </div>";
    
                for(let i=0; i<number_of_field; i++){
                    $('.card-body').append(element);
                }

                $('.card').css('display', 'block');
                $('#add_dept_button').css('display', 'block');   
                $('#remove_all_button').css('display', 'block');                
            }
            else{
                $('#create_department').css('border', '1px solid red');
            }
        });

        $('#remove_all_button').click(function(e){
            e.preventDefault();
            $('#create_department').val('');
            $('.card-body').empty();
            $('.default-img-container').show(800);
            $('.card').css('display', 'none');
            $('#add_dept_button').css('display', 'none');                
            $('#remove_all_button').css('display', 'none');
        });


    });
</script>

@endsection