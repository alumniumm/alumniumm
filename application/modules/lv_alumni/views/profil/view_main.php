	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Profil Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li><a href="javascript:void(0)">Profil</a></li>
		        <li class="active">Data Profil</li>
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
							<!-- Modal Ganti Pass -->
							<div class="modal fade modal-newspaper" id="ganti-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	                          <div class="modal-dialog" id="input_new_password">
	                              <div class="modal-content modal-primary" >
	                                <div class="modal-header">
	                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                  <h4 class="modal-title text-center" id="myModalLabel">Ganti Password</h4>
	                                </div>                                    
	                                <form id="form_password_baru" name="form_password" action="<?php echo base_url().'alumni/ganti-password'?>" method="post">  
		                                <div class="form-group">
		                                  <div class="modal-body">
		                                    <label>Password baru : </label>
		                                    <input class="form-control" id="password_baru1" type="password" name="password_baru1"/><br>
		                                    <label>Konfirmasi ulang password baru : </label>
		                                    <input class="form-control" id="password_baru2" type="password" name="password_baru2"/>
		                                  </div>  
		                                </div>
		                                <div class="modal-footer">
		                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
		                                  <button class="btn btn-primary" id="tombol_submit_password_baru"><i class="fa fa-check"></i> Ganti</button>
		                                </div>
	                                </form>
	                              </div>
	                          </div>
	                        </div>
	                    	<!-- End Modal Ganti Pass -->
	                    	<?php foreach($alumni as $row):?>
	                    	<div class="row margin-bottom-40">
	                    		<div class="col-md-6 ">
	                    			<img class="img-rounded pull-left" src="<?php echo base_url();?>resources/assets/img/profil/<?php echo $foto;?>" width="100" height="100">
	                    		</div>
	                    		<div class="col-md-6 ">
	                    			<img class="pull-right" src="<?php echo base_url();?>resources/assets/img/aluminium.png" width="140" height="100">
	                    			<img class="pull-right" src="<?php echo base_url();?>resources/assets/img/umm.png" width="100" height="100">
	                    		</div>
	                    	</div>
	                    	<div class="margin-bottom-15"></div>
		                	<?php echo $this->session->flashdata('msg_update_profil_alumni_sukses');?>
		                	<?php echo $this->session->flashdata('pesan');?>
		                    <h4 class="text-center"></h4>
		                    <table class="table table-striped table-hover">
		                      <tr>
		                        <th width="200">Username</th>
		                        <td>
		                        	<input class="form-control" type="text" value="<?php echo $row->username;?>" disabled/>
		                        </td>
		                      </tr>
		                      <tr>
		                      	<th>Password</th>
		                      	<td><a href="#" data-toggle="modal" data-target="#ganti-password"><button type="button" name="button" class="btn btn-primary btn-xs btn-waves"><i class="fa fa-edit"></i> Ganti Password</button></a></td>
		                      </tr>
		                      <tr>
		                        <th width="200">Nama</th>
		                        <td><?php echo $row->nama;?></td>
		                      </tr>
		                      <tr>
		                        <th>Alamat Asal</th>
		                        <td><?php echo $row->alamat_asal;?></td>
		                      </tr>
		                      <tr>
		                        <th>Tanggal Lahir</th>
		                        <td><?php echo $tanggalLahir;?></td>
		                      </tr>
		                      <tr>
		                        <th>Email</th>
		                        <td><?php echo $row->email;?></td>
		                      </tr>
		                      <tr>
		                        <th>Facebook</th>
		                        <td><?php echo $row->facebook;?></td>
		                      </tr>
		                      <tr>
		                        <th>Twitter</th>
		                        <td><?php echo $row->twitter;?></td>
		                      </tr>
		                      <tr>
		                        <th>Instagram</th>
		                        <td><?php echo $row->instagram;?></td>
		                      </tr>
		                    </table>
		                	<?php endforeach;?>
		                	<a href="<?php echo base_url().'alumni/profil/edit/'.$row->id_alumni;?>"><button type="button" name="button" class="btn btn-primary btn-sm btn-waves"><i class="fa fa-edit"></i> Edit Profil</button></a>
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
		var tombolEditPassword = document.getElementById('tombol_edit_password');
		var formEditPassword = document.getElementById('modal_password');
		var sidebar = document.getElementById('main-sidebar');
		var inputPassword1 = document.getElementById('password_baru1');
		var inputPassword2 = document.getElementById('password_baru2');
	 	var tombolSubmitPasswordBaru = document.getElementById('tombol_submit_password_baru');
		var tombolCancelPassword = document.getElementById('tombol_cancel_password');

		tombolEditPassword.onclick = function(){
			formEditPassword.style.display = "block";
			sidebar.style.display = "none";
		}

		tombolCancelPassword.onclick = function(){
			$('#form_password_baru')[0].reset();
			formEditPassword.style.display = "none";
			sidebar.style.display = "block";
		}
	</script>
	<?php $this->load->view('themes/footer'); ?>