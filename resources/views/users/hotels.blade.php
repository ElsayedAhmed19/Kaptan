<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Customers</title>
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
        <h1 id="header" class="text-center">Our Customers</h1>
        <div id="border"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <ul>
                            <li><a href="http://www.hurryinn.com/"><img src="images/logo.png" class="img-thumbnail"><h3 style="color: white"><a href="http://www.hurryinn.com/">HURRY INN HOTEL</a></h3></a></li>
                            <li><a href="http://www.hotellinoistanbul.com/"><img src="images/logo_lino-1.png" class="img-thumbnail"><h3 style="color: white ; margin-left: 40px"><a href="http://www.hotellinoistanbul.com/">HOTELLINO</a></h3></a></li>
                            <li><a href="http://sirkecimansion.com/"><img src="images/sirkeci_mansion_sign9147.jpg" class="img-thumbnail"><h3 style="color: white ; margin-left: -30px"><a href="http://sirkecimansion.com/">SİRKECİ MANSİON HOTEL</a></h3></a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <ul>
                            <li><a href="http://www.corinnehotel.com/"><img src="images/10579773.548030611fa33.jpg" class="img-thumbnail"><h3 style="color: white ; margin-left: 20px"><a href="http://www.corinnehotel.com/">CORINNE HOTEL</a></h3></a></li>
                            <li><a href="http://www.peradays.com/"><img src="images/static.sabeeapp.com.jpg" class="img-thumbnail"><h3 style="color: white ; margin-left: 15px"><a href="http://www.peradays.com/">PERADAYS HOTEL</a></h3></a></li>
                            <li><a href="https://www.turaturizm.com.tr/"><img src="images/turaturizm_logo.png" class="img-thumbnail"><h3 style="color: white ; margin-left: 40px"><a href="https://www.turaturizm.com.tr/">Tura Turizm</a></h3></a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <ul>
                            <li><a href="http://ilkayhotel.com/"><img src="images/Capture.PNG" class="img-thumbnail"><h3 style="color: white; margin-left: 40px"><a href="http://ilkayhotel.com/">İLKAY HOTEL</a></h3></a></li>
                            <li><a href="http://lalahanhotel.com/"><img src="images/CcnT8JDXIAQus1I.png" class="img-thumbnail"><h3 style="color: white; margin-left: 30px"><a href="http://lalahanhotel.com/">Lalahan HOTEL</a></h3></a></li>
                            <li><a href="http://www.azureturizm.com/"><img src="images/46d3469e-ae6f-476d-970d-bc4facb7cc22.png" class="img-thumbnail"><h3 style="color: white; margin-left: 30px"><a  href="http://www.azureturizm.com/">AZURE turızm</a></h3></a></li>
                        </ul>
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


