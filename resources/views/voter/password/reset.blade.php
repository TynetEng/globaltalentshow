<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <title>Reset Password</title>
</head>
<body>
    <div class="parent">
        <div class="card card-body">

            <div class="text-center">
                <h4>Voter Reset Password</h4>
            </div>
            <form action="{{route('voterResetPassword')}}" method="post">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger" role="alert">
                        {{session('fail')}}
                    </div>
                @endif

                <input type="hidden" name='token' value="{{$token}}">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{ $email ?? old('emaill')}}" placeholder="mail@website.com" class="form-control {{$errors->has('email') ? 'is-inavlid' : '' }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <div class="d-flex inputContainer align-items-center form-group">
                        <input type="password" class="inputt" value="{{old('password')}}" placeholder="Password must have min. of 8 characters with at least one letter, number, symbol" name="password" class="form-control @error('password') is-inavlid @enderror">
                        <i class="fa fa-eye" onclick="togglePassword(this)"></i>
                    </div>
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <div class="d-flex inputContainer align-items-center form-group">
                        <input type="password" class="inputtt" value="{{old('password_confirmation')}}" placeholder="Min. 8 characters" name="password_confirmation" class="form-control @error('password_confirmation') is-inavlid @enderror">
                        <i class="fa fa-eye" onclick="toggleConfirmPassword(this)"></i>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                @csrf
                <div class="logg">
                    <button type="submit">Reset Password</button>
                </div>
                <a href="{{route('voterLogin')}}" class="text-decoration-none text-center font-weight-bold">Login</a>
            </form>
            
        </div>
        
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caladea&display=swap');
        body{
            background-color: black;
            font-family: 'Caladea';
        }
        .parent{
            margin: auto;
            width: 30%;
            margin-top: 10%;
            box-shadow: 2px 2px 2px 0px rgb(128, 127, 127);
        }
        img{
            width: 70%;   
        }
        .inputContainer{
            width: 100%;
            border: 1px solid #CED4DA;
            padding: 5px;
            border-radius: 5px;
        }
        .inputt, .inputtt{
            border: 0px;
            outline: 0px;
            width: 92%;
        }
        .cont{
            display: flex;
            justify-content: center;
        }
        .logg{
            text-align: center;
            padding-top: 10px;
        }
        .logg button{
            border: 0px;
            background-color: rgb(154, 3, 30);
            color: white;
            border-radius: 5px;
            padding: 2px 10px;
            font-weight: bold;
        }
        label{
            font-weight: bold;
        }
        .rmb{
            font-weight: 400
        }

        @media(max-width:760px){
            .parent{
                width: 100%;
            }
        }
    </style>

    <script>
        let display = document.querySelector('.inputt');
        let display2 = document.querySelector('.inputtt');
        
        function togglePassword(params){
            let result = display.getAttribute('type')==="password" ? "text" : "password";
            display.setAttribute("type", result);
            params.classList.toggle("fa-eye-slash");
        }

        function toggleConfirmPassword(params){
            let result = display2.getAttribute('type')==="password" ? "text" : "password";
            display2.setAttribute("type", result);
            params.classList.toggle("fa-eye-slash");
        }
    </script>
</body>
</html>