@extends("layouts.master")
@section('title', "Drivers - feedbacks")
@section("content")

@section('content_header')

<ol class="breadcrumb">
  <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Drivers</a></li>
    <li class="active">Feedbacks</li>
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
                       <th>Subject</th>
                       <th>Body</th>
                       <th>Username</th>
                       <th>Email</th>
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
        var urlPath = window.location.pathname;
        if (urlPath.endsWith('customers')) {
            var url = "{{ URL('feedbacks/datatable/customers') }}";
        } else {
          var url = "{{ URL('feedbacks/datatable/drivers') }}";
        }
        
        var columns =  [
            {data: 'subject', name: 'subject'},
            {data: 'body', name: 'body'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
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
    });
</script>
@endsection
