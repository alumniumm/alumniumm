  <!-- Footer -->
  <footer class="site-footer noprint">
    <span class="site-footer-legal">Developed By <a href="http://semicolon.biz" target="_blank">SEMICOLON;</a>. &copy; <?php echo date('Y') ?> All Rigth Reserved.</span>
    <div class="site-footer-right">
      Support By Teknik Informatika
    </div>
  </footer>

  <!-- Tinymce -->
  <script src="<?php echo base_url('reoursces/assets/tinymce/js/tinymce/tinymce.dev.js');?>"></script>
  <script src="<?php echo base_url('reoursces/assets/tinymce/js/tinymce/plugins/table/plugin.dev.js');?>"></script>
  <script src="<?php echo base_url('reoursces/assets/tinymce/js/tinymce/plugins/paste/plugin.dev.js');?>"></script>
  <script src="<?php echo base_url('reoursces/assets/tinymce/js/tinymce/plugins/wordcount/plugin.js');?>"></script>
  <script src="<?php echo base_url('reoursces/assets/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js');?>"></script>

  <!-- Core  -->
  <script src="<?php echo base_url() ?>resources/themes/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/animsition/animsition.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/asscroll/jquery-asScroll.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/mousewheel/jquery.mousewheel.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/asscrollable/jquery.asScrollable.all.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/ashoverscroll/jquery-asHoverScroll.js" async></script>

  <!-- Plugins -->
  <script src="<?php echo base_url() ?>resources/material/global/vendor/switchery/switchery.min.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/intro-js/intro.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/screenfull/screenfull.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/slidepanel/jquery-slidePanel.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/matchheight/jquery.matchHeight-min.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/peity/jquery.peity.min.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/formvalidation/formValidation.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/formvalidation/framework/bootstrap.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/matchheight/jquery.matchHeight-min.js" async></script>
  <script src="<?php echo base_url() ?>resources/material/global/vendor/jquery-wizard/jquery-wizard.js" async></script>
  <!-- <script src="<?php echo base_url() ?>resources/material/topbar/assets/examples/js/dashboard/v1.js"></script> -->
  
  <!-- Scripts -->
  <script src="<?php echo base_url() ?>resources/material/global/js/core.js"></script>
  <script src="<?php echo base_url() ?>resources/material/topbar/assets/js/site.js"></script>
  <script src="<?php echo base_url() ?>resources/material/topbar/assets/js/sections/menubar.js"></script>
  <script src="<?php echo base_url() ?>resources/material/topbar/assets/js/sections/sidebar.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/configs/config-colors.js"></script>
  <script src="<?php echo base_url() ?>resources/material/topbar/assets/js/configs/config-tour.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/asscrollable.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/animsition.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/slidepanel.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/switchery.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/tabs.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/matchheight.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/peity.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/jquery-wizard.js"></script>
  <script src="<?php echo base_url() ?>resources/material/global/js/components/matchheight.js"></script>
  <script src="<?php echo base_url() ?>resources/material/topbar/assets/examples/js/forms/wizard.js"></script>
  <script src="<?php echo base_url() ?>resources/assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <!-- dataTable -->
  <script src="<?php echo base_url() ?>resources/themes/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="<?php echo base_url() ?>resources/themes/js/components/datatables.js"></script>
  <!-- dataTables-->
  
  <!-- datepicker -->
  <script type="text/javascript">
      // set def language indonesia
      $(document).ready(function(){
        $.fn.datepicker.defaults.language = 'id';
      });

      // set konfiguras datepicker
      $(document).ready(function(){
        $("#tanggalLahir").datepicker({
          // format: 'yyyy-mm-dd',
          format : 'dd-mm-yyyy'
        });
      });
  </script>
  
  <script>
  $(document).ready(function($) {
    Site.run();
  });
</script>

</body>

</html>