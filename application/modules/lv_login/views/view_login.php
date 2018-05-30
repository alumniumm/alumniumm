
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Masuk ke Aluminium</title>
  <link rel="apple-touch-icon" href="<?php echo base_url('resources/material/topbar/assets/images/apple-touch-icon.png')?>">
  <link rel="shortcut icon" href="<?php echo base_url('resources/material/topbar/assets/images/favicon.ico')?>"">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/css/bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/css/bootstrap-extend.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/topbar/assets/css/site.min.css')?>">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/animsition/animsition.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/asscrollable/asScrollable.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/switchery/switchery.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/intro-js/introjs.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/slidepanel/slidePanel.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/vendor/flag-icon-css/flag-icon.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/topbar/assets/examples/css/pages/login-v3.css')?>">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/fonts/material-design/material-design.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/fonts/brand-icons/brand-icons.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/material/global/fonts/font-awesome/font-awesome.css')?>">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <style type="text/css">
    .shadow{
          box-shadow: 0 8px 15px 0 rgba(0, 0, 0, 0.1), 
                      0 10px 25px 0 rgba(0, 0, 0, 0.1);
    }
  </style>
  <!--[if lt IE 9]>
    <script src="<?php echo base_url('resources/material/global/vendor/html5shiv/html5shiv.min.js')?>""></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?php echo base_url('resources/material/global/vendor/media-match/media.match.min.js')?>""></script>
    <script src="<?php echo base_url('resources/material/global/vendor/respond/respond.min.js')?>""></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?php echo base_url('resources/material/global/vendor/modernizr/modernizr.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/breakpoints/breakpoints.js')?>""></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition page-login-v3 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
      <div class="panel">
        <div class="panel-body shadow">
          <div class="brand">
            <img class="brand-img" width="100" height="70" src="<?php echo base_url('resources/img/aluminiumm.png')?>" alt="...">
          </div>
          <form method="post" action="<?php echo base_url('login/auth')?>" autocomplete="off" >
            <?php echo $this->session->flashdata('msg');?>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control" name="txt_username">
              <label class="floating-label">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="Password" class="form-control" name="txt_password">
              <label class="floating-label">Password</label>
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
                <input type="checkbox" id="inputCheckbox" name="remember">
                <label for="inputCheckbox">Ingat Saya</label>
              </div>
              <a class="pull-right" href="#">Lupa password?</a>
            </div>
            <a href="<?php echo base_url();?>">
              <button type="button" class="btn btn-danger pull-left btn-animate btn-animate-side">
                <span>
                  <i class="icon fa fa-arrow-left" aria-hidden="true"></i>
                  &nbsp;Kembali
                </span>
              </button>
            </a>
            <button type="submit" class="btn btn-primary pull-right btn-animate btn-animate-side">
              <span>
                <i class="icon fa fa-sign-in" aria-hidden="true"></i>
                &nbsp;Masuk
              </span>
            </button>
          </form>
          <br>
          <p><br>WEBSITE BY Semicolon</p>
          <p>© <?php echo date('Y') ?>. All RIGHT RESERVED. </p>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
  <script src="<?php echo base_url('resources/material/global/vendor/jquery/jquery.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/bootstrap/bootstrap.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/animsition/animsition.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/asscroll/jquery-asScroll.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/mousewheel/jquery.mousewheel.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/asscrollable/jquery.asScrollable.all.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/ashoverscroll/jquery-asHoverScroll.js')?>""></script>
  <!-- Plugins -->
  <script src="<?php echo base_url('resources/material/global/vendor/switchery/switchery.min.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/intro-js/intro.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/screenfull/screenfull.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/slidepanel/jquery-slidePanel.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/vendor/jquery-placeholder/jquery.placeholder.js')?>""></script>
  <!-- Scripts -->
  <script src="<?php echo base_url('resources/material/global/js/core.js')?>""></script>
  <script src="<?php echo base_url('resources/material/topbar/assets/js/site.js')?>""></script>
  <script src="<?php echo base_url('resources/material/topbar/assets/js/sections/menu.js')?>""></script>
  <script src="<?php echo base_url('resources/material/topbar/assets/js/sections/menubar.js')?>""></script>
  <script src="<?php echo base_url('resources/material/topbar/assets/js/sections/sidebar.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/configs/config-colors.js')?>""></script>
  <script src="<?php echo base_url('resources/material/topbar/assets/js/configs/config-tour.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/asscrollable.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/animsition.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/slidepanel.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/switchery.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/tabs.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/jquery-placeholder.js')?>""></script>
  <script src="<?php echo base_url('resources/material/global/js/components/material.js')?>""></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>