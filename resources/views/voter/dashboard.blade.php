<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"
    >
    <link rel="stylesheet" href="{{url('/css/voterDash.css')}}">
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.voterNav')
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="parent">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                <div class="fillGroup">
                    <div class="fill">
                        @foreach ($show as $i)
                            <div class="show2">
                                <div>
                                    <h4>{{$i->name}}</h4>
                                    <p>{{$i->information}}</p>
                                </div>
                                <div class="lop">
                                    <img id="imagg" src="{{asset('images/'.$i->image)}}">
                                    <div class="change">
                                        <button class="view" type="submit" onclick="vote({{$i->id}})">VOTE</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div id="paymentt"></div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

    <style>
        
    </style>
    <script>
        let details = @json($show);
        
        // FUNCTIONALITY FOR VOTE
        function vote(params){
            for (let i = 0; i < details.length; i++) {
                if (params==details[i].id) {
                    document.getElementById('paymentt').innerHTML = `
                        <div class="payment shadow-bg">
                            <div>
                                <div>
                                    <button class="close" type="button" onclick="closePayment()">
                                        <span>×</span>
                                    </button>
                                </div>
                                <div>
                                    <p>Vote for <span><input type="text" value="${details[i].name}" name="contestant" readonly id="contestant"></span></p>
                                </div>
                            </div>

                            
                            <form action="{{url('paypal')}}" method="post">
                                @if(\Session::has('error'))
                                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                    {{ \Session::forget('error') }}
                                @endif
                                @if(\Session::has('success'))
                                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                    {{ \Session::forget('success') }}
                                @endif

                                <div class="take">
                                    <a class="btn btn-primary" href="{{ route('processTransaction') }}">Pay $5 for vote with Paypal</a>
                                </div>
                                
                                @csrf
                            </form>

                            
                            <div class="paystack">
                                <form action="{{route('pay')}}" method="post" id="paymentForm">
                                    @if(\Session::has('error'))
                                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                        {{ \Session::forget('error') }}
                                    @endif
                                    @if(\Session::has('success'))
                                        <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                        {{ \Session::forget('success') }}
                                    @endif

                                    <input type="hidden" name="email" value="{{$voter['email']}}"> {{-- required --}}
                                    <input type="hidden" name="amount" value="200000"> {{-- required in kobo --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="currency" value="NGN">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['voter_name' => $voter['firstName'] . $voter['lastName'], 'user_id'=>$voter['id'] ]) }}" >
                                
                                    
                                    <div class="take">
                                        <button class="btn btn-primary" type="submit">Pay #2000 for vote with Paystack</button>
                                    </div>
                                    
                                    @csrf
                                </form>
                            </div>
                        </div>
                    `
                }   
            }   
        }

        function closePayment(){
            document.querySelector('.payment').style.display= "none"
        }

        
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</body>
</html>