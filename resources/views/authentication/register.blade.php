<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @if(Session::has('error'))
        <style>
            #password, #confirm{
                border: 1px solid red;
            }
            #name, #email{
                border: 1px solid #d1d3e2;
            }
        </style>
    @endif
    @if(Session::has('error') && Session::has('student_id'))
        <style>
            #password, #confirm{
                border: 1px solid red;
            }
            #name, #email, #student_id{
                border: 1px solid #d1d3e2;
            }
        </style>
    @endif
    @if(Session::has('id_error'))
        <style>
            #student_id{
                border: 1px solid red;
            }
            #name, #email{
                border: 1px solid #d1d3e2;
            }
        </style>
    @endif
</head>
<body style="background-color: aliceblue;">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="card shadow-lg bg-light" style="width: 30rem;">
            <div class="text-center border-bottom"><h4 class="m-2 text-muted">Registration</h4></div>
            <div class="card-body">
                <form action="{{ url('store-register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ Session::get('name') }}" name="name" placeholder="Jhon Wick">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Session::get('email') }}" name="email" placeholder="xyz@gmail.com">
                        <small class="form-text text-danger" id="email_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Student Id</label>
                        <input type="text" class="form-control" id="student_id" value="{{ Session::get('student_id') }}" name="student_id" autocomplete="off" placeholder="Enter your ID">
                        <small class="form-text text-danger" id="id_error">{{ Session::get('id_error') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirm password</label>
                        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Re-enter your password">
                        <small class="form-text text-danger" id="confirm_error">{{ Session::get('error') }}</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit_button" class="btn btn-lg form-control">Signup</button>
                    </div>
                </form>
                @if(Session::has('fetch_error'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('fetch_error') }}
                </div>
                @endif
                <div class="text-center"><a href="{{ url('login') }}" class="text-dark login_link">Login</a></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#confirm').keyup(function(){
                var password = $('#password').val();
                var confirm = $(this).val();
                if(password != confirm){
                    $('#confirm_error').text('*passwords are not matching');
                    // $('#submit_button').prop('disabled', true);
                    $('#submit_button').css('display', 'none');
                }else{
                    $('#confirm_error').text('');
                    // $('#submit_button').prop('disabled', false);
                    $('#submit_button').css('display', 'block');
                }
            });
            $('#student_id').keyup(function(){
                var student_id = $(this).val();
                if(student_id.length != 13){
                    $('#id_error').text('*Id must be 13 digit');
                    $('#submit_button').prop('disabled', true);
                }else{
                    $('#id_error').text('');
                    $('#submit_button').prop('disabled', false);
                }
            });
            $('#email').keyup(function(){
                var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value);
                if(!valid){
                    $('#email_error').text('*Email must be in the right format');
                    $('#submit_button').prop('disabled', true);
                }else{
                    $('#email_error').text('');
                    $('#submit_button').prop('disabled', false);
                }
            })
        }); 
    </script>
</body>
</html>