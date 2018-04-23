<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Register</title>
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
<div class="container" id="logo">
    <img src="images/Untitled-2.png" class="img-responsive center-block">
</div>
<h1 id="header" class="text-center">Admin Register</h1>
<div id="border"></div><br><br>

<div class="container">

    <div class="row">
        <div class="col-lg-4"></div>
        <div id="regCont" class="container col-lg-4">

            <div id="regForm">

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="txtName" type="text" class="form-control input-lg" name="txtName" placeholder="Admin-Name" autocomplete="off">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="txtPassword" type="password" class="form-control input-lg" name="txtPassword" placeholder="PassWord">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="txtrePassword" type="password" class="form-control input-lg" name="txtrePassword" placeholder="Re-PassWord">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="txtemail" type="password" class="form-control input-lg" name="txtemail" placeholder="someone@example.com">
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