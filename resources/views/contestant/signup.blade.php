<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <div class="parent">
        <div class="card card-body">

            <div class="cont">
                <a href="#" class="navbar-brand">
                    <img src="../image/Global Talent.png" alt="">
                </a>
            </div>
            <div>
                <h4> Contestant Signup</h4>
            </div>
            <form action="{{route('contestantSignup')}}" method="post">
                @if($su=Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>{{$su}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" placeholder="First Name" name="first_name" value="{{old('first_name')}}" class="form-control {{$errors->has('first_name') ? 'is-inavlid' : '' }}">
                    @error('first_name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" placeholder="Last Name" name="last_name" value="{{old('last_name')}}" class="form-control {{$errors->has('last_name') ? 'is-inavlid' : '' }}">
                    @error('last_name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text"  placeholder="mail@website.com" name="email" value="{{old('email')}}" class="form-control {{$errors->has('email') ? 'is-inavlid' : '' }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" placeholder="0**********" name="phone_number" value="{{old('phone_number')}}" class="form-control {{$errors->has('phone_number') ? 'is-inavlid' : '' }}">
                    @error('phone_number')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" placeholder="Min. 8 characters" value="{{old('password')}}"  name="password" class="form-control @error('password') is-inavlid @enderror">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" value="{{old('password_confirmation')}}" placeholder="Min. 8 characters" name="password_confirmation" class="form-control @error('password_confirmation') is-inavlid @enderror">
                    @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                @csrf
                <div class="logg">
                    <button type="submit">Register</button>
                </div>
                <div class="cage">
                    <span>OR</span>
                </div>
                <div class="google">
                    <a href="{{url('contestant/auth/redirect')}}">
                        <span><i class="fa fa-google"></i></span>
                        <span>Continue with Google</span>
                    </a>
                </div>
            </form>

            
            <div class="pat1">
                <p><span>Already have an account? </span> <span><a href="./login" class="text-decoration-none">Login</a></span></p>
            </div>

            <div class="pat2">
                <p>By continuing, you agree to the app <span class="pat3">Term of Service</span> and <span class="pat3">Privacy Policy.</span></p>
            </div>
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
            box-shadow: 2px 2px 2px 0px rgb(128, 127, 127);
        }
        img{
            width: 70%;   
        }
        .cont{
            display: flex;
            justify-content: center;
        }
        .logg{
            text-align: center;
            padding-top: 10px;
            margin-bottom: -5px;
        }
        .logg button{
            border: 0px;
            background-color: rgb(154, 3, 30);
            color: white;
            border-radius: 5px;
            padding: 2px 10px;
            font-weight: bold;
        }
        .cage{
            text-align: center;
            padding: 10px 0px 10px 0px;
            
        }
        .google{
            text-align: center;
        }
        .google a{
            background-color: black;
            color: white;
            border: 0px;
            border-radius: 5px;
            padding: 10px 15px;
            text-decoration: none;
        }
        .pat1{
            text-align: center;
            font-size: 12px;
            padding-top: 10px;
        }
        .pat2{
            text-align: center;
            font-size: 12px;
        }
        .pat3{
            color:blue;
        }
        h4{
            text-align: center;
        }
        label{
            font-weight: bold;
        }

        @media(max-width:760px){
            .parent{
                width: 100%;
            }
        }
    </style>
</body>
</html>