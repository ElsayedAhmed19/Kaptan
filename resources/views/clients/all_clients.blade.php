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
        var url = "{{ URL('clients/datatable') }}";
        var columns =  [
            {data: 'fullname', name: 'fullname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'onTrip', name: 'onTrip'},
            {data: 'online', name: 'online'},
            {data: 'blocked', name: 'blocked'},
            {
              searchable:false,
              orderable:false,
              data: 'operations',
              name: 'operations',
              "render": function (data, type, full, meta) {
                  var menu = '<div class="actions-t" id='+full.userID+'>'+
                    '<a class="dropdown-toggle" data-toggle="dropdown">'+
                    '<span class="glyphicon glyphicon-menu-hamburger"></span></a>'+
                    '<ul class="dropdown-menu" id="'+full.userID+'" id="cust_menu">'+
                    '<li>'+
                    '<a href="/clients/'+full.userID+'/edit">Edit</a>'+
                    '</li>'+
                    '<li>'+
                    '<a href="#" class="delete">Delete</a>'+
                    '</li>';

                    if (full.blocked == 'Yes') {
                        menu+= '<li>'+
                          '<a href="/clients/'+full.userID+'/change_block_status">Approve</a>'+
                         '</li>';
                    } else {
                         menu+= '<li>'+
                          '<a href="/clients/'+full.userID+'/change_block_status">Block</a>'+
                         '</li>';
                    }

                    menu +=     
                      '</ul>'+
                      '</div>';
                    return menu;
                  }
              }
        ];
        $('#list').dataTable().fnDestroy();
	      $('#list').DataTable({
	        "paging": true,
          "info": true,
          "autoWidth": true, 
          "responsive": true,
	        processing: false,
	        serverSide: false,
	        ajax: url,
	        columns: columns
	    });

      $("body").on("click", ".delete", function(){
        var ul =  $(this).closest("ul");
        var id = ul.attr("id");
        bootbox.confirm("Are you sure you want to delete this client?", function (result) {
          if (result == true) {
            $.ajax({
              url: "{{URL('clients/delete')}}",
              method: "DELETE",
              data: {id: id, _token: "{{csrf_token()}}"},
              success: function(){
                ul.closest("tr").remove();
              },
              error: function(){

              }
            });
          }
        });
      });
	});
</script>
@endsection