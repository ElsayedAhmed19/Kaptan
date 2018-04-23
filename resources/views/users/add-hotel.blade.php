<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{url('styles.css')}}">
    <script src="{{url('scripts.js')}}"></script>
</head>
<body>
<div class="container" id="logo">
    <img src="{{url('images/Untitled-2.png')}}" class="img-responsive center-block">
</div>
<h1 id="header" class="text-center">Client Register</h1>
<div id="border"></div><br><br>

<div class="container">

    <div class="row">
        <div class="col-lg-4"></div>
        <div id="regCont" class="container col-lg-4">

            <div id="regForm">

                <form action="{{url('hotels/save-hotel')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Hotel Name" autocomplete="off">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control input-lg" name="email" placeholder="Hotel mail" autocomplete="off">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="phone" type="text" class="form-control input-lg" name="phone" placeholder="Phone" autocomplete="off">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password_confirmation" type="password" class="form-control input-lg" name="password_confirmation" placeholder="Retype password">
                    </div><br>
                    <button type="submit" id="breg" name="blogin" class="btn btn-success btn-block">Register</button>

                    <br><br>
                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>