<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body>
<div id="logo">
    <img src="images/Untitled-2.png" class="img-responsive center-block">
</div>
<h1 id="header" class="text-center">Login Here</h1><br>
<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <form id="loginForm" action="" method="" enctype="multipart/form-data">

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="txtName" type="text" class="form-control input-lg" name="Name" placeholder="User-Name" autocomplete="off">
                </div><br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="txtPassword" type="password" class="form-control input-lg" name="Pass" placeholder="PassWord">
                </div><br>

                <button type="submit" id="blogin" name="blogin" class="btn btn-default btn-block">Login</button><br>

                <a href="#" id="forget" name="forgetPass">Forget Password?</a><br><br>
                <label id="check" class="container">Remember Me
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </form>

        </div>

    </div>

</div>

</body>
</html>