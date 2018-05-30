	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Detail Karir Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li><a href="javascript:void(0)">Karir</a></li>
		        <li class="active">Detail Data Karir Alumni</li>
		      </ol>
		      <div class="page-header-actions">
		        <a class="btn btn-sm btn-primary btn-round waves-effect waves-light waves-round" href="<?php echo base_url()?>" target="_blank">
		          <i class="icon md-link" aria-hidden="true"></i>
		          <span class="hidden-xs">Aluminium</span>
		        </a>
		      </div>
		    </div>
			<div class="page-content">	
				<div class="panel panel-bordered">
					<div class="panel-body">
						<?php
				            foreach($karir_detail_per_id as $row):
				        ?>
						<h4 class="alert alert-primary"><?php echo $row->namaPerusahaan;?></h4>
						<?php
				           endforeach;
				        ?>
					</div>
				</div>
			</div>
		</div>
					
    <script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<?php $this->load->view('themes/footer'); ?>