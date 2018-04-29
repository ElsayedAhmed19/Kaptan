@extends("layouts.master")
@section('title', "Make Request")
@section("content")
@section('content_header')
<ol class="breadcrumb">
  <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Clients</a></li>
    <li class="active">Make Request</li>
</ol>
@endsection
<section class="content">
    <div class="row">
        <form method="post" action="{{URL('requests/create_request')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="col-md-6">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Requests</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Customer</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                          </div>
                          <select class="form-control" name="customerId">
                            @foreach($clients as $client)
                                <option value="{{$client['userID']}}">{{$client['fullname']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Pickup</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="glyphicon glyphicon-home"></i>
                          </div>
                          <input type="text" id="pickup" class="form-control geocomplete_pickup" name="pickup">
                        </div>
                        @if ($errors->has('pickup'))
                            <span class="help-block">
                                <strong>{!! 'You must select pickup place' !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Destination</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="glyphicon glyphicon-plane"></i>
                          </div>
                          <input type="text" id="destination" class="form-control geocomplete_destination" name="destination">
                        </div>

                        @if ($errors->has('destination'))
                            <span class="help-block">
                                <strong>{!! 'You must select destination place' !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                          <input type="submit" value="Submit" class="form-control btn btn-primary">
                        </div>
                    </div>
                    <input type="hidden" name="pickup_lat" id="pickup_lat">
                    <input type="hidden" name="pickup_long" id="pickup_long">

                    <input type="hidden" name="destination_lat" id="destination_lat">
                    <input type="hidden" name="destination_long" id="destination_long">
                </div>
              </div>
            </div>
        </form>
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-body">
              <div class="col-md-12"  id="map" style="height: 412px"></div>
            </div>
          </div>
        </div>
    </div>
</section>
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBxD7m7Qqn0jrQuZNpIZxC37uqK2iPeeRU"></script>
<script src="{!!asset('dist/js/jquery.geocomplete.js')!!}"></script>

<script>
  $(function () {

   function initialize() {
        var turkey = {lat: 38.9637, lng: 35.2433};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: turkey
        });
        var locations = [];
        var latlng_pickup;
        var latlng_destination;

        var pickup = document.getElementById('pickup');
        var autocomplete_pickup = new google.maps.places.Autocomplete(pickup);
        google.maps.event.addListener(autocomplete_pickup, 'place_changed', function () {
            var place = autocomplete_pickup.getPlace();
            var pickup_lat = place.geometry.location.lat();
            var pickup_long = place.geometry.location.lng();

            $('#pickup_lat').val(pickup_lat);
            $('#pickup_long').val(pickup_long);

            latlng_pickup = new google.maps.LatLng(pickup_lat, pickup_long);

            var marker = new google.maps.Marker({
                position: latlng_pickup,
                title: $("#pickup").val(),
                draggable: true,
                map: map
            });
            map.setCenter(marker.getPosition())
        });

        var destination = document.getElementById('destination');
        var autocomplete_destination = new google.maps.places.Autocomplete(destination);
        google.maps.event.addListener(autocomplete_destination, 'place_changed', function () {
            var place = autocomplete_destination.getPlace();
            var destination_lat = place.geometry.location.lat();
            var destination_long = place.geometry.location.lng();
            $('#destination_lat').val(destination_lat);
            $('#destination_long').val(destination_long);

            latlng_destination = new google.maps.LatLng(destination_lat, destination_long);

            var marker = new google.maps.Marker({
                position: latlng_destination,
                title: $("#destination").val(),
                draggable: true,
                map: map
            });
            map.setCenter(marker.getPosition());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 

  })
</script>
@endsection
@endsection