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

    <title>Admin Login</title>
</head>
<body>
    <div class="parent">
        <div class="card card-body">

            <div class="cont text-center">
                <a href="#" class="navbar-brand">
                    <img src="../image/Global Talent.png" alt="">
                </a>
            </div>
            <div class="text-center">
                <h4> Admin login</h4>
            </div>
            <form action="{{route('adminLogin')}}" method="post">
                @if($su=Session::get('error'))
                    <div class="alert alert-danger  alert-dismissible fade show d-flex justify-content-between"  role="alert">
                        <strong>{{$su}}</strong>
                        <button type="button" class="close border-0" data-dismiss="alert" aria-label="Close" style="background-color: transparent">
                            <span aria-hidden="true" style="font-weight: bolder">×</span>
                        </button>
                    </div>
                @endif 
                
                {{-- ALERT FOR SUCCESSFUL RESET PASSWORD --}}
                @if (session('info'))
                    <div class="alert alert-success" role="alert">
                        {{session('info')}}
                    </div>
                @endif
                
                {{-- ALERT FOR LOGOUT --}}
                @if (session('log'))
                    <div class="alert alert-success" role="alert">
                        {{session('log')}}
                    </div>
                @endif


                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{$verifiedEmail ?? old('emaill')}}" placeholder="mail@website.com" class="form-control {{$errors->has('email') ? 'is-inavlid' : '' }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <div class="d-flex inputContainer align-items-center form-group">
                        <input type="password" class="inputt" value="{{old('password')}}" placeholder="Min. 8 characters" name="password" class="form-control @error('password') is-inavlid @enderror">
                        <i class="fa fa-eye" onclick="togglePassword(this)"></i>
                    </div>
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <input type="checkbox" id="remember">
                        <label for="remember" class="rmb">Remember me</label for="remember">
                    </div>
                    <div>
                        <a href="{{route('adminRequest')}}" class="text-decoration-none pat">Forgot password?</a>
                    </div>
                </div>
                @csrf
                <div class="logg">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
            <footer class="text-center">
                <p>Not registered yet? <span><a href="./signup" class="text-decoration-none pat">Create an account</a></span></p>
            </footer>
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
        .inputt{
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
        .pat{
            color:rgb(154, 3, 30);
        }
        .pat:hover{
            color:rgb(77, 14, 26);
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
        
        function togglePassword(params){
            let result = display.getAttribute('type')==="password" ? "text" : "password";
            display.setAttribute("type", result);
            params.classList.toggle("fa-eye-slash");
        }
    </script>
</body>
</html>