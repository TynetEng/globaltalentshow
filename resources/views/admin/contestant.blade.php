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
                    <div class="fillGroup">
                        <div class="fill">
                            @foreach ($show as $i)
                                <div class="show2">
                                    <div>
                                        <div>
                                            <h4>{{$i->name}}</h4>
                                            <p>{{$i->information}}</p>
                                        </div>
                                        <div>
                                            <h6>Number of vote: <span></span></h6>
                                        </div>
                                    </div>
                                    <div class="team">
                                        <img id="imagg" src="{{asset('images/'.$i->image)}}">
                                        <div class="change">

                                            <!-- VIEW FORM -->
                                            <button class="view" onclick="viewForm({{$i->id}})">VIEW</button>

                                            <!-- EDIT FORM -->
                                            <button onclick="editForm({{$i->id}})" class="edit">EDIT</button>

                                            <!-- DELETE FORM -->
                                            <form action="{{route('delete-contestant', ['id'=>$i->id])}}" method="post">
                                                @csrf
                                                <button class="del" type="submit" onclick="return confirm('Are you sure you want to delete this contestant?')">
                                                     DELETE</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- <div x-data="{show:false}">
                        <template x-if="show">
                            <div class="panel">
                                <div class="inner">
                                    <form action="{{route('contestant')}}" method="POST">
                                        <div>
                                            <label for="">Contestant's Name</label>
                                            <input type="text" class="form-control" name="contName">
                                        </div>
                                        <div class="py-2">
                                            <label for="">Contestant's Information</label>
                                            <textarea name="contInfo" cols="43.5" rows="5"></textarea>
                                        </div>
                                        <div>
                                            <div class="image">
                                                <i class="fa fa-avatar"></i>
                                                <img src="" alt="">
                                            </div>
                                            <input type="file" name="image">
                                        </div>
                                        <div class="ref">
                                            <button class="reg" type="submit">REGISTER VOTER</button>
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </template>
                        <div>
                            <button class="addVote" x-on:click="show=true">+</button>
                        </div>
                    </div> -->
                    <div>
                        <div class="panel">
                            <div>
                                <button class="close" onclick="exitForm()"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="inner">
                                <form action="{{route('contestantForm')}}" method="POST" enctype="multipart/form-data">
                                    @if($su=Session::get('error'))
                                        <div class="alert alert-danger  alert-dismissible fade show"  role="alert">
                                            <strong>{{$su}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif  
                                    <div class="form-group">
                                        <label for="">Contestant's Name</label>
                                        <input type="text" class="form-control @error('contestant_name') is-inavlid @enderror" name="contestant_name"   value="{{old('contestant_name')}}">
                                        @error('contestant_name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contestant's Email</label>
                                        <input type="text" class="form-control @error('contestant_email') is-inavlid @enderror" name="contestant_email"   value="{{old('contestant_email')}}">
                                        @error('contestant_email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <label for="">Contestant's Information</label>
                                        <textarea name="contestant_information" rows="5"></textarea>
                                        @error('contestant_information')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="part">
                                        <label for="">TRACKING CODE</label>
                                        <div class="fillCode">
                                            <input type="code" value="{{old('code')}}"  name="code" class="form-control till @error('code') is-inavlid @enderror">
                                            <span onclick="generateCode()" class="generate">GENERATE</span>
                                        </div>
                                        @error('code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="image">
                                            <i class="fa fa-avatar"></i>
                                            <img src="" alt=""  class="imagg">
                                        </div>
                                        <div>
                                            <input type="file" name="image"  value="{{old('image')}}" onchange="displayImage()" class="@error('image') is-inavlid @enderror img"><br>
                                            @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="ref">
                                        <button class="reg" type="submit">REGISTER VOTER</button>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="addVote" onclick="showBox()">+</button>
                    </div>
                </div> 
                
                
            </div>
        </div>
    </div>
    

    <script>
        document.querySelector('.panel').style.display = "none";
        document.querySelector('.imagg').style.display = "none";

        let showBox=()=>{
            document.querySelector('.panel').style.display = "inherit";
        }

        // TO GENERATE TRACKING CODE
        function generateCode(){
            let code = Math.floor(Math.random() * 1000000);
            document.querySelector('.till').value = `GTC-${code}`;
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

        function exitForm(){
            document.querySelector('.panel').style.display= "none";
        }

        // ROUTE TO EDIT CONTESTANT FORM
        function editForm(params){
            window.location.href =`edit-contestant/${params}`;
        }

        // ROUTE TO VIEW CONTESTANT FORM
        function viewForm(params){
            window.location.href =`view-contestant/${params}`;
        }
        
    </script>
</body>
</html>