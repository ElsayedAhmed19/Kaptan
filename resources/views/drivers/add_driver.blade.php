@extends("layouts.master")
@section('title', "Add driver")
@section("content")

@section('content_header')

<ol class="breadcrumb">
	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('driver')}}">Drivers</a></li>
    <li class="active">Add driver</li>
</ol>
@endsection
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Driver Regsteration</h3>
            </div>
            <div class="box-body">
              <form action="{{url('drivers/insert_driver')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Driver Name" required="required" value="{{old('name')}}">
                </div><br>
                  @if ($errors->has('name'))
                      <span class="help-block">
                      <strong>{!! $errors->first('name') !!}</strong>
                  </span>
                  @endif

                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input id="email" type="email" class="form-control input-lg" name="email" placeholder="someone@example.com" required="required" value="{{old('email')}}">
                </div><br>

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-car"></i></span>
                  <select class="form-control" id="sel1" name="carModel">
                    <option value="" required selected disabled hidden>Car Model</option>
                    <option value="Mercedes">Mercedes</option>
                    <option value="Volvo">Volvo</option>
                    <option value="BMW">BMW</option>
                    <option value="Audi">Audi</option>
                  </select>
                </div><br>

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-car"></i></span>
                  <input id="carNumber" type="Number" class="form-control input-lg" name="carNumber" placeholder="Car Number" required="required" value="{{old('carNumber')}}">

                </div><br>

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
                  <input id="password_confirmation" type="password" class="form-control input-lg" name="password_confirmation" placeholder="Password Confirmation" required="required">
                </div><br>

                <button type="submit" id="breg" name="blogin" class="btn btn-success btn-block">Register</button>

                <br><br>
              </form>
            </div>
          </div>
        </div>
    </div>
@endsection