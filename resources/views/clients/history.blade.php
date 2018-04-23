@extends("layouts.master")
@section('title', "History")
@section("content")
@section('content_header')
<ol class="breadcrumb">
  <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">History</a></li>
    <li class="active">History</li>
</ol>
@endsection
<div class="content">
    @if(Session::has('message'))
       <div class="alert alert-success alert-dismissable">
             <button type="button" class="close" id="close_flash" data-dismiss="alert" aria-hidden="true">×</button>  
             <i class="icon-check-sign"></i>  {!!Session::get('message')!!}
        </div>
    @endif
    <div id="flash_message"></div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="list" class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Driver Name</th>
                       <th>Car Model</th>
                       <th>Pickup Location</th>
                       <th>Destination</th>
                       <th>Request Time</th>
                       <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section("scripts")
<script src="{!!asset('plugins/datatables/jquery.dataTables.min.js')!!}"></script>
<script src="{!!asset('plugins/datatables/dataTables.bootstrap.min.js')!!}"></script>
<script>
    $(document).ready(function () {
        var url = "{{ route('client_requests_datatable') }}";
        var columns =  [
            {data: 'driverName', name: 'driverName'},
            {data: 'carModel', name: 'carModel'},
            {data: 'pickup', name: 'pickup'},
            {data: 'Destination', name: 'destination'},
            {data: 'Request Time', name: 'requestTime'},
            {data: 'onTrip', name: 'onTrip'},
        ];
      $('#list').dataTable().fnDestroy();
      $('#list').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false, 
          "bfilter": false,
          "dom":"l t p r",
          "responsive": true,
          processing: false,
          serverSide: false,
          ajax: url,
          columns: columns
      });
  });
</script>
@endsection