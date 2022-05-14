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

    <link rel="stylesheet" href="{{url('/css/adminNav.css')}}">

    <title>Document</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="backColor">
            <!-- particles.js container --> <div id="particles-js"></div> 
            <!-- stats - count particles --> <div class="count-particles"> 
                <span class="js-count-particles">--</span> particles </div> 
                <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> 
            <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 
            <!-- stats.js lib --> <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
        </div>

        <div class="parent">
            <div class="fill">
                <aside>
                    <div class="clip">
                        <img class='imgg' src="{{asset('image/white.png')}}" alt="" width="100">
                    </div>
                    <div>
                        <button class="dew" onclick="toggleBar()"> 
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="dash">
                        <div class="board">
                            <a href="./dashboard">
                                <div>
                                    <i class="fa fa-delicious"></i>
                                </div>
                                <div class="exp">
                                    <span>Dashboard</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="./profile">
                                <div>
                                    <i class="fa fa-user-circle-o"></i>
                                </div>
                                <div class="exp">
                                    <span>Profile</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="">
                                <div>
                                    <i class="fa fa-bell"></i>
                                </div>
                                <div class="exp">
                                    <span>Notifications</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="./contestant">
                                <div>
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="exp">
                                    <span>Contestants</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="">
                                <div>
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="exp">
                                    <span>Search</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="">
                                <div>
                                    <i class="fa fa-cog"></i>
                                </div>
                                <div class="exp">
                                    <span>Settings</span>
                                </div>
                            </a>
                        </div>
                        <div class="board">
                            <a href="{{route('adminLogout')}}">
                                <div>
                                    <i class="fa fa-sign-out"></i>
                                </div>
                                <div class="exp">
                                    <span>Logout</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </aside>

                <nav>
                    <div>
                        <h4>Admin</h4>
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                    
                    <div>
                        @foreach ($data as $i)
                            <div class="fillNav">
                                <div class="cir">
                                    <span>{{$first}}</span>
                                    <span>{{$sec}}</span>
                                </div>
                                <p class="nameText">
                                    <span>{{$i->firstName}}</span>
                                    <span>{{$i->lastName}}</span>
                                </p> 
                            </div>                           
                        @endforeach 
                    </div>
                    
                </nav>

            </div>
        </div>
    </div>

    <script>
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
        

        function toggleBar(){
            document.querySelector('.exp').classList.toggle('.exp');
        }
    </script>
</body>
</html>