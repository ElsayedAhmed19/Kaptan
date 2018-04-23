@extends("layouts.master")
@section('title', "All Clients")
@section("content")

@section("content")

@section('content_header')

<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Clients</a></li>
    <li class="active">All client</li>
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
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Nationality</th>
                       <th>On Trip</th>
                       <th>Online</th>
                       <th>Blocked</th>
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
        var url = "{{ route('clients_datatable') }}";
        var columns =  [
            {data: 'fullname', name: 'fullname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'nationality', name: 'nationality'},
            {data: 'onTrip', name: 'onTrip'},
            {data: 'onTrip', name: 'onTrip'},
            {data: 'online', name: 'online'},
            {data: 'operations', name: 'operations'}
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