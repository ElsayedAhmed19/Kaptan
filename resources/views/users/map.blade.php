<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Kaptan | Request</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/iconlogo.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
    <style>
        #map {
            height: 100%;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<html>
<body>
<div id="map"></div>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: new google.maps.LatLng(29.969912,31.284094),
            mapTypeId: 'terrain'
        });

    }
    // Loop through the results array and place a marker for each
    // set of coordinates.

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDV1ystdcgOCt_flgJjDMPN27rzcdDI9Y&callback=initMap">
</script>

<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-functions.js"></script>

<script>
    // Set the configuration for your app
    // TODO: Replace with your project's config object
    var config = {
        apiKey: "AIzaSyCIKlDQj51PyFIVhiVHGJJi2VshLaphiO8",
        authDomain: "driveme-73fd6.firebaseapp.com",
        databaseURL: "https://driveme-73fd6.firebaseio.com",
        projectId: "driveme-73fd6",
        storageBucket: "driveme-73fd6.appspot.com/"
    };
    firebase.initializeApp(config);

    firebase.auth().signInAnonymously().catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;

        console.log(errorCode+""+errorMessage);
        // ...
    });


    // Get a reference to the database service
    var database = firebase.database();
    //console.log(database);

    /*var postData = {
     author: "author",
     uid: "id",
     body: "body",
     title: "title",
     starCount: 0,
     authorPic: "pic"
     };
     // Get a key for a new Post.
     var newPostKey = firebase.database().ref().child('users/admin/').push().key;
     // Write the new post's data simultaneously in the posts list and the user's post list.
     var updates = {};
     updates['/users/admin/' + newPostKey] = postData;
     //console.log(firebase.database().ref().update(updates));
     */

    var drivers = [];
    //var driversTemp = [];
    var driversLocation = {};

    var userData = firebase.database().ref('/locations/allDrivers/');
    userData.on("value", function(snapshot) {
        //console.log(snapshot.val());
        //driversTemp = [];
        snapshot.forEach(function(userSnapshot) {
            var user = userSnapshot.val();
            console.log(user);
            if(user.latitude != null && user.longitude != null) {
                //driversTemp.push(user);
                drivers.push({
                    "lat": user.latitude,
                    "lng": user.longitude,
                    "customObject":{user}
                });
            }

        });
        //console.log(drivers);
        //console.log(driversTemp);
        for (var i=0 ; i <drivers.length ; i++)
        {
            var lat = drivers[i].lat;
            var lng= drivers[i].lng;
            var currentDriver = drivers[i].driverData;
            var latLng = new google.maps.LatLng(lat , lng);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                customObject : drivers[i]
            });
            google.maps.event.addListener(marker, "click", function() {
                //username userID phone isOnTrip
                var marker = this;
                var currentCustom = JSON.parse(this.customObject)
                alert('ID is :'+currentCustom.username);
                console.log("agamy",marker)
            });
        }

    }, function (errorObject) {
        console.log("The read failed: " + errorObject.code);
    });

    //console.log(userData);

</script>

</body>
</html>

