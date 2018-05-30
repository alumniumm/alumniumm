	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola Laporan <i>Tracer Study</i> Stakeholder</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Laporan</a></li>
		        <li class="active">Data Stakeholder</li>
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
						<!--<div class="margin-bottom-15">
		                	<button class="btn btn-primary waves-effect waves-light" data-target="#tambahData" data-toggle="modal" type="button">
		                  		<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
		                	</button>
		              	</div>-->
		              	<table class="table table-responsive table-hover table-striped dataTable w-full"  data-plugin="dataTable">
		              		<thead>
		              			<tr>
		              				<th class="text-center">No</th>
		              				<th>Nama Pengisi</th>
		              				<th>Perusahaan</th>
		              				<th>Nama Alumni</th>
		              				<th>Tanggal Pengisian</th>
		              				<th class="text-center" width="150">Tracer Study</th>
		              			</tr>
		              		</thead>
		              		<tbody>
		              			<?php
									$no = $page + 1;
										foreach($TS_Stakeholder->result() as $row): 
								?>
		              			<tr>
		              				<td class="text-center"><?php echo $no; ?></td>
		              				<td><?php echo $row->nama;?></td>
		              				<td><?php echo $row->perusahaan;?></td>
		              				<td><?php echo $row->namaAlumni;?></td>
		              				<td><?php echo $row->tanggalIsi;?></td>
		              				<td class="text-center">
					                	<a class="btn btn-warning btn-xs" style="text-decoration:none" href="<?php echo base_url().'admin/laporan/stakeholder/detail/'.$row->id_tss;?>"><i class="fa fa-edit"></i> Detail
					                	</a>
					                </td>
		              			</tr>
		              			<?php
									$no++;
									endforeach;
								5?>
		              		</tbody>
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
	              <form class="form-horizontal" id="formAdd" action="<?php echo base_url('admin/alumni/tambah_data_alumni')?>" method="post" enctype="multipart/form-data" autocomplete="off">
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
			                      <option value="Laki-laki">Laki-laki</option>
			                      <option value="Perempuan">Perempuan</option>
			                    </select>
	                      </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="control-label col-sm-3">Tanggal Lahir</label>
	                      <div class="col-sm-3">
	                      	  	<input type="text" class="form-control" name="tanggalLahir" data-plugin="datepicker">
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