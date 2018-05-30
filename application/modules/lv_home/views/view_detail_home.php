<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta content="Skapp is a premium app landing page responsive html template built with bootstrap" name="description">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
            foreach($agenda_per_id->result() as $row):
        ?>
        <title><?php echo $row->judul;?></title>
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
        <link href="<?php echo base_url('resources/home/css/pages/blog.css')?>" rel="stylesheet">
        <!-- google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7CPT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top">
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
                            <a class="page-scroll" href="<?php echo base_url()?>">Home</a>
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
        <section id="page-title" class="page-title-bg">
            <div class="row">
                <div class="wrap-page-title-content">
                    <div class="container">
                        <div class="page-title-content text-center">
                            <h1 class="os-animation" data-os-animation="fadeInUp">
                                Single Post Image
                            </h1>
                            <hr class="hr-title">
                            <ul>
                                <li><a href="blog_full_width.html">Home</a></li>
                                <li>/</li>
                                <li><a href="#">Pages</a></li>
                                <li>/</li>
                                <li class="active">Single Post Image</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.hero -->
        <!-- content -->
        <div id="blog" class="blog white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 mb-50">
                        <div class="col-md-12 np">
                            <article class="single-post">
                                <div class="pic">
                                    <img src="assets/images/blog/blog.jpg" alt="blog">
                                    <div class="single-post-date">
                                        <span class="single-post-date-day">12</span>
                                        <span class="single-post-date-month">Apr</span>
                                    </div>
                                </div>
                                <!-- /.pic -->
                                <div class="single-post-content">
                                    <div class="tags">
                                        <ul>
                                            <li><i class="fa fa-tag"></i></li>
                                            <li><a href="#">Tags,</a></li>
                                            <li><a href="#">Webdesign,</a></li>
                                            <li><a href="#">Saerox,</a></li>
                                            <li><a href="#">Envato</a></li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="#"><?php echo $row->judul;?></a>
                                    </h3>
                                    <div class="blog-meta">
                                        <ul class="post-content-bottom">
                                            <li><img src="assets/images/avatar/avatar.jpg" class="img-circle avatar" width="50" height="50" alt="avatar"></li>
                                            <li><span><i class="fa fa-eye"></i><?php echo $row->tanggalPost;?></span></li>
                                            <?php
                                            $title=$row->judul;
                                            $url=urlencode('http://localhost/home/blog/'.$row->id_agenda);
                                            $img=urlencode('http://localhost/resources/assets/img/'.$row->gambar);
                                            $id_agenda = $row->id_agenda;
                                          ?>
                                        </ul>
                                    </div>
                                    <p align="justify">
                                        <?php echo $row->isi;?>
                                    </p>
                                </div>
                                <!-- /.tiles-content -->
                                <div class="single-post-bottom">
                                    <div class="share">
                                        <ul>
                                            <li><span>Share this post</span></li>
                                            <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                            <!-- /.article -->
                            <h3 class="content-title">About The Author</h3>
                            <div class="author-about">
                                <ul class="about-meta">
                                    <li><img src="assets/images/avatar/avatar.jpg" class="img-circle avatar" width="85" height="85" alt="avatar"></li>
                                    <li><span>Saerox</span></li>
                                    <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="share-tooltip" data-toggle="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                                <p>
                                    Etiam vitae nibh iaculis, gravida dolor vel, varius orci. Donec sit amet tempor nibh, ut tincidunt diam. Integer nulla risus, hendrerit non ultricies non, tincidunt sed dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed consequat lobortis ligula, sit amet laoreet arcu consectetur eget. Aliquam ultrices sit amet turpis ac tristique.
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php
                        endforeach;
                    ?>
                    <!-- /.content -->
                    <aside class="sidebar col-md-3">
                        <div class="clearfix"></div>
                        <form action="#" class="search">
                            <input class="search-box" type="search" id="search-box" placeholder="Search …" value="">
                            <label class="search-label" for="search-box"><i class="fa fa-search"></i></label>
                        </form>
                        <div class="clearfix"></div>
                        <h3>Agenda Lainnya</h3>
                        <ul class="Agenda">
                            <li>
                                <div class="col-xs-4 col-sm-4 np">
                                    <img src="assets/images/blog/blog.jpg" alt="blog"> 
                                </div>
                                <div class="col-xs-8 col-sm-8">
                                    <h3 class="blog-title">
                                        <a href="blog-single-post-image.html">Title post</a>
                                    </h3>
                                    <span class="date">
                                        April, 9 2017
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-4 col-sm-4 np">
                                    <img src="assets/images/blog/blog.jpg" alt="blog"> 
                                </div>
                                <div class="col-xs-8 col-sm-8">
                                    <h3 class="blog-title">
                                        <a href="blog-single-post-image.html">Title post</a>
                                    </h3>
                                    <span class="date">
                                        April, 8 2017
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-4 col-sm-4 np">
                                    <img src="assets/images/blog/blog.jpg" alt="blog"> 
                                </div>
                                <div class="col-xs-8 col-sm-8">
                                    <h3 class="blog-title">
                                        <a href="blog-single-post-image.html">Title post</a>
                                    </h3>
                                    <span class="date">
                                        April, 7 2017
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-4 col-sm-4 np">
                                    <img src="assets/images/blog/blog.jpg" alt="blog"> 
                                </div>
                                <div class="col-xs-8 col-sm-8">
                                    <h3 class="blog-title">
                                        <a href="blog-single-post-image.html">Title post</a>
                                    </h3>
                                    <span class="date">
                                        April, 5 2017
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <h3>Tags</h3>
                        <ul class="tags">
                            <li><a href="#">Webdesign</a></li>
                            <li><a href="#">Photography</a></li>
                            <li><a href="#">UX / UI Design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">ThemeForest</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </aside>
                    <!-- /.sidebar -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content -->
        <!-- footer-bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copyright">
                            ©Skapp 2017 made by Saerox in france.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <ul class="social-network">
                            <li><a href="#" class="ico-twitter" title="Twitter">
                                <i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#" class="ico-dribbble" title="Dribbble">
                                <i class="fa fa-dribbble"></i></a>
                            </li>
                            <li><a href="https://www.behance.net/Saerox" class="ico-behance" title="Behance">
                                <i class="fa fa-behance"></i></a>
                            </li>
                            <li><a href="http://dsaerox.deviantart.com/" class="ico-deviantart" title="Deviantart">
                                <i class="fa fa-deviantart"></i></a>
                            </li>
                            <li><a href="#" class="ico-rss" title="Rss">
                                <i class="fa fa-rss"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
            <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- /.footer-bottom -->
        <!-- scripts -->
        <script src="<?php echo base_url('resources/home/js/core/jquery-3.1.1.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/jquery.easing.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/plugins/waypoints/jquery.waypoints.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/plugins/owl-carousel/owl.carousel.min.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/core/main.js')?>"></script>
        <script src="<?php echo base_url('resources/home/js/pages/blog.js')?>"></script>

        <script type="text/javascript">
         // ambil class modal
         var modal = document.getElementById('myModal');

         //ambil main nav
         var nav = document.getElementById('mainNav');

         //ambil gambar agenda terbaru, dan masukan ke dalam modal, untuk caption menggunakan "alt"
         var img = document.getElementById("gambar_agenda");
         var modalImg = document.getElementById('img01');
         var captionText = document.getElementById('caption');
         
         //jika gmabar agenda di klik
         img.onclick = function(){
          nav.style.display = "none";
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
         }

         // ambil class span untuk menutup modal
         var span = document.getElementsByClassName("close")[0];

         // jika span di klik, modal akan di tutup
         span.onclick = function(){
          nav.style.display = "block";
          modal.style.display = "none";
         }

         function copyKeClipboard()
         {
          var text_copy = document.getElementById("textInput");
          text_copy.select();
          document.execCommand("Copy");

          var tooltip = document.getElementById("my_tooltip");
          tooltip.innerHTML = "Link telah di copy ke clipboard";
         }

         function outFunc()
         {
          var tooltip = document.getElementById("my_tooltip");
          tooltip.innerHTML = "Copy ke clipboard";
         }
        </script>
    </body>
</html>