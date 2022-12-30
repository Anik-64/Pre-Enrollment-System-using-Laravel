<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @if(Session::has('blank_user_field') || Session::has('email_error'))
        <style>
            #email{
                border: 1px solid red;
            }
        </style>
    @endif
    @if(Session::has('blank_password_field') || Session::has('password_error'))
        <style>
            #password{
                border: 1px solid red;
            }
        </style>
    @endif
</head>
<body style="background-color: aliceblue;">
    
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="card shadow-lg bg-light" style="width: 30rem;">
            <div class="text-center border-bottom"><h4 class="m-2 text-dark text-muted">Login</h4></div>
            @if(Session::has('registration_error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('registration_error') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ url('store-login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ Session::get('email') }}" id="email" name="email" placeholder="Enter your email">
                        <small class="form-text text-danger" id="email_error">
                            @if(Session::has('blank_user_field'))
                                {{ Session::get('blank_user_field') }}
                            @elseif(Session::has('email_error'))
                                {{ Session::get('email_error') }}
                            @endif
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="{{ Session::get('password') }}" id="password" name="password" placeholder="Enter your password">
                        <small class="form-text text-danger">
                            @if(Session::has('blank_password_field'))
                                {{ Session::get('blank_password_field') }}
                            @elseif(Session::has('password_error'))
                                {{ Session::get('password_error') }}
                            @endif
                        </small>
                    </div>
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-lg form-control" id="submit_button">Log in</button>
                    </div>
                </form>
                <div class="mb-2"><a href="{{ url('/') }}" class="text-dark register_btn">Do you have an account?</a></div>
                <div class=""><a href="{{ url('forget-password') }}" class="text-dark register_btn">Forget password?</a></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
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
        })
    </script>
</body>
</html>