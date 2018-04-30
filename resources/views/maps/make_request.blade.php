@extends("layouts.master")
@section('title', "Add Client")


@section('content_header')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('clients')}}">Clients</a></li>
        <li class="active">Add client</li>
    </ol>
@endsection
@section("content")
    <div class="content">

        <select class="form-control" name="filter" id="filter">
            <option value="0" >Filter</option>
            <option value="1">Online</option>
            <option value="2" >Offline</option>
            <option value="3">OnTrip</option>
        </select>
        <div class="col-md-8" id="map">
            <div style="width: 1100px; height: 500px;">
                @php
                    if(!empty($online_drivers)){
                    Mapper::map($online_drivers[0]['latitude'],$online_drivers[0]['longitude'])->informationWindow($online_drivers[0]['latitude'],$online_drivers[0]['longitude'],"Driver Name:  {$online_drivers[0]['username']} - Mobile: {$online_drivers[0]['phone']}", [ 'title' => 'Online','icon' => [
                'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
                'fillColor' => '#62d233',
                'fillOpacity' => 0.8,
                'scale' => 0.08,
                'strokeColor' => '#62d23e',
                'strokeWeight' => 2
            ]])->rectangle([['latitude' => $online_drivers[0]['latitude'], 'longitude' => $online_drivers[0]['longitude']], ['latitude' => $online_drivers[0]['latitude'], 'longitude' => $online_drivers[0]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);
                    }elseif (!empty($busy_drivers)){
                            Mapper::map($busy_drivers[0]['latitude'],$busy_drivers[1]['longitude'])->informationWindow($busy_drivers[0]['latitude'],$busy_drivers[0]['longitude'],"Driver Name:  {$busy_drivers[0]['username']} - Mobile: {$busy_drivers[0]['phone']}", [ 'title' => 'Online','icon' => [
                    'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
                    'fillColor' => '#62d233',
                    'fillOpacity' => 0.8,
                    'scale' => 0.08,
                    'strokeColor' => '#62d23e',
                    'strokeWeight' => 2
                ]])->rectangle([['latitude' => $busy_drivers[0]['latitude'], 'longitude' => $busy_drivers[0]['longitude']], ['latitude' => $busy_drivers[0]['latitude'], 'longitude' => $busy_drivers[0]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);
                    }else{
                    Mapper::map($offline_drivers[0]['latitude'],$offline_drivers[0]['longitude'])->informationWindow($offline_drivers[0]['latitude'],$offline_drivers[0]['longitude'],"Driver Name:  {$offline_drivers[0]['username']} - Mobile: {$offline_drivers[0]['phone']}", [ 'title' => 'Online','icon' => [
            'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
            'fillColor' => '#62d233',
            'fillOpacity' => 0.8,
            'scale' => 0.08,
            'strokeColor' => '#62d23e',
            'strokeWeight' => 2
        ]])->rectangle([['latitude' => $offline_drivers[0]['latitude'], 'longitude' => $offline_drivers[0]['longitude']], ['latitude' => $offline_drivers[0]['latitude'], 'longitude' => $offline_drivers[0]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);
                    }
                        if (! empty($online_drivers) && count($online_drivers) >0) {

        for($i=0;$i<count($online_drivers);$i++){


          Mapper::informationWindow($online_drivers[$i]['latitude'],$online_drivers[$i]['longitude'],"Driver Name:  {$online_drivers[$i]['username']} - Mobile: {$online_drivers[$i]['phone']}", [ 'title' => 'Online','icon' => [
                'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
                'fillColor' => '#62d233',
                'fillOpacity' => 0.8,
                'scale' => 0.08,
                'strokeColor' => '#62d23e',
                'strokeWeight' => 2
            ]])->rectangle([['latitude' => $online_drivers[$i]['latitude'], 'longitude' => $online_drivers[$i]['longitude']], ['latitude' => $online_drivers[$i]['latitude'], 'longitude' => $online_drivers[$i]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);

        }


    }
    if (! empty($offline_drivers) && count($offline_drivers) >0) {


        for($i=0;$i<count($offline_drivers);$i++){


        Mapper::informationWindow($offline_drivers[$i]['latitude'],$offline_drivers[$i]['longitude'],"Driver Name:  {$offline_drivers[$i]['username']} - Mobile: {$offline_drivers[$i]['phone']}", [ 'title' => 'Offline','icon' => [
                'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
                'fillColor' => 'red',
                'fillOpacity' => 0.8,
                'scale' => 0.08,
                'strokeColor' => 'red',
                'strokeWeight' => 2
            ]])
            ->rectangle([['latitude' => $offline_drivers[$i]['latitude'], 'longitude' => $offline_drivers[$i]['longitude']], ['latitude' => $offline_drivers[$i]['latitude'], 'longitude' => $offline_drivers[$i]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);

        }

    }
    if (! empty($busy_drivers) && count($busy_drivers) >0) {

        for($i=0;$i<count($busy_drivers);$i++){


           Mapper::informationWindow($busy_drivers[$i]['latitude'],$busy_drivers[$i]['longitude'],"Driver Name:  {$busy_drivers[$i]['username']} - Mobile: {$busy_drivers[$i]['phone']}", [ 'title' => 'Busy','icon' => [
                'path' => 'M365.027,44.5c-30-29.667-66.333-44.5-109-44.5s-79,14.833-109,44.5s-45,65.5-45,107.5    c0,25.333,12.833,67.667,38.5,127c25.667,59.334,51.333,113.334,77,162s38.5,72.334,38.5,71c4-7.334,9.5-17.334,16.5-30    s19.333-36.5,37-71.5s33.167-67.166,46.5-96.5c13.334-29.332,25.667-59.667,37-91s17-55,17-71    C410.027,110,395.027,74.167,365.027,44.5z M289.027,184c-9.333,9.333-20.5,14-33.5,14c-13,0-24.167-4.667-33.5-14    s-14-20.5-14-33.5s4.667-24,14-33s20.5-13.5,33.5-13.5c13,0,24.167,4.5,33.5,13.5s14,20,14,33S298.36,174.667,289.027,184z',
                'fillColor' => 'orange',
                'fillOpacity' => 0.8,
                'scale' => 0.08,
                'strokeColor' => 'orange',
                'strokeWeight' => 2
            ]])->rectangle([['latitude' => $busy_drivers[$i]['latitude'], 'longitude' => $busy_drivers[$i]['longitude']], ['latitude' => $busy_drivers[$i]['latitude'], 'longitude' => $busy_drivers[$i]['longitude']]], ['strokeColor' => '#ea234a', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);

        }
    }


    $map= Mapper::render(0) ;
    echo $map;
                @endphp
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-functions.js"></script>
    <script>
        $( "#filter" ).change(function() {
            var filter=$('#filter').val();
            // console.log(filter);
            $.ajax({
                type:'get',
                url:'/filter/'+filter,
                success:function(data){
                    // console.log(data)
                   $('#map').innerHTML(data);
                }
            });

        });
    </script>

@endsection