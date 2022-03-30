<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

         <link rel="stylesheet" href="{{url('/css/voterDash.css')}}">
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.voterNav')
    </div>
    <div class="container-fluid">
        {{-- <div>
            <div id="space" class="space"></div>
        </div> --}}
        <div class="container">
            <div class="parent">
                <div class="fillGroup">
                    <div class="fill">
                        <form action="{{route('vote')}}" method="post">
                            @foreach ($show as $i)
                                <div class="show2">
                                    <div>
                                        <h4>{{$i->name}}</h4>
                                        <p>{{$i->information}}</p>
                                    </div>
                                    <div class="lop">
                                        <img id="imagg">
                                        <div class="change">
                                            <button class="view" type="submit" onclick="vote({{$i->id}})">VOTE</button>
                                        </div>
                                    </div>
                                    @csrf
                                </div>
                            @endforeach
                        </form>
                        <div>
                            <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Pay $5 for vote</a>
                            @if(\Session::has('error'))
                                <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                {{ \Session::forget('error') }}
                            @endif
                            @if(\Session::has('success'))
                                <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                {{ \Session::forget('success') }}
                            @endif
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <style>
        
    </style>
    <script>
       
        function vote(params){
            alert(params);
        }
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</body>
</html>