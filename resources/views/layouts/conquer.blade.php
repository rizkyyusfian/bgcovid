<!DOCTYPE html>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/tasks.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- BEGIN LEAFLET STYLE AND SCRIPT -->
<link rel="stylesheet" href="{{ asset('assets_leaflet/leaflet.css') }}" type="text/css">                <!-- Leaflet -->
<script src="{{ asset('assets_leaflet/leaflet.js') }}" type="text/javascript"></script>                 <!-- Leaflet -->
<script src="{{ asset('plugins_leaflet/leaflet.ajax.js') }}" type="text/javascript"></script>           <!-- Ajax -->
<script src="{{ asset('plugins_leaflet/wicket/wicket.js') }}" type="text/javascript"></script>          <!-- Wicket Digitasi Online -->
<script src="{{ asset('plugins_leaflet/wicket/wicket-leaflet.js') }}" type="text/javascript"></script>  <!-- Wicket Digitasi Online -->

<!-- bootstrap dan jquery  -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<!-- Draw Control -->
<link rel="stylesheet" href="{{ asset('plugins_leaflet/markercluster/MarkerCluster.css') }}"/>
<link rel="stylesheet" href="{{ asset('plugins_leaflet/markercluster/MarkerCluster.Default.css') }}"/>
<script src="{{ asset('plugins_leaflet/markercluster/leaflet.markercluster-src.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>

<!-- POINT IN POLYGON -->
<link rel="stylesheet" href="{{ asset('plugins_leaflet/pointinpolygon/wise-leaflet-pip.js') }}"/>
<script src="https://cdn.rawgit.com/hayeswise/Leaflet.PointInPolygon/v1.0.0/wise-leaflet-pip.js"></script>
<script src="https://rawgit.com/hayeswise/Leaflet.PointInPolygon/master/wise-leaflet-pip.js"></script>

<!-- TURF ANALISA SPASIAL -->
<script src="{{ asset('plugins_leaflet/turf/turf.min.js') }}" type="text/javascript"></script>

<!-- GEOCODER -->
<link rel="stylesheet" href="{{ asset('plugins_leaflet/geocoder/Control.Geocoder.css') }}"/>
<script src="{{ asset('plugins_leaflet/geocoder/Control.Geocoder.js') }}" type="text/javascript"></script>

<!-- MINICHART -->

<!-- END LEAFLET STYLE AND SCRIPT -->
<script src="{{ asset('plugins_leaflet/minichart/leaflet.minichart.min.js') }}" type="text/javascript"></script>


@yield('javascript')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="header-inner">
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <img src="assets/img/menu-toggler.png" alt=""/>
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
      <li class="devider">
         &nbsp;
      </li>
      <!-- BEGIN USER LOGIN DROPDOWN -->
      <li class="dropdown user">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <img alt="" src=""/>
        <span class="username username-hide-on-mobile">
          @if(Auth::user())
            {{ Auth::user()->name }}
          @else
            [Anda belum login]
          @endif
        </span>
        <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
          <li>
            @if(Auth::user())
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <input type="submit" class="btn btn-danger btn-xs btn-block" value="Logout">
              </form>
            @else
              <a href="/home" class="btn btn-info btn-xs btn-block">Login</a>
            @endif
          </li>
        </ul>
      </li>
      <!-- END USER LOGIN DROPDOWN -->
    </ul>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
      <ul class="page-sidebar-menu">
        <li class="sidebar-toggler-wrapper">
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
          <div class="sidebar-toggler">
          </div>
          <div class="clearfix">
          </div>
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li class="sidebar-search-wrapper">
          <form class="search-form" role="form" action="index.html" method="get">
            <div class="input-icon right">
              <i class="icon-magnifier"></i>
              <input type="text" class="form-control" name="query" placeholder="Search...">
            </div>
          </form>
        </li>
        <li class="start active ">
          <a href="{{ url('/') }}">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
          <span class="selected"></span>
          </a>
        </li>
        <li >
          <a href="javascript:;">
          <i class="fa fa-folder"></i>
          <span class="title">Master</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="/datacovid19">
                <i class="fa fa-bar-chart-o"></i>
                DataCovid19
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content">
      @yield('content')
    </div>
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
  <div class="footer-inner">
     2013 &copy; Conquer by keenthemes.
  </div>
  <div class="footer-tools">
    <span class="go-top">
    <i class="fa fa-angle-up"></i>
    </span>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.editable.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.peity.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-knob/js/jquery.knob.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/scripts/app.js')   }}" type="text/javascript"></script>
<script src="{{ asset('assets/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/scripts/tasks.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
   $('#myTable').DataTable();
});
</script>

@yield('initialscript')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>