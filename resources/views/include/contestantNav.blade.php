


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MEGA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="//unpkg.com/alpinejs" defer></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Styles -->
        
        <link rel="stylesheet" href="{{asset('image/Global Talent.png')}}">
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
<body>
    <nav>
        <div class="parent container-fluid">
            <div class="header shadow-sm">
                <div class="navbar navbar-expand-sm container">
                    <div class="pro">
                        <div class="left">
                            <a href="#" class="navbar-brand">
                                <img src="../image/Global Talent.png" alt="">
                            </a>
    
                            <button class="navbar-toggler bell"  id="openSideBar">
                                <i class="fa fa-bars" style="color: black"></i>
                            </button>
                        </div>
                        <div>
                            <div class="show">
                                <ul class="navbar-nav">
                                    <div>
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <li class="nav-items">
                                        <a href="/contestant/dashboard" class="nav-link">
                                            <span></span>
                                            <span>DASHBOARD</span>
                                        </a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="/contestant/login" class="nav-link">
                                            <span></span>
                                            <span>LOGIN</span>
                                        </a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="{{route('contestantLogout')}}" class="nav-link">
                                            <span></span>
                                            <span>LOGOUT</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sideBar">
                        <ul class="navbar-nav">
                            <li class="nav-items">
                                <a href="/contestant/dashboard" class="nav-link">
                                    <span></span>
                                    <span>DASHBOARD</span>
                                </a>
                            </li>
                            <li class="nav-items">
                                <a href="/contestant/login" class="nav-link">
                                    <span></span>
                                    <span>LOGIN</span>
                                </a>
                            </li>
                            <li class="nav-items">
                                <a href="{{route('contestantLogout')}}" class="nav-link">
                                    <span></span>
                                    <span>LOGOUT</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
       $(document).ready(function(){
        $('.sideBar').hide()
        $('#openSideBar').click(function(){
            $('.sideBar').toggle()   
        })
       })
    </script>
</body>
</html>

<style>
    html,body{ 
        margin: 0px;
    }
    .container-fluid{
        padding: 0px;
        margin: 0px;
    }
    nav{
        width: 100%;
        top: -10% !important;
        margin: 0;
        z-index: 100;
        border-bottom: 3px solid #5F0F40;
        align-items: center;
        background-color: white;
    }
    
    .show a{
        font-weight: bold;
        color: black;
    }
    .show a:hover{
        color: rgb(226, 223, 223);
    }
    /* .show{
        display: flex;
        margin-left: 30% !important;
    } */
    .sideBar{
        display: none;
    }
    .navbar{
        display: flex;
        justify-content: space-between !important;
    }
   .navbar-nav{
        display: flex;
        align-items: center;
    }
    .pro{
        width: 100% !important;
        padding: 0px;
        margin: 0px;
        display: flex;
        align-items: center;
        justify-content: space-between !important;
    }
    img{
        width: 70%;    
    }
    .tin2{
        font-weight: bold;
        text-align: center;
    }
    /* .show{
        margin-left: 80%;
    } */

    /* @MEDIA */
    @media(max-width:760px){
        .sideBar{
            background: white;
            top: 0;
            left: -3% !important;
            width: 55%;
            height: 100vh;
            position: absolute !important;
            z-index: 1000;
            box-shadow: 0px 0px 2px black;
            padding: 4% 6%;
            font-size: 17px;
            line-height: 2.5;
            overflow-y: scroll;
        }
        .sideBar a{
            color: black;
            font-weight: bold;
            font-size: 17px;
        }
        .left{
            display: flex;
            justify-content: space-between !important;
            align-items: center;
            width: 100% !important;
        }
        .bell{
            color: white;
        }
        .bell:focus{
            border: 2px solid red !important;
            border-radius: 1%;
            transform: rotate(180deg);
            transform: 0.5s;
        }
        
        .collapse{
            display: none;
        }
        nav{
            width: 100% !important;
        }
        #openSideBar{
            border: 0 !important;
            outline: 0 !important;
        }
        .show{
            display: none;
        }
    }
    

</style>