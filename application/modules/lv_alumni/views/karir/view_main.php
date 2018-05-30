	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola Karir Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li><a href="javascript:void(0)">Karir</a></li>
		        <li class="active">Data Karir Alumni</li>
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
	                        echo $this->session->flashdata('msg_insert_data_karir_sukses');
	                        echo $this->session->flashdata('msg_update_data_karir_sukses');
	                        echo $this->session->flashdata('msg_hapus_data_karir_sukses');
	                    ?>
		              	<table class="table table-responsive table-striped table-hover dataTable w-full" data-plugin="dataTable">
		              		<thead>
		              			<tr>
		              				<th class="text-center">No</th>
		              				<th>Nama Perusahaan</th>
		              				<th>Posisi</th>
		              				<th>Batas Waktu</th>
		              				<th class="text-center">Poster</th>
		              				<th class="text-center" width="150">Aksi</th>
		              			</tr>
		              		</thead>
		              		<tbody>
		              			<?php
			                      $no = $page+1;
			                      foreach($karir->result() as $row):
			                    ?>
		              			<tr>
		              				<td class="text-center"><?php echo $no; ?></td>
		              				<td><?php echo $row->namaPerusahaan;?></td>
		              				<td><?php echo $row->posisi;?></td>
		              				<td><?php echo $row->batasWaktu;?></td>
		              				<td align="center"><?php echo $row->id_alumni_fk;?></td>
		              				<td class="text-center">
					                	<a class="btn btn-warning btn-xs" style="text-decoration:none" href="<?php echo base_url()."alumni/karir/detail/".$row->id_karir?>"><i class="fa fa-edit"></i> Detail
					                	</a>
					                </td>
		              			</tr>
		              			<?php
	      							$no++;
	      							endforeach;
	      						?>
		              		</tbody>
		              	</table><br>
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