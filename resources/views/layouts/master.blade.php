<!DOCTYPE html>
<html style="height: auto;">

<head>
     <title>@yield('title') - Kaptan</title> 
    <link rel="icon" href=""/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
    <!-- Adr instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/datatables/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{!!url('/dist/css/custom.css')!!}">

    @yield("styles")
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper" style="height: auto;">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{url('/')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">Ka</span>
                <!-- logo for regular state and mobile devices -->
                
                <span class="logo-lg">
                     <img style="height:30px; width:30px" src=""/>

                <b>Kaptan</b></span>
            </a>

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{'Kaptan'}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                    <p>{{'Kaptan'}}</p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                       
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>                    
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="sidebar-menu" id="sidebar-menu">
                    <li class="header">Main Menu</li>

                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-home"></i>
                            <span>{{'Drivers'}}</span> 
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('drivers')}}"><i class="fa fa-circle-o"></i>
                                {{'List All Drivers'}}</a></li>
                            <li><a href="{{url('drivers/add_driver')}}"><i class="fa fa-circle-o"></i> 
                                {{'Add New Driver'}}</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-home"></i>
                            <span>{{'Clients'}}</span> 
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('clients')}}"><i class="fa fa-circle-o"></i>
                                {{'List All Clients'}}</a></li>
                            <li><a href="{{url('clients/add_client')}}"><i class="fa fa-circle-o"></i> 
                                {{'Add New Client'}}</a></li>
                            <li><a href="{{url('clients/create_request')}}"><i class="fa fa-circle-o"></i> 
                                {{'Make Request'}}</a></li>
                        </ul>
                    </li>
                   <!--  <li class="treeview">
                        <a href="#">
                        <i class="fa fa-home"></i>
                            <span>{{'Admins'}}</span> 
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('admins')}}"><i class="fa fa-circle-o"></i>
                                {{'List All Admins'}}</a></li>
                            <li><a href="{{url('admins/add_admin')}}"><i class="fa fa-circle-o"></i> 
                                {{'Add New Admin'}}</a></li>
                        </ul>
                    </li> -->

                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-home"></i>
                            <span>{{'Requests'}}</span> 
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('requests/active/customers')}}"><i class="fa fa-circle-o"></i>
                                {{'Active'}}</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> 
                                {{'History'}}</a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('requests/history/customers')}}"><i class="fa fa-circle-o"></i>
                                        {{'Clients History'}}</a></li>
                                    <li><a href="{{url('requests/history/drivers')}}"><i class="fa fa-circle-o"></i> 
                                        {{'Drivers History'}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('requests/get_map')}}"><i class="fa fa-circle-o"></i>
                            {{'Map'}}
                        </a>
                    </li>
               </ul>
            </section>
        </aside>

        <div class="content-wrapper">
             <div class="navigation">
                 <div class="col-md-12">
                    <div class="pull-right" id="date_time" style="line-height:250%"></div>
                    @yield('content_header') 
                 </div>
            </div>

            @yield("content")
            
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Provision</a>.</strong> All rights reserved.
        </footer>

        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->
    <script src="{{url::asset('dist/js/jquery-1.12.4.js')}}"></script>
    <script src="{{url::asset('dist/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url::asset('dist/js/dataTables.buttons.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{url::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{url::asset('plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url::asset('dist/js/app.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{url::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{url::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{url::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{url::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{url::asset('plugins/chartjs/Chart.min.js')}}"></script>
    <script src="{{url::asset('dist/js/bootbox.js')}}"></script>
    @yield("scripts")

</body>

</html>