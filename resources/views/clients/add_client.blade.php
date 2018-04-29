@extends("layouts.master")
@section('title', "Add Client")
@section("content")

@section('content_header')

<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Clients</a></li>
    <li class="active">{{isset($client)? "Edit ": "Add"}} client</li>
</ol>
@endsection
    <section class="content">
      	<div class="row">
	        <div class="col-md-6">
	            <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Client Regsteration</h3>
	            </div>
	            <div class="box-body">
	            	@if(isset($driver)) 
		                <form action="{{url('clients/update_client')}}" method="post" enctype="multipart/form-data">
		                  <input type="hidden" name="id" value="{{$client['userID']}}">
		            @else
		                <form action="{{url('clients/insert_client')}}" method="post" enctype="multipart/form-data">
		            @endif
	                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

		                <div class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                  <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Client Name" required="required" value="{{isset($client)? $client['fullname']: old('name')}}">
		                </div><br>
		                @if ($errors->has('name'))
		                    <span class="help-block">
		                    <strong>{!! $errors->first('name') !!}</strong>
		                </span>
		                @endif

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
		                    <input id="email" type="email" class="form-control input-lg" name="email" placeholder="someone@example.com" required="required"  value="{{isset($client)? $client['email']: old('email')}}">
		                </div><br>
		                @if ($errors->has('email'))
		                    <span class="help-block">
		                        <strong>{!! $errors->first('email') !!}</strong>
		                    </span>
		                @endif

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
		                    <input id="phone" type="phone" class="form-control input-lg" name="phone" placeholder="Phone Number" required="required" value="{{isset($client)? $client['phone']: old('phone')}}">
		                </div><br>

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                    <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Password" required="required">
		                </div><br>
		                @if ($errors->has('password'))
		                      <span class="help-block">
		                      <strong>{!! $errors->first('password') !!}</strong>
		                  </span>
	                    @endif

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                    <input id="password_confirmation" type="password" class="form-control input-lg" name="password_confirmation" placeholder="Password confirmation" required="required">
		                </div><br>

		                <button type="submit" id="breg" name="blogin" class="btn btn-success btn-block">{{isset($client)? 'Update': 'Save'}}</button>

		                <br><br>
		            </form>
	            </div>
	        </div>
	    </div>
	</div>
</section>
@endsection