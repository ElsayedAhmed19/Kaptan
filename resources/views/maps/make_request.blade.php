@extends("layouts.master")
@section('title', "Add Client")
@section("content")

@section('content_header')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('clients')}}">Clients</a></li>
        <li class="active">Add client</li>
    </ol>
@endsection
<div class="content">
    <div id="map" class="col-md-8" style="height: 500px"></div>
    <div class="col-md-2">
        <input type="button" name="make_request" id="btnRequest" class="btn btn-primary" value="Order request">
    </div>
</div>
@endsection
@section('scripts')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyD1Gl5s7GwdjHGSUcA7sseiHIkmWCtLS-0"></script>

<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-functions.js"></script>

<script>
    $(document).ready(function () {
        var mapCanvas = document.getElementById("map");

        requestData = [];
        $.ajax({
            url: "{{url('drivers/get-drivers-to-map')}}",
            method: 'GET',
            success: function(drivers){
                var mapOptions = {
                    center: new google.maps.LatLng(drivers[0].latitude, drivers[0].longitude), zoom: 10
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                for (var i=0; i < drivers.length; i++)
                {
                    var lat = drivers[i].latitude;
                    var lng= drivers[i].longitude;

                    // var currentDriver = drivers[i].driverData;
                    var latLng = new google.maps.LatLng(lat , lng);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                        icon: 'brown_markerA.png'
                    });
                    

                   
                    google.maps.event.addListener(marker, "click", function() {                
                        var marker = this;
                        var currentOne  = drivers.pop(this.customObject);
                        var infowindow = new google.maps.InfoWindow({
                            content: currentOne["username"] + "\n" + currentOne["phone"],
                        });
                        infowindow.open(map, marker);
                        for(key in currentOne) {
                            if(currentOne.hasOwnProperty(key)) {
                                var value = currentOne[key];
                                console.log(value)
                            }
                        }
                    });
                }
            },
            error: function(){
                alert('erroring');
            }
        });
    });
    //console.log(userData);
</script>
@endsection