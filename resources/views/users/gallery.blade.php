<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Gallery</title>
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
        <h1 id="header" class="text-center">kaptan Gallery</h1>
        <div id="border"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-2">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            <div class="item active">
                                <img src="images/index2.jpg" alt="Los Angeles" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="images/index3.jpg" alt="Chicago" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="images/index11.jpg" alt="New York" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="images/WhatsApp%20Image%202018-02-17%20at%206.03.42%20PM.jpeg" alt="New York" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="images/WhatsApp%20Image%202018-02-17%20at%206.03.43%20PM.jpeg" alt="New York" style="width:100%;">
                            </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
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


