function toggleSidebar(ref) {
    ref.classList.toggle('active');
    document.getElementById('sidebar').classList.toggle('active');
}
function myFunction() {
    var x = document.getElementById("body");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

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

