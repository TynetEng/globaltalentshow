<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/css/welcome.css')}}">
    <title>Document</title>
</head>
<body>
    <div>
        {{-- <div>
            @include('include.adminNav')
        </div> --}}
        
        <div>
            <div class="container-fluid">
                <div>
                    <!-- particles.js container --> <div id="particles-js"></div> <!-- stats - count particles --> <div class="count-particles"> <span class="js-count-particles">--</span> particles </div> <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib --> <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
                </div>
                <nav class="text-center py-3">
                    <img class='imgg' src="{{asset('image/white.png')}}" alt="">
                </nav>
                <div class="parent">
                    <div class="container">
                        <div class="panel">
                            <div class="row headie">
                                <div class="col-sm-6 pt-5">
                                    <div>
                                        <h2>LET'S SHOWCASE YOUR FASCINATING TALENT TO THE WORLD</h2>
                                        <p>Global Talent easily manage your skills, talents, and gifts. And let the world know what've you got inside...</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('image/vote-general.png')}}" alt="">
                                </div>
                            </div>
                            <div class="row hay">
                                <div class="col-sm-3 card card-body shade">
                                    <h4 class="text-center">Admin</h4>
                                    <p>As an admin, you must be registered and authorized by the organization <b>Global Talent</b>.</p>
                                    <div class="bot">
                                        <a href="/admin">Get started as an Admin</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 card card-body shade">
                                    <h4 class="text-center">Contestant</h4>
                                    <p>As a contestant, you must be registered and authorized by the <b>Global Talent Admin</b>.</p>
                                    <div class="bot">
                                        <a href="/contestant">Get started as a Contestant</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 card card-body shade">
                                    <h4 class="text-center">Voter</h4>
                                    <p>As a voter, you are solely obliged to vote for your choice of contestant.</p>
                                    <div class="bot">
                                        <a href="/voter">Get started as a Voter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        particlesJS("particles-js", 
        {"particles":{"number":{"value":80,"density":{"enable":false,"value_area":800}},
        "color":{"value":"#ffffff"},"shape":{"type":"circle",
        "stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},
        "image":{"src":"img/github.svg","width":100,"height":100}},
        "opacity":{"value":0.5,"random":false,
        "anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},
        "size":{"value":3,"random":true,
        "anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},
        "line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},
        "move":{"enable":true,"speed":2,"direction":"none","random":false,"straight":false,"out_mode":"out",
        "bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},
        "interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},
        "onclick":{"enable":true,"mode":"push"},"resize":true},
        "modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},
        "bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},
        "repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},
        "remove":{"particles_nb":2}}},
        "retina_detect":true});
        var count_particles, stats, update; stats = new Stats; stats.setMode(0); 
        stats.domElement.style.position = 'absolute'; 
        stats.domElement.style.left = '0px'; 
        stats.domElement.style.top = '0px'; 
        document.body.appendChild(stats.domElement); 
        count_particles = document.querySelector('.js-count-particles'); 
        update = function() { stats.begin(); stats.end(); 
            if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) 
            { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; }
             requestAnimationFrame(update); }; requestAnimationFrame(update);;
    </script>
</body>
</html>