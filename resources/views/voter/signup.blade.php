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
                <h4> Voter Signup</h4>
            </div>
            <form action="{{route('voterSignup')}}" method="post">
                @if($su=Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>{{$su}}</strong>
                    </div>
                @endif

                <div>
                    <label for="">First Name</label>
                    <input type="text" placeholder="First Name" name="fName" value="{{old('fName')}}" class="form-control {{$errors->has('fName') ? 'is-inavlid' : '' }}">
                    @error('fName')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Last Name</label>
                    <input type="text" placeholder="Last Name" name="lName" value="{{old('lName')}}" class="form-control {{$errors->has('lName') ? 'is-inavlid' : '' }}">
                    @error('lName')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="text"  placeholder="mail@website.com" name="email" value="{{old('email')}}" class="form-control {{$errors->has('email') ? 'is-inavlid' : '' }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Phone Number</label>
                    <input type="text" placeholder="0**********" name="phone" value="{{old('phone')}}" class="form-control {{$errors->has('phone') ? 'is-inavlid' : '' }}">
                    @error('phone')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" placeholder="Min. 8 characters and max. 12 characters" value="{{old('password')}}"  name="password" class="form-control @error('password') is-inavlid @enderror">
                    @error('password')
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
                    <a href="{{url('/auth/redirect')}}">
                        <span><i class="fa fa-google"></i></span>
                        <span>Continue with Google</span>
                    </a>
                </div>
            </form>

            
            <div class="pat1">
                <p><span>Already have an account? </span> <span><a href="./login">Login</a></span></p>
            </div>

            <div class="pat2">
                <p>By continuing, you agree to the app <span class="pat3">Term of Service</span> and <span class="pat3">Privacy Policy.</span></p>
            </div>
        </div>
    </div>

    <style>
        body{
            background-color: black;
        }
        .parent{
            margin: auto;
            width: 30%;
            margin-top: 2%;
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

        @media(max-width:760px){
            .parent{
                width: 100%;
            }
        }
    </style>
</body>
</html>