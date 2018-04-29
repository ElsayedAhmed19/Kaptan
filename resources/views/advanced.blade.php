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
    <section class="content">
      <div class="row">
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
                  <select class="form-control">
                    <option>Elsayed Ahmed</option>
                    <option>Elsayed Ahmed</option>
                    <option>Elsayed Ahmed</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Driver</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <select class="form-control">
                    <option>Elsayed Ahmed</option>
                    <option>Elsayed Ahmed</option>
                    <option>Elsayed Ahmed</option>
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
              </div>

              <div class="form-group">
                <label>Destination</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-plane"></i>
                  </div>
                  <input type="text" id="destination" class="form-control geocomplete_destination" name="pickup">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
            <input type="hidden" name="pickup_lat" id="pickup_lat">
            <input type="hidden" name="pickup_long" id="pickup_long">

            <input type="hidden" name="destination_lat" id="destination_lat">
            <input type="hidden" name="destination_long" id="destination_long">

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

        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var locations = [];
        var pickup = document.getElementById('pickup');
        var autocomplete_pickup = new google.maps.places.Autocomplete(pickup);
        google.maps.event.addListener(autocomplete_pickup, 'place_changed', function () {
            var place = autocomplete_pickup.getPlace();
            var pickup_lat = place.geometry.location.lat();
            var pickup_long = place.geometry.location.lng();
            $('#pickup_lat').value = pickup_lat;
            $('#pickup_long').value = pickup_long;
            var marker = new google.maps.Marker({
              position: uluru,
              setMap: map
            });
        });

        var destination = document.getElementById('destination');
        var autocomplete_destination = new google.maps.places.Autocomplete(destination);
        google.maps.event.addListener(autocomplete_destination, 'place_changed', function () {
            var place = autocomplete_destination.getPlace();
            var destination_lat = place.geometry.location.lat();
            var destination_long = place.geometry.location.lng();
            $('#destination_lat').value = destination_lat;
            $('#destination_long').value = destination_long;

            var marker = new google.maps.Marker({
              position: {lat: destination_lat, lng: destination_long},
              setMap: map
            });
        });
        // var uluru = {lat: -25.363, lng: 131.044};

        // locations.push([destination_lat, destination_long]);
        var map = $('.map');
        // var map = new google.maps.Map(map, {
        //   zoom: 4,
        //   center: uluru
        // });
        // console.log(locations)

        // var uluru = {lat: -25.363, lng: 131.044};
        // var map = new google.maps.Map(document.getElementById('map'), {
        //   zoom: 4,
        //   center: uluru
        // });
        // var marker = new google.maps.Marker({
        //   position: uluru,
        //   map: map
        // });


        // for (var i = 0; i < locations.length; i++) {
        //   marker = new google.maps.Marker({
        //     position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        //     map: map
        //   });
        // }

    }
    google.maps.event.addDomListener(window, 'load', initialize); 
    // $(".geocomplete_pickup").geocomplete({
    //     map: ".map_canvas_pickup",
    //     details: "#formy ul",
    //     detailsAttribute: "data-geo"
    // });

    // function load_map() {
    //     var latLng = $(".geocomplete_pickup").trigger("geocode");
    //     console.log(latLng);
    //     $(".geocomplete_pickup").geocomplete().bind("geocode:result", function (event, result) {
    //         $("#lat").val(result.geometry.location.lat());
    //         $("#long").val(result.geometry.location.lng());
    //     });
    // }

    // load_map();

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endsection
@endsection