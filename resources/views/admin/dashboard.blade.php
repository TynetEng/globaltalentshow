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

    <link rel="stylesheet" href="{{url('/css/adminDash.css')}}">
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.adminNav')
    </div>

    <div>
        <div class="panel">
            <div class="board1">
                <div class="row">
                    <div class="col-sm-2 pad1">
                        <div class="data">
                            0
                        </div>
                        <div class="no">
                            Total Contestants
                        </div>
                    </div>
                    <div class="col-sm-2 pad2">
                        <div class="data">
                            0
                        </div>
                        <div class="no">
                            Total votes
                        </div>
                    </div>
                    <div class="col-sm-2 pad3">
                        <div class="data">
                            0
                        </div>
                        <div class="no">
                            Highest Votes
                        </div>
                    </div>
                    <div class="col-sm-2 pad4">
                        <div class="data">
                            0
                        </div>
                        <div class="no">
                            Total payments receive
                        </div>
                    </div>
                </div>
            </div>
            <div class="board2">

            </div>
        </div>
    </div>
    

</body>
</html>