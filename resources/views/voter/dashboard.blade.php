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