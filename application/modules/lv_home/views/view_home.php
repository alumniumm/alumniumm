<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Alumni Teknik Informatika Universitas Muhammadiyah Malang</title>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta content="Skapp is a premium app landing page responsive html template built with bootstrap" name="description">
        <!-- favicon -->
        <link href="<?php echo base_url('assets/img/icon/favicon.ico')?>" rel="shortcut icon">
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/icon/favicon.ico')?>" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/icon/favicon.ico')?>" sizes="16x16">
        <!-- styles -->
        <link href="<?php echo base_url('resources/home/css/core/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/core/animate.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/core/font-awesome.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/plugins/owl.carousel.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/plugins/owl.theme.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/core/main.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/homepages/homepage-01.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('resources/home/css/pages/blog.css')?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/fonts/font-awesome/font-awesome.css" media="screen">
        <!-- google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7CPT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
        <style type="text/css">
        .img-responsive{
          display: block;
          max-width: 100%;
          height: auto;
        }
        </style>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body id="home">
        <!-- preloader -->
        <div id="preloader">
            <div id="status"></div>
        </div>
        <!--/.preloader-->
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-gradient navbar-fixed-top">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#home">
                        <img class="logo" src="<?php echo base_url('resources/img/aluminium-white.png')?>" alt="logo">
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="page-scroll" href="#home">Home</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#agenda">Agenda</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#kontak">Kontak</a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url('login')?>">Login</a>
                        </li> 
                    </ul>
                </div>
            </div>
            <!-- /.container -->
        </nav>
        <!-- /.navigation -->
        <!-- hero -->
        <section id="hero" class="hero-1">
            <div class="container">
                <div class="row">
                    <div class="wrap-hero-content">
                        <div class="hero-content">
                            <h1 class="os-animation" data-os-animation="fadeInUp">
                                Aluminium
                            </h1>
                            <p class="sub-title">
                                A stunning HTML template <span class="typed"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.hero -->
        <!-- agenda -->
        <section id="agenda" class="blog white-bg">
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <div class="subtitle">ALUMINIUM</div>
                        <h2><span class="gradient-text">Agenda Terbaru</span></h2>
                    </div>
                    <hr class="hr-title-01">
                    <div class="clearfix"></div>
                    <?php
                        foreach($agenda_terbaru->result() as $row):
                        $idAgenda = $row->id_agenda;
                        $isi_data = $row->isi;
                        $tanggal = $row->tanggalPost;
                        $isi_tampil = substr($isi_data, 0, 200);
                    ?>  
                    <div class="col-md-4 mb-30">
                        <article class="tiles">
                            <div class="pic">
                                <img style="width: auto; height: 250px; text-align: center;" alt="Responsive image" src="<?php echo base_url()?>resources/img/agenda/thumbs/<?php echo $row->gambar;?>" alt="blog">
                                <ul class="more">
                                    <li><a href="#" class="fa fa-send" style="color: white;"></a></li>
                                </ul>
                            </div>
                            <!-- /.pic -->
                            <div class="tiles-content">
                                <h3 class="blog-title" style="height: 100px;">
                                    <a href="#"><?php echo $row->judul; ?></a>
                                </h3>
                                <span class="author">
                                    Diposting oleh : <?php echo $row->penulis; ?><br><?php echo $tanggal; ?><br>
                                </span>
                                <!-- /.post-info -->
                            </div>
                            <!-- /.tiles-content -->
                        </article>
                        <!-- /.tiles -->
                    </div>
                    <?php endforeach; ?>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.agenda -->
        <!-- kontak -->
        <section id="kontak" class="white-bg">
            <div class="container">
                <div class="row">
                    <div class="contact">
                        <div class="section-title os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.2s">
                            <div class="subtitle">ALUMINIUM</div>
                            <h2> <span class="gradient-text">Teknik Informatika UMM</span></h2>
                        </div>
                        <hr class="hr-title-01">
                        <div class="col-md-4 os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.2s">
                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker gradient-text-01"></i>
                                </div>
                                <!-- /.contact-icon -->
                                <div class="contact-content">
                                    <h3 class="title">Alamat</h3>
                                    <p class="description">
                                        Kantor Prodi Teknik Informatika <br>Universitas Muhammadiyah Malang
                                    </p>
                                </div>
                                <!-- /.contact-content -->
                            </div>
                            <!-- /.contact-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.2s">
                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i class="fa fa-phone gradient-text-01"></i>
                                </div>
                                <!-- /.contact-icon -->
                                <div class="contact-content">
                                    <h3 class="title">Telepon</h3>
                                    <p class="description">
                                        <strong>+62</strong>
                                         341-477656
                                    </p>
                                </div>
                                <!-- /.contact-content -->
                            </div>
                            <!-- /.contact-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.2s">
                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope gradient-text-01"></i>
                                </div>
                                <!-- /.contact-icon -->
                                <div class="contact-content">
                                    <h3 class="title">Email</h3>
                                    <p class="description">
                                        mail@aluminium.org
                                    </p>
                                </div>
                                <!-- /.contact-content -->
                            </div>
                            <!-- /.contact-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.contact -->
                </div>
            </div>
        </section>
        <!-- /.contact -->
        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copyright">
                            © 2018 All Rigth Reserved. - Developed By Semicolon;
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <ul class="social-network">
                            <li><a href="https://www.facebook.com/groups/platinum.mail" class="ico-facebook" title="Facebook">
                                <i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="javascript(void)" class="ico-twitter" title="Twitter">
                                <i class="fa fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
            <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
        </footer>
        <!-- /.footer -->
        <!-- scripts -->
        <script src="<?php echo base_url('resources/home/js/core/jquery-3.1.1.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/jquery.easing.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/plugins/waypoints/jquery.waypoints.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/plugins/typed/typed.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/plugins/owl-carousel/owl.carousel.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/main.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/pages/homepage-01.js')?>"></script>
    </body>
</html>