<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
                <h4> Admin login</h4>
            </div>
            <form action="{{route('adminLogin')}}" method="post">
                @if($su=Session::get('error'))
                    <div class="alert alert-danger  alert-dismissible fade show"  role="alert">
                        <strong>{{$su}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif  
                <div>
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{old('emaill')}}" class="form-control {{$errors->has('email') ? 'is-inavlid' : '' }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" value="{{old('passwordd')}}"  name="password" class="form-control @error('password') is-inavlid @enderror">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div>
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label for="remember">
                </div>
                @csrf
                <div class="logg">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
            <div>
                <p>Don't have an account? <span><a href="./signup">signup</a></span></p>
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
            margin-top: 10%;
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
        }
        .logg button{
            border: 0px;
            background-color: green;
            color: white;
            border-radius: 5px;
            padding: 2px 10px;
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