<?php $data = $this->mdl_auth->getAuthSession(); ?>
<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>simutuv2 | Badan Kendali Mutu Akademik</title>

  <link rel="apple-touch-icon" href="<?php echo base_url() ?>resources/themes/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?php echo base_url() ?>resources/themes/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/site.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugin -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/chartist-js/chartist.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/jvectormap/jquery-jvectormap.css">

  <!-- Page -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/weather-icons/weather-icons.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/css/dashboard/v2.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
   <!-- Skin tools (demo site only) -->
  <link rel="stylesheet" href="http://getbootstrapadmin.com/remark/global/css/skintools.min.css?v2.0.0">
  <script src="http://getbootstrapadmin.com/remark/base/assets/js/sections/skintools.min.js"></script>
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/font-awesome/font-awesome.css">

    <!-- Plugin -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-bootstrap/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-fixedheader/dataTables.fixedHeader.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/vendor/datatables-responsive/dataTables.responsive.css">

  <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>resources/themes/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="<?php echo base_url() ?>resources/themes/vendor/media-match/media.match.min.js"></script>
    <script src="<?php echo base_url() ?>resources/themes/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="<?php echo base_url() ?>resources/themes/vendor/modernizr/modernizr.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/vendor/breakpoints/breakpoints.js"></script>
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
    
    #exampleTableAddToolbar {
      padding-left: 30px;
    }
    a.txt-dc-none, .txt-dc-none a {
      text-decoration: none!important;

    }
  </style>
</head>
<body class="dashboard">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>

      <a href="<?php echo site_url('dashboard') ?>">
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle">
        <img class="navbar-brand-logo" src="<?php echo base_url() ?>resources/themes/images/logo.png" title="Remark">
        <span class="navbar-brand-text"> simutu <sup>v2</sup></span>
      </div>
      </a>
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
          <li class="hidden-float">
            <a class="icon wb-search" data-toggle="collapse" href="#site-navbar-search" role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="<?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>"><a href="<?php echo site_url('dashboard') ?>">Dashboard <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="slide-bottom" role="button">
              <span>
                <?php echo $data['ss_nama'] ?> <span class="caret"></span>
              </span>
            </a>
            
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="javascript:void(0)" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> <?php echo $data['ss_nama'] ?></a>
              </li>
              <li role="presentation">
                <a href="http://infokhs.umm.ac.id" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Info-KHS</a>
              </li>
              <li role="presentation">
                <a href="http://krs.umm.ac.id" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Krs-Online</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation">
                <a href="<?php echo site_url('auth/logout') ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
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