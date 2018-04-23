<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Kaptan</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{URL::asset('styles.css')}}">
    @section('styles')
    <script src="scripts.js"></script>
</head>
<body>

<div id="main" class="container-fluid">
    <div id="body">
        <div id="lang">
            <ol class="dropdown">
                <img src="images/gb.png">
                <a class="dropdown-toggle" data-toggle="dropdown" href="indexE.php">English
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="indexA.php"><img src="images/sa.png"> العربيه</a></li>
                    <li><a href="indexT.php"><img src="images/tr.png"> Turkish</a></li>
                </ul>
            </ol>
            <!--<button class="btn btn-success" onclick="location.href='map.php'">Request Driver</button>-->
        </div>
        <div class="container" id="logo">
            <img src="images/Untitled-2.png" class="img-responsive center-block">
        </div>
        <h1 id="header" class="text-center">Welcome To Kaptan</h1>
        <div id="border"></div><br><br>

        <div id="registerBtn" class="container col-sm-12">
             <div class="row">

                 <div class="col-sm-2"></div>
                 <div class="col-sm-2"></div>


                 <div id="createAcc" class="col-sm-2">
                     <button class="btn btn-success" onclick="location.href='register.php'">Create Account</button>
                 </div>

                 <div id="loginBtn" class="col-sm-2">
                     <button class="btn btn-primary" onclick="location.href='login.php'">Login</button>
                 </div>

                 <div class="col-sm-2"></div>

             </div>
        </div>

        <div id="social" class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-1"></div>
                <div id="phone" class="col-lg-1 col-sm-1"><li><a href="http://facebook.com/"><i class="fa fa-phone"></i></a></li></div>
                <div id="linkedin" class="col-lg-1 col-sm-1"><li><a href="http://linkedin.com/"><i class="fa fa-linkedin"></i></a></li></div>
                <div id="twitter" class="col-lg-1 col-sm-1"><li><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li></div>
                <div id="face" class="col-lg-1 col-sm-1"><li><a href="http://plus.google.com/"><i class="fa fa-facebook"></i> </a></li></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div id="sidebar" class="sidenav col-md-2 col-sm-1">
                <div id="div1"><a href="indexE.php"><i class="fa fa-home menu"></i><br>Home</a></div>
                <div id="div2"><a href="aboutE.php"><i class="fa fa-info menu"></i><br>About</a></div>
                <div id="div3"><a href="customersE.php"><i class="fa fa-user"></i><br>Customers</a></div>
                <div id="div4"><a href="whyUsE.php"><i class="fa fa-question"></i><br>Why US</a></div>
                <div id="div5"><a href="galleryE.php"><i class="fa fa-image"></i><br>Gallery</a></div>
                <div id="div6"><a href="contactE.php"><i class="fa fa-envelope menu"></i><br>Contact</a></div>
            </div>
            <div id="toggle-btn" onclick="toggleSidebar(this) ; myFunction()" >
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

</div>

</body>
</html>


