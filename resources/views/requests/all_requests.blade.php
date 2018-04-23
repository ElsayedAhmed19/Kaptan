@extends("layouts.master")
@section('title', "All Requests")
@section("content")

@section("content")

@section('content_header')

<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Requests</a></li>
    <li class="active">All Requests</li>
</ol>
@endsection

<div class="contnet">
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
                       <th>Customer Name</th>
                       <th>Customer Phone</th>
                       <th>Driver Name</th>
                       <th>Driver Phone</th>
                       <th>On Trip</th>
                       <th>Driver Order</th>
                       <th>Request Time</th>
                       <th>Operations</th>
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
      var currentPath = window.location.pathname;
      var url = "{{ URL('requests/datatable/') }}";
      var columns =  [
          {data: 'customerName', name: 'customerName'},
          {data: 'customerPhone', name: 'customerPhone'},
          {data: 'driverName', name: 'driverName'},
          {data: 'driverPhone', name: 'driverPhone'},
          {data: 'onTrip', name: 'onTrip'},
          {data: 'driverOrder', name: 'driverOrder'},
          {data: 'requestTime', name: 'requestTime'},
          {data: 'operations', name: 'operations'}
      ];
      $('#list').dataTable().fnDestroy();
	    $('#list').DataTable({
	        "paging": true,
	        "lengthChange": false,
	        "searching": true,
	        "ordering": true,
	        "info": true,
	        "autoWidth": true, 
	        "filter": true,
	        "dom":"l t p r",
	        "responsive": true,
	        processing: false,
	        serverSide: false,
          ajax: {
            url: url,
            data: {currentPath: String(currentPath)}
          },
	        columns: columns
	    });
	});
</script>
@endsection