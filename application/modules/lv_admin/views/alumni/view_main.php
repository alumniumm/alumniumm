	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li class="active">Data Alumni</li>
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
		                	<button class="btn btn-primary waves-effect waves-light" data-target="#tambahData" data-toggle="modal" type="button">
		                  		<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
		                	</button>
		              	</div><br>
		              	<?php 
                            echo $this->session->flashdata('msg_insert_data_alumni_sukses');
                            echo $this->session->flashdata('msg_update_profil_alumni_sukses');
                            echo $this->session->flashdata('msg_hapus_alumni_sukses');
                        ?>
		              	<table class="table table-responsive table-hover table-striped dataTable w-full"  data-plugin="dataTable">
		              		<thead>
		              			<tr>
		              				<th class="text-center">No</th>
		              				<th>Nama</th>
		              				<th>Username</th>
		              				<th class="text-center" width="150">Aksi</th>
		              			</tr>
		              		</thead>
		              		<tbody>
		              			<?php $no= page+1; foreach($alumni->result() as $row) : ?>
		              			<tr>
		              				<td class="text-center"><?php echo $no; ?></td>
		              				<td><?php echo $row->nama; ?></td>
		              				<td><?php echo $row->username; ?></td>
		              				<td class="text-center">
					                	<a class="btn btn-warning btn-xs" style="text-decoration:none" href="<?php echo base_url().'admin/alumni/edit/'.$row->id_alumni;?>"><i class="fa fa-edit"></i> Edit
					                	</a>
					                	<a class="btn btn-danger btn-xs" style="text-decoration:none" data-href="<?php echo base_url().'admin/alumni/delete/'.$row->id_alumni;?>" data-toggle="modal" data-target="#confirm-delete">
					                			<i class="fa fa-trash" aria-hidden="true"> </i> Hapus
					                	</a>
					                </td>
		              			</tr>
		              			<?php $no++; endforeach; ?>
		              		</tbody>
		              		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
	                          <div class="modal-dialog" id="konfirmasi_hapus">
	                              <div class="modal-content modal-danger" >
	                                <div class="modal-header">
	                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                  <h4 class="modal-title" id="myModalLabel">Konfirmasi menghapus data Alumni</h4>
	                                  </div>
	                                  <div class="modal-body">
	                                    <p>Apakah anda yakin ingin menghapus data</p>
	                                    
	                                    <!-- <p class="debug-url"></p>    -->
	                                  </div>
	                                  <div class="modal-footer">
	                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                                    <a href="<?php echo base_url().'admin/alumni/delete/'.$row->id_alumni;?>" class="btn btn-danger btn-ok">Hapus</a>
	                                </div>
	                              </div>
	                          </div>
	                        </div>
		              	</table><br>
					</div>
				</div>
			</div>
		</div>
	<div class="modal fade modal-3d-sign modal-primary" id="tambahData" aria-hidden="false" aria-labelledby="tambahData" role="dialog" tabindex="-1">
	  <div class="modal-dialog modal-md">
	      <div class="modal-content">
	          <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                  <span aria-hidden="true">×</span>
	              </button>
	              <h4 class="modal-title text-center">Tambah Data Alumni</h4>
	          </div>
	          <div class="modal-body"><br>
	              <form class="form-horizontal" id="formAdd" action="<?php echo base_url('admin/alumni/add')?>" method="post" enctype="multipart/form-data" autocomplete="off">
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Username</label>
	                      <div class="col-sm-8">
	                          <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Password</label>
	                      <div class="col-sm-8">
	                          <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Nama Lengkap</label>
	                      <div class="col-sm-8">
	                          <input type="text" name="namaLengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Jenis Kelamin</label>
	                      <div class="col-sm-8">
	                          	<select name="jenisKelamin" class="form-control" required>
			                      <option value="">-- Pilih --</option>
			                      <option value="1">Laki-laki</option>
			                      <option value="2">Perempuan</option>
			                    </select>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Tanggal Lahir</label>
	                      <div class="col-sm-4">
	                      	  	<div class="input-group">
				                    <span class="input-group-addon">
				                      <i class="icon md-calendar" aria-hidden="true"></i>
				                    </span>
				                    <input type="text" name="tanggalLahir" class="form-control" data-plugin="datepicker">
				                </div>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Alamat Asal</label>
	                      <div class="col-sm-8">
	                          <textarea class="form-control" name="alamatAsal" rows="3" placeholder="Masukkan Alamat Asal"></textarea>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Email</label>
	                      <div class="col-sm-8">
	                          <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <div class="col-sm-9 col-sm-offset-3">
	                          <div id="btnAction">
	                              <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp; Tambah</button>
	                              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batal</button>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </form>
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