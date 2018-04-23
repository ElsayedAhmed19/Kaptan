<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="{{Route('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{Route('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Route('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <script src="{{Route('scripts.js')}}"></script>
</head>
<body>
<div class="container" id="logo">
    <img src="images/Untitled-2.png" class="img-responsive center-block">
</div>
<h1 id="header" class="text-center">Driver Register</h1>
<div id="border"></div><br><br>

<div class="container">

    <div class="row">
        <div class="col-lg-4"></div>
        <div id="regCont" class="container col-lg-4">

            <div id="regForm">
                <form action="{{Route('drivers/add-driver')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Driver-Name" autocomplete="off" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="email" class="form-control input-lg" name="email" placeholder="someone@example.com" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input id="car_model" type="text" class="form-control input-lg" name="car_model" placeholder="Car Model" value="{{ old('car_model') }}">
                        @if ($errors->has('car_model'))
                            <span class="help-block">
                                <strong>{{ $errors->first('car_model') }}</strong>
                            </span>
                        @endif
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        <input id="car_number" type="Number" class="form-control input-lg" name="car_number" placeholder="Car Number" value="{{ old('car_number') }}">
                        @if ($errors->has('car_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('car_number') }}</strong>
                            </span>
                        @endif
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="phone" type="phone" class="form-control input-lg" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div><br> 
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control input-lg" name="password" placeholder="PassWord">
                        @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password_confirmation" type="password" class="form-control input-lg" name="password_confirmation" placeholder="Re-PassWord">
                    </div><br>

                    <button type="submit" id="submit" name="submit" class="btn btn-success btn-block">Register</button>

                    <br><br>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>