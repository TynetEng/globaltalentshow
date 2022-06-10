<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
        
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->

    <link rel="stylesheet" href="{{url('/css/contestants.css')}}">
    <title>View Contestant</title>
</head>
<body>
    <div>
        @include('include.adminNav')
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="panel2">
                <div>
                    <div class="">
                        <button class="border-0" onclick="history.back()" style="background-color: transparent">
                            <i class="fa fa-arrow-left"></i>
                        </button>
                        <h2 class="text-center">CONTESTANT {{$dataa->id}}</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <img id="imagg" src="{{asset('images/'.$dataa->image)}}">
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h4>{{$dataa->name}}</h4>
                                <p>{{$dataa->information}}</p>
                            </div>
                            <div>
                                <h6>Number of vote: <span></span></h6>
                            </div>
                        </div>
                    </div>
                </div> 
                
                
            </div>
        </div>
    </div>
    
    <script>
        window.onload=function(){
            let a = @json($dataa->image);
            console.log(a);
            document.querySelector('.imagg').style.display = "inherit";
            let reader = new FileReader;
            let img = document.querySelector('.img').files[0];

            reader.onload=function(){
                document.querySelector('.imagg').src=reader.result;
            }
            reader.readAsDataURL(a);
        }
            
        // TO DISPLAY IMAGE ONCHANGE
        function displayImage(){
            document.querySelector('.imagg').style.display = "inherit";
            let reader = new FileReader;
            let img = document.querySelector('.img').files[0];

            reader.onload=function(){
                document.querySelector('.imagg').src=reader.result;
            }
            reader.readAsDataURL(img);

        }

    </script>
</body>
</html>