<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Sign-Up</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{URL::asset('styles.css')}}">
    <script src="{{URL::asset('scripts.js')}}"></script>
</head>
<body>

<div class="container" id="logo">
    <img src="{{URL::asset('images/Untitled-2.png')}}" class="img-responsive center-block">
</div>
<h1 id="header" class="text-center">Choose Your Account Type</h1>
<div id="border"></div><br><br>

<div id="reg" class="container">

    <div class="row">

        <div class="col-lg-4">
            <button id="adminReg" class="btn btn-primary btn-block" onclick="location.href='admin.php'">Admin</button>
        </div>

        <div class="col-lg-4">
            <button id="clientReg" class="btn btn-success btn-block" onclick="location.href='register.php'">Client</button>
        </div>

        <div class="col-lg-4">
            <button id="driverReg" class="btn btn-success btn-block" onclick="location.href='register.php'">Driver</button>
        </div>

    </div>

</div>

</body>
</html>