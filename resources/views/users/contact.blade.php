<?php

if(isset($_POST["submit"])){
// Checking For Blank Fields..
    if($_POST["vname"]==""||$_POST["vemail"]==""||$_POST["phone"]==""||$_POST["msg"]==""){
    }else{
// Check if the "Sender's Email" input field is filled out
        $email=$_POST['vemail'];
// Sanitize E-mail Address
        $email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email){
            $mes='Invalid E-mail';
            echo "<script>alert($mes)</script>";
        }
        else{
            $phone = $_POST['phone'];
            $message = $_POST['msg'];
            $headers = 'From:'. $email . "\r\n"; // Sender's Email
            $headers .= 'Cc:'. $email . "\r\n"; // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
            $message = wordwrap($message, 100);
// Send Mail By PHP Mail Function
            mail("info@kaptan-vip.com", $phone, $message, $headers);
            $mess = 'Your Message has been sent successfuly ! Thank you for your Contact';
            echo "<script type='javascript'>alert($mess)</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Contact-US</title>
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
        </div>
        <div id="logo">
            <img src="images/Untitled-2.png" class="img-responsive center-block">
        </div>
        <h1 id="header" class="text-center">Contact US</h1>
        <div id="border"></div>
        <div class="container">
            <div class="row">
                <div id="main" class="col-md-4 col-sm-2">
                    <h1 style="color: black ; font-size: 25px" class="text-center">Send your Message</h1>
                    <form class="form-horizontal" action="#" id="form" method="post" name="form">
                        <div class="form-group">

                            <div class="col-sm-12">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control" id="email" placeholder="Full Name" name="vname">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-12">
                                <label class="control-label" >E-mail:</label>
                                <input type="email"  class="form-control" placeholder="someone@example.com" name="vemail">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <label class="control-label">Phone:</label>
                                <input type="number" class="form-control"  placeholder="Phone Number" name="phone">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <label class="control-label">Message:</label>
                                <textarea name="msg" class="form-control" placeholder="Write Your Message"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button id="send" name="submit" type="submit" class="btn btn-success btn-block btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                    <h3><?php include "secure_email_code.php"?></h3>
                </div>
                <div class="col-md-6" id="contact">
                    <a href="#" style="color: black ; font-size: 20px"><li class="fa fa-phone" style="color: blue ; font-size: 40px"></li>  Call US: 00902125167701</a><br><br>
                    <a href="#" style="color: black ; font-size: 20px"><li class="fa fa-map-marker" style="color: blue ; font-size: 40px"></li> Haznedar mah Şevketdağ cadNo 12/aGüngören istanbul</a><br><br>
                    <a href="#" style="color: black ; font-size: 20px"><li class="fa fa-globe" style="color: blue ; font-size: 40px"></li> info@kaptan-vip.com</a><br>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">
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


