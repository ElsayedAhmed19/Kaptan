@extends("layouts.master")
@section('title', "All Clients")
@section("content")
@section('content_header')
<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Clients</a></li>
    <li class="active">All client</li>
</ol>
@endsection

<div class="content">
    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="long" id="long">

    <div class="col-md-6">
        <label class="col-md-2 c-label">Location</label>
        
        <div class="col-md-8 input" style="padding-right:0px">
            <input id="geocomplete" type="text" class="form-control" placeholder="Type in an address"
               value="Nasr City"/>
        </div>

        <div class="map_canvas col-md-12" style="height: 400px"></div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBxD7m7Qqn0jrQuZNpIZxC37uqK2iPeeRU"></script>

    <script src="{!!asset('dist/js/jquery.geocomplete.js')!!}"></script>

    <script type="text/javascript">
        $(function () {

            $("#geocomplete").geocomplete({
                map: ".map_canvas",
                details: "#formy ul",
                detailsAttribute: "data-geo"
            });

            $("#geocomplete").geocomplete().bind("geocode:result", function (event, result) {
                $("#lat").val(result.geometry.location.lat());
                $("#long").val(result.geometry.location.lng());
                //console.log(result);
            });
            $("#find").click(function () {
                load_map();
            });

            function load_map() {
                var latLng = $("#geocomplete").trigger("geocode");
                $("#geocomplete").geocomplete().bind("geocode:result", function (event, result) {
                    $("#lat").val(result.geometry.location.lat());
                    $("#long").val(result.geometry.location.lng());
                });
            }

            //load map when loading page
            load_map();

            var map = $('map-canvas');
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
            });

            function placeMarker(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            $("#btn_cancel").on('click', function () {
                window.history.back();
            });
        });
    </script>
@endsection