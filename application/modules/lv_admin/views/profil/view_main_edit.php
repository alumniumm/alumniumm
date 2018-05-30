	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Edit Profil Administrator</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Profil</a></li>
		        <li class="active">Edit Data Profil</li>
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
						<div class="margin-bottom-15">
	                    	<div class="row margin-bottom-40">
	                    		<?php 
					                foreach($admin as $row):
					                endforeach;
					            ?>
	                    		<div class="col-md-6 ">
	                    			<img class="img-rounded pull-left" src="<?php echo base_url();?>resources/assets/img/profil/<?php echo $foto;?>" width="100" height="100">
	                    		</div>
	                    		<div class="col-md-6 ">
	                    			<img class="pull-right" src="<?php echo base_url();?>resources/assets/img/aluminium.png" width="140" height="100">
	                    			<img class="pull-right" src="<?php echo base_url();?>resources/assets/img/umm.png" width="100" height="100">
	                    		</div>
	                    	</div>
	                    	<div class="margin-bottom-15"></div>
				            <?php
	                          echo form_open_multipart('admin/profil/edit/');
	                        ?>
				            <table class="table table-striped table-hover">
		                      <tr>
		                        <th width="200">Ubah Foto Profil</th>
		                        <td>
		                        	<?php
		                              echo form_upload('upFotoProfil');
		                            ?>
	                            </td>
		                      </tr>
		                      <tr>
		                        <th width="200">Nama</th>
		                        <td>
		                        	<input class="form-control" type="text" name="nama_admin" value="<?php echo $row->nama;?>"/>
		                        </td>
		                        <td>
		                        	<?php echo form_error('nama_admin','<div class="alert alert-warning text-center">','</div>');?>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Alamat Asal</th>
		                        <td>
		                        	<input class="form-control" type="text" name="alamat_asal" value="<?php echo $row->alamat_asal;?>"/>
		                        </td>
		                        <td>
		                        	<?php echo form_error('alamat_asal','<div class="alert alert-warning text-center">','</div>');?>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Tanggal Lahir</th>
		                        <td>
		                        	<div class="input-group date" id="tanggal_lahir">
		                        	  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
		                              <input type="text" class="form-control" placeholder="Cth:21-December-2016" value="<?php echo $tanggal;?>" name="tanggal_lahir"/>  
		                            </div>
		                        </td>
		                        <td>
		                        	<?php echo form_error('tanggal_lahir','<div class="alert alert-warning text-center">','</div>');?>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Email</th>
		                        <td>
		                        	<input class="form-control" type="text" name="surel" value="<?php echo $row->email;?>"/>
		                        </td>
		                        <td>
		                        	<?php echo form_error('surel','<div class="alert alert-warning text-center">','</div>');?>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Facebook</th>
		                        <td>
		                        	<input class="form-control" type="text" name="facebook" value="<?php echo $row->facebook;?>"/>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Twitter</th>
		                        <td>
		                        	<input class="form-control" type="text" name="twitter" value="<?php echo $row->twitter;?>"/>
		                        </td>
		                      </tr>
		                      <tr>
		                        <th>Instagram</th>
		                        <td>
		                        	<input class="form-control" type="text" name="instagram" value="<?php echo $row->instagram;?>"/>
		                        </td>
		                      </tr>
		                    </table>
		        			<input class="btn btn-primary" type="submit" name="submit_edit_data_profil_admin" value="Ubah">
		              	</div><br>
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
    <script type="text/javascript">
	  //set def language indonesia
	  $(document).ready(function(){
	    $.fn.datepicker.defaults.language = 'id';
	  });

	  // set konfiguras datepicker
	  $(document).ready(function(){
	    $("#tanggal_lahir").datepicker({
	      // format: 'yyyy-mm-dd',
	      format : 'dd-mm-yyyy'
	    });
	  });
	</script>
	<?php $this->load->view('themes/footer'); ?>