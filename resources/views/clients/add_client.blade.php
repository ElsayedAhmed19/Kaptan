@extends("layouts.master")
@section('title', "Add Client")
@section("content")

@section('content_header')

<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('clients')}}">Clients</a></li>
    <li class="active">Add client</li>
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
	                <form action="{{url('clients/insert_client')}}" method="post" enctype="multipart/form-data">
	                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

		                <div class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                  <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Client Name" required="required" value="{{old('name')}}">
		                </div><br>
		                  @if ($errors->has('name'))
		                      <span class="help-block">
		                      <strong>{!! $errors->first('name') !!}</strong>
		                  </span>
		                  @endif

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
		                    <input id="email" type="email" class="form-control input-lg" name="email" placeholder="someone@example.com" required="required"  value="{{old('email')}}">
		                </div><br>

		                 @if ($errors->has('email'))
		                      <span class="help-block">
		                      <strong>{!! $errors->first('email') !!}</strong>
		                  </span>
		                  @endif

		                <div class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
		                    <input id="phone" type="phone" class="form-control input-lg" name="phone" placeholder="Phone Number" required="required" value="{{old('phone')}}">
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

		                <button type="submit" id="breg" name="blogin" class="btn btn-success btn-block">Register</button>

		                <br><br>
		            </form>
	            </div>
	        </div>
	    </div>
	</div>
</section>
@endsection
@section('scripts')

<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-functions.js"></script>
<script type="text/javascript">
$(document).ready(function () {

	var config = {
	    apiKey: "AIzaSyCIKlDQj51PyFIVhiVHGJJi2VshLaphiO8",
	    authDomain: "driveme-73fd6.firebaseapp.com",
	    databaseURL: "https://driveme-73fd6.firebaseio.com",
		projectId: "driveme-73fd6",
	    storageBucket: "driveme-73fd6.appspot.com/"
	  };
  		firebase.initializeApp(config);

	firebase.auth().createUserWithEmailAndPassword('egypt1@yahoo.com', 'password').catch(function(error) {
	  // Handle Errors here.
	  var errorCode = error.code;
	  var errorMessage = error.message;
	  // ...
	});

	$.ajax({
		url: "{{URL('sign-in')}}",
		data: {"_token": "{{ csrf_token() }}", email: 'egypt1234@yahoo.com'},
		method: 'POST',
		success: function(){
			alert('success');
		}
	});
});
</script>
	
@endsection