<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap Alumni template">
  <meta name="author" content="">

  <title>Alumni | Aluminium</title>

  <link rel="apple-touch-icon" href="<?php echo base_url() ?>resources/themes/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?php echo base_url() ?>resources/themes/images/favicon.ico">
  <script src="<?php echo base_url() ?>resources/themes/vendor/jquery/jquery.js"></script>
  <script type="text/javascript">
    $(window).load(function() {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");;
    });

    </script>
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/css/bootstrap-extend.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/topbar/assets/css/site.min.css" media="screen">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/animsition/animsition.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/asscrollable/asScrollable.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/switchery/switchery.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/intro-js/introjs.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/slidepanel/slidePanel.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/flag-icon-css/flag-icon.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/chartist-js/chartist.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/jvectormap/jquery-jvectormap.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/topbar/assets/examples/css/dashboard/v1.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/topbar/assets/examples/css/structure/testimonials.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/topbar/assets/examples/css/pages/profile.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/jquery-wizard/jquery-wizard.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/vendor/formvalidation/formValidation.css" media="screen">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/fonts/material-design/material-design.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/material/global/fonts/brand-icons/brand-icons.min.css" media="screen">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic' media="screen">
  <!--[if lt IE 9]>
    <script src="../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?php echo base_url() ?>resources/material/global/vendor/modernizr/modernizr.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/breakpoints/breakpoints.js"></script>
   <!-- Plugin -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-bootstrap/dataTables.bootstrap.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-fixedheader/dataTables.fixedHeader.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-responsive/dataTables.responsive.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/web-icons/web-icons.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/brand-icons/brand-icons.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/font-awesome/font-awesome.css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/print.css" media="print">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/animate.css" media="screen">

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <script>
  Breakpoints();
  </script>
    <!-- Inline -->
  <style>
    @media (max-width: 480px) {
      .panel-actions .dataTables_length {
        display: none;
      }
    }
    
    @media (max-width: 320px) {
      .panel-actions .dataTables_filter {
        display: none;
      }
    }
    
    @media (max-width: 767px) {
      .dataTables_length {
        float: left;
      }
    }
    .marquee {
        top: 6em;
        position: relative;
        box-sizing: border-box;
        animation: marquee 15s linear infinite;
    }
    .marquee:hover {
    animation-play-state: paused;
}

    /* Make it move! */
    @keyframes marquee {
        0%   { top:   8em }
        100% { top: -11em }
    }
    hr.single{
      background:#000000;
      border:1px solid #000000;
    }

    hr.double{
      background:#000000;
      border:2px solid #000000;
      margin:-5px 0 5px 0;
    }
    table.pad5 td{
      padding:0 0 5px 0;
    }
    .uppercase {
      text-transform: uppercase;
    }
    #exampleTableAddToolbar {
      padding-left: 30px;
    }
    a.txt-dc-none, .txt-dc-none a {
      text-decoration: none!important;

    }
    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript, 
    if it's not present, don't show loader */
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('<?php echo base_url() ?>resources/loader/loader.gif') center no-repeat #fff;
    }
    .box-ask {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }
  </style>
  <?php
    echo $map['js'];
  ?>
</head>
<body class="site-navbar-small dashboard page-profile">
<div class="se-pre-con"></div>

  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
  role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
      <a class="navbar-brand navbar-brand-center" href="<?php echo base_url()?>">
        <img class="navbar-brand-logo navbar-brand-logo-normal" src="<?php echo base_url('resources/img/aluminium-white.png')?>"
        title="Remark">
        <span class="navbar-brand-text hidden-xs-down"> Alumni</span>
      </a>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
          <li class="hidden-xs" id="toggleFullscreen">
            <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>
          <!-- <li class="hidden-float">
            <a class="icon wb-search" data-toggle="collapse" href="#site-navbar-search" role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li> -->
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right"">
          <li class="dropdown">
            <a class="navbar-avatar dropdown-toggle padding-top-20" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
              <span>
                <i class="fa fa-user"></i> &nbsp; <?php echo $nama;?><span class="caret"></span>
              </span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="<?php echo base_url('alumni/profil') ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profil</a>
              </li>
              <li class="divider" role="presentation"></li> 
              <li role="presentation">
                <a href="<?php echo base_url('logout') ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </li>
            </ul>
          </li>
          
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>

  <!-- Modal Aluminium -->
  <div class="modal fade modal-newspaper modal-primary col-md-12" id="modalAluminium" aria-hidden="false" aria-labelledby="modalAluminium" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title text-center"><i class="fa fa-graduation-cap"></i> Selamat Datang di Aluminium</h4>
        </div>
        <div class="modal-body">
          <div class="widget widget-shadow text-center">
            <div class="widget-header">
              <div class="widget-header-content">
                <a class="avatar avatar-lg" href="javascript:void(0)">
                  <img src="<?php echo base_url('resources/img/aluminium.png')?>" alt="...">
                </a><br><br>
                <h4 class="profile-user"></h4>
                <p class="container" align="justify">Situs yang dapat membantu Prodi untuk mengetahui bagaimana kondisi/perkembangan dari para Alumni. Dengan adanya informasi kondisi Alumni, Prodi dapat terus meningkatkan kualitas pendidikan. Memperbaiki apa yang dirasa perlu, untuk kebutuhan di dunia profesional. Melalui Form Tracer Study yang ada di dalam situs ini, Anda telah sangat membantu, dan memberi kontribusi positif yang besar, untuk kemajuan serta membuat Prodi menjadi lebih baik.</p>
                <div class="profile-social">
                  <a class="icon bd-twitter" href="javascript:void(0)"></a>
                  <a class="icon bd-facebook" href="javascript:void(0)"></a>
                  <a class="icon bd-dribbble" href="javascript:void(0)"></a>
                  <a class="icon bd-github" href="javascript:void(0)"></a>
                </div>
                <a href="http://informatika.umm.ac.id/"><button type="button" class="btn btn-warning waves-effect waves-light"><i class="fa fa-computer"></i> Teknik Informatika Universitas Muhammadiyah Malang</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Aluminium -->

