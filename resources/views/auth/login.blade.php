<!DOCTYPE html>
<html>
<head>
<title>Login - Maraseel </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href={{ asset("css/bootstrap.min.css") }}>

  <link rel="stylesheet" href={!!asset("dist/css/admin.min.css")!!}>
  <!-- iCheck -->
  <link rel="stylesheet" href={!!asset("plugins/iCheck/square/blue.css")!!}>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="POST" action="{!! url('/login') !!}">
        {!! csrf_field() !!}
      <div class="form-group has-feedback" >
        <input type="email" class="form-control" placeholder="Email" value="{!! old('email') !!}" name="email" />
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{!! $errors->first('email') !!}</strong>
                </span>
            @endif
            @if (isset($isbanned))
                <span class="help-block">
                    <strong>{!!$isbanned!!}</strong>
                </span>
            @endif
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{!! $errors->first('password') !!}</strong>
                </span>
            @endif
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12" >
          <div class="checkbox icheck" >
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src={!!asset("plugins/jQuery/jquery-2.2.3.min.js")!!}></script>
<script src={!!asset("plugins/iCheck/icheck.min.js")!!}></script>
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
