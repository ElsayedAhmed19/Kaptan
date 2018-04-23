<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dist/css/admin.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/plugins/iCheck/square/blue.css')}}">
</head>
<body class="hold-transition register-page">
    <div class="register-box" style="margin-top: 80px">
    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="{!!url('/register')!!}" method="post">
        {!! csrf_field() !!}
        <div class="form-group{!! $errors->has('name') ? ' has-error' : '' !!} has-feedback">
            <input type="text" class="form-control" placeholder="First name" name="name"  value="{!! old('name') !!}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{!! $errors->first('name') !!}</strong>
                    </span>
                @endif
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group{!! $errors->has('email') ? ' has-error' : '' !!} has-feedback">
            <input type="email" class="form-control" placeholder="Email"  value="{!! old('email') !!}" name="email">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{!! $errors->first('email') !!}</strong>
                    </span>
                @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         </div>

         <div class="form-group{!! $errors->has('phone') ? ' has-error' : '' !!} has-feedback">
            <input type="phone" class="form-control" placeholder="Phone"  value="{!! old('phone') !!}" name="phone">
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{!! $errors->first('phone') !!}</strong>
                    </span>
                @endif
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
         </div>

        <div class="form-group{!! $errors->has('password') ? ' has-error' : '' !!} has-feedback" name="password">
            <input type="password" class="form-control" placeholder="Password" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{!! $errors->first('password') !!}</strong>
                    </span>
                @endif
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group{!! $errors->has('password_confirmation') ? ' has-error' : '' !!} has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{!! $errors->first('password_confirmation') !!}</strong>
                    </span>
                @endif
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
        </form>
        <a href="/login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 2.2.3 -->
    <script src="{{asset('/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
        });
    });
    </script>
    </body>
</html>




