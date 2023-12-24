@extends('student.layout.studentDefault')

@section('custom_css')
    <!-- <style>
        .table-text{
            font-size: 15px;
        }
    </style> -->
@endsection

@section('content')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <select id="session_name" class="form-control">
                <option value="">Select session</option>
                @foreach($session_name_info as $s)
                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>                       
    </div>
    <hr>
    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}&nbsp<i class="fas fa-check"></i></div>
    @endif
    <table class="table table-hover table-sm table-bordered table-responsive-md" id="erollment_table" style="display: none">
        <thead class="bg-gray-200">
            <tr>
                <th style="width: 20px">No.</th>
                <th class="col-5">Course name</th>
                <th class="text-center">Course code</th>
                <th class="text-center">Semester</th>
                <th class="text-center">Type</th>
            </tr>
        </thead>
        <tbody>
            <form action="{{ url('store-enrollment') }}" method="post">
                @csrf
                @foreach($course_info as $c)
                    @if($loop->iteration == 1)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn1">Select 1st</button>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td><input type="checkbox" id="course_id{{ $c->id }}" value="{{ $c->id }}" name="course_id[]" aria-label="Checkbox for following text input"></td>
                        <td>{{ $c->course_name }}</td>
                        <td class="text-center">{{ $c->course_code }}</td>
                        <td class="text-center">{{ $c->semester }}</td>
                        <td class="text-center">
                            <select id="student_type{{ $c->id }}" name="student_type[]" class="form-control">
                                <option value="">Select type</option>
                                <option value="Regular">Regular</option>
                                <option value="Recourse">Recourse</option>
                            </select>
                        </td>
                    </tr>
                    @if($loop->iteration == $semester_1st)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn2">Select 2nd</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_2nd)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn3">Select 3rd</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_3rd)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn4">Select 4th</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_4th)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn5">Select 5th</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_5th)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn6">Select 6th</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_6th)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn7">Select 7th</button>
                            </td>
                        </tr>
                    @endif
                    @if($loop->iteration == $sum_7th)
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <button class="btn btn-info btn-sm btn-block select_all_btn8">Select 8th</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td><input type="hidden" name="session_name" id="session_n"></td>
                    <td colspan="4">
                        <button type="submit" class="btn btn-success btn-md btn-block">Submit</button>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#session_name').change(function(){
                var session_name = $('#session_name').val();
                $('#session_n').val(session_name);
                if($('#session_name').val().length > 0){
                    $('#erollment_table').css('display', 'block');
                }else{
                    $('#erollment_table').css('display', 'none');
                }
            });

            for(let i=1; i<9; i++){
                $(document).on('click', '.select_all_btn'+i+'', function(e){
                    e.preventDefault();
                    if($('.select_all_btn'+i+'').text() == 'Select 1st'){
                        $('.select_all_btn'+i+'').text('Remove 1st');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn1');
                        if(i==1){
                            for(let j=2; j<10; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 1st'){
                        $('.select_all_btn'+i+'').text('Select 1st');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn1');
                        if(i==1){
                            for(let j=2; j<10; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 2nd semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 2nd'){
                        $('.select_all_btn'+i+'').text('Remove 2nd');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn2');
                        if(i==2){
                            for(let j=10; j<18; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 2nd'){
                        $('.select_all_btn'+i+'').text('Select 2nd');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn2');
                        if(i==2){
                            for(let j=10; j<18; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 3rd semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 3rd'){
                        $('.select_all_btn'+i+'').text('Remove 3rd');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn3');
                        if(i==3){
                            for(let j=18; j<26; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 3rd'){
                        $('.select_all_btn'+i+'').text('Select 3rd');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn3');
                        if(i==3){
                            for(let j=18; j<26; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 4th semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 4th'){
                        $('.select_all_btn'+i+'').text('Remove 4th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn4');
                        if(i==4){
                            for(let j=26; j<34; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 4th'){
                        $('.select_all_btn'+i+'').text('Select 4th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn4');
                        if(i==4){
                            for(let j=26; j<34; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 5th semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 5th'){
                        $('.select_all_btn'+i+'').text('Remove 5th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn5');
                        if(i==5){
                            for(let j=34; j<43; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 5th'){
                        $('.select_all_btn'+i+'').text('Select 5th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn5');
                        if(i==5){
                            for(let j=34; j<43; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 6th semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 6th'){
                        $('.select_all_btn'+i+'').text('Remove 6th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn6');
                        if(i==6){
                            for(let j=43; j<52; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 6th'){
                        $('.select_all_btn'+i+'').text('Select 6th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn6');
                        if(i==6){
                            for(let j=43; j<52; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 7th semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 7th'){
                        $('.select_all_btn'+i+'').text('Remove 7th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn7');
                        if(i==7){
                            for(let j=52; j<61; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 7th'){
                        $('.select_all_btn'+i+'').text('Select 7th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn7');
                        if(i==7){
                            for(let j=52; j<61; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                    // 8th semester btn
                    else if($('.select_all_btn'+i+'').text() == 'Select 8th'){
                        $('.select_all_btn'+i+'').text('Remove 8th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-danger btn-sm btn-block select_all_btn8');
                        if(i==8){
                            for(let j=61; j<69; j++){
                                $('#course_id'+j+'').prop('checked', true);
                                $('#student_type'+j+'').val('Regular');
                            }
                        }
                    }else if($('.select_all_btn'+i+'').text() == 'Remove 8th'){
                        $('.select_all_btn'+i+'').text('Select 8th');
                        $('.select_all_btn'+i+'').attr('class', 'btn btn-info btn-sm btn-block select_all_btn8');
                        if(i==8){
                            for(let j=61; j<69; j++){
                                $('#course_id'+j+'').prop('checked', false);
                                $('#student_type'+j+'').val('');
                            }
                        }
                    }
                });
            }

            for(let i=2; i<69; i++){
                $(document).on('click', '#course_id'+i+'', function(){
                    if($(this).prop("checked") == true) {
                        $('#student_type'+i+'').val('Regular');
                    }
                    else if($(this).prop("checked") == false) {
                        $('#student_type'+i+'').val('');
                    }
                });
            }
        });
    </script>
@endsection