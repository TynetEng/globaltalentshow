<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div>
        @include('include.nav')
    </div>
    <div class="parent">
        <div class="container-fluid">
            <div class="container">
                <div class="part">
                    <form action="" method="POST">
                        @csrf
                        <div class="p-3">
                            <button type="submit">VOTE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>