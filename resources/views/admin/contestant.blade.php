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
        <div>
            <!-- particles.js container --> <div id="particles-js"></div> <!-- stats - count particles --> <div class="count-particles"> <span class="js-count-particles">--</span> particles </div> <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib --> <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
        </div>
        <div class="container">
            <div class="parent">
                
                <div>
                    <div>
                        <div class="fill">
                            @foreach ($show as $i)
                                <div class="show2">
                                    <div>
                                        <h4>{{$i->name}}</h4>
                                        <p>{{$i->information}}</p>
                                    </div>
                                    <div>
                                        <img id="imagg">
                                        <div class="change">
                                            <button class="view">VIEW</button>
                                            <button class="edit">EDIT</button>
                                            <button class="del">DELETE</button>
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
                                    <form action="{{route('contestants')}}" method="POST">
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
                                <form action="{{route('contestants')}}" method="POST" enctype="multipart/form-data">
                                    @if($su=Session::get('error'))
                                        <div class="alert alert-danger  alert-dismissible fade show"  role="alert">
                                            <strong>{{$su}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif  
                                                    <div>
                                        <label for="">Contestant's Name</label>
                                        <input type="text" class="form-control @error('contName') is-inavlid @enderror" name="contName"   value="{{old('contName')}}">
                                        @error('contName')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <label for="">Contestant's Information</label>
                                        <textarea name="contInfo" rows="5"></textarea>
                                        @error('contInfo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="image">
                                            <i class="fa fa-avatar"></i>
                                            <img src="" alt="">
                                        </div>
                                        <div>
                                            <input type="file" name="image"  value="{{old('image')}}" class="@error('image') is-inavlid @enderror">
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


        let contestantImage = @json($show);
        console.log(contestantImage);
        setTimeout(() => {
            document.getElementById('imagg').src = `{{url('storage/${contestantImage[0].image}')}}`;
        }, 1000);


        document.querySelector('.panel').style.display = "none";

        let showBox=()=>{
            document.querySelector('.panel').style.display = "inherit";
        }

        // function selectedImage(){
        //     alert()
        // }

        particlesJS("particles-js", {"particles":{"number"
        :{"value":80,"density":{"enable":false,"value_area":800}},"color":
        {"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},
        "polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},
        "opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},
        "size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},
        "line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},
        "move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,
        "out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},
        "interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},
        "onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,
        "line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,
        "speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":
        {"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats =
         new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute';
          stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px';
           document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); 
           update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].
           pJS.particles && window.pJSDom[0].pJS.particles.array) 
           { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; }
            requestAnimationFrame(update); }; requestAnimationFrame(update);;

        function exitForm(){
            document.querySelector('.panel').style.display= "none";
        }

        
        
    </script>
</body>
</html>