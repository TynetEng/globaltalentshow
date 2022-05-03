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
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.adminNav')
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="panell">
                
                <div>
                    <div>
                        <div class="panel">
                            
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="border-0" onclick="history.back()" style="background-color: transparent">
                                    <i class="fa fa-arrow-left"></i>
                                </button>
                                <div>
                                    <button class="close" onclick="exitForm()"><i class="fa fa-close"></i></button>
                                </div>
                            </div>
                            <div class="inner">
                                <form action="{{route('update')}}" method="POST" enctype="multipart/form-data">
                                    @if($su=Session::get('error'))
                                        <div class="alert alert-danger  alert-dismissible fade show"  role="alert">
                                            <strong>{{$su}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            
                                        </div>
                                    @endif  
                                    <input type="hidden" name="id" value="{{$dataa->id}}">
                                    <div class="form-group">
                                        <label for="">Contestant's Name</label>
                                        <input type="text" class="form-control @error('contName') is-inavlid @enderror" name="contName"   value="{{$dataa->name}}">
                                        @error('contName')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contestant's Email</label>
                                        <input type="text" class="form-control @error('contEmail') is-inavlid @enderror" name="contEmail"   value="{{$dataa->contestantEmail}}">
                                        @error('contEmail')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <label for="">Contestant's Information</label>
                                        <textarea name="contInfo" rows="5">{{$dataa->information}}</textarea>
                                        @error('contInfo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="part">
                                        <label for="">TRACKING CODE</label>
                                        <div class="fillCode">
                                            <input type="code" value="{{$dataa->trackingNumber}}" name="code" class="form-control till @error('code') is-inavlid @enderror">
                                            <span onclick="generateCode()" class="generate" @disabled(true)>GENERATE</span>
                                        </div>
                                        @error('code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="image">
                                            <i class="fa fa-avatar"></i>
                                            <img src="{{asset('images/'.$dataa->image)}}" alt=""  class="imagg">
                                        </div>
                                        <div>
                                            <input type="file" name="image"  value="{{old('image')}}" onchange="displayImage()" class="@error('image') is-inavlid @enderror img"><br>
                                            @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="ref">
                                        <button class="reg" type="submit">UPDATE DETAILS</button>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                
                
            </div>
        </div>
    </div>
    
    <script>     
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
        function exitForm(){
            document.querySelector('.panel').style.display= "none";
        }

    </script>
</body>
</html>