	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Edit Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li><a href="javascript:void(0)">Data Alumni</a></li>
		        <li class="active">Edit Data Alumni</li>
		      </ol>
		      <div class="page-header-actions">
		        <a class="btn btn-sm btn-primary btn-round waves-effect waves-light waves-round" href="<?php echo base_url()?>" target="_blank">
		          <i class="icon md-link" aria-hidden="true"></i>
		          <span class="hidden-xs">Aluminium</span>
		        </a>
		      </div>
		    </div>
			<div class="page-content">	
				<div class="panel">
					<div class="panel-body"><br>
                        <?php
				            foreach($data_awal_alumni as $row):
				            endforeach;
				        ?>
						<div class="modal fade" id="ganti-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
                          <div class="modal-dialog" id="input_new_password">
                              <div class="modal-content modal-primary" >
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title text-center" id="myModalLabel">Ganti Password</h4>
                                </div>                                    
                                <form id="form_password_baru" name="form_password" action="<?php echo base_url().'/admin/alumni/ganti-password'.$row->id_alumni;?>" method="post"> 
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
	                                  <button class="btn btn-primary" id="tombol_submit_password_baru"><i class="fa fa-send"></i> Ganti</button>
	                                </div>
                                </form>
                              </div>
                          </div>
                        </div>
		                  <!-- tabel input data -->
                          <table class="table table-striped table-hover">
                            <?php
                              echo form_open_multipart('admin/alumni/edit-data/'.$row->id_alumni);
                            ?>
                            <tr>
                              <td width="15%"><?php echo form_label('Username', 'username');?></td>
                              <td>
                                <?php
                                  $username = array('name'=>'username', 'class'=>'form-control input-sm', 'placeholder'=>'Masukan Username', 'value'=>$row->username, 'readonly'=>'true');
                                  echo form_input($username);
                                ?>
                              </td>
                              <td width="30%">
                                <?php
                                  echo form_error('username','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Password', 'password');?></td>
                              <td>
                                <!-- <?php
                                  $password = array('name'=>'password', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Password', 'value'=>$row->password);
                                  echo form_input($password);
                                ?> -->
                                <a href="#" id="ganti-password"><i class="fa fa-pencil-square-o" aria-hidden="true"> Ubah</i></a>
                              </td>
                              <td>
                                <?php echo $this->session->flashdata('msg');
                                
                                  echo form_error('password','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Nama Lengkap', 'namaLengkap');?></td>
                              <td>
                                <?php
                                  $namaLengkap = array('name'=>'namaLengkap', 'class'=>'form-control input-sm', 'placeholder'=>'Tuliskan Nama Lengkap', 'value'=>$row->nama);
                                  echo form_input($namaLengkap);
                                ?>
                              </td>
                              <td>
                                <?php
                                  echo form_error('namaLengkap','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Jenis Kelamin', 'jenisKelamin');?></td>
                              <td>
                                <?php
                                  $jenisKelamin = array(''=>'----', '1' => 'Laki - Laki', '2' => 'Perempuan');
                                  $dropDownName = 'jenisKelamin';
                                  $dataJk = $row->jenisKelamin;
                                  echo form_dropdown($dropDownName, $jenisKelamin, $dataJk);
                                ?>
                              </td>
                              <td>
                                <?php
                                  echo form_error('jenisKelamin','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Tanggal Lahir', 'tanggalLahir');?></td>
                              <td>
                                <div class="input-group date" id="tanggal_lahir">
                                  <!-- <?php
                                    $tanggalLahir = array('id' => 'tanggalLahir', 'name'=>'tanggal_lahir', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Tanggal Lahir Alumni', 'value'=>$tanggal);
                                    echo form_input($tanggalLahir);
                                  ?> -->
                                  <input type="text" class="form-control" placeholder="Cth:21-December-2016" value="<?php echo $tanggal;?>" name="tanggal_lahir"/>  
                                  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                </div>
                                <!-- <div class="input-group date" id="tanggalLahir">
                                  <input type="text" class="form-control" placeholder="Cth:21-December-2016" name="tanggalLahir"/>

                                  <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                  </span>
                                 </div>-->
                              </td>
                              <td>
                                <?php
                                  echo form_error('tanggalLahir','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Alamat Asal', 'alamatAsal');?></td>
                              <td>
                                <?php
                                  $alamatAsal = array('name'=>'alamatAsal', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Alamat Asal', 'value'=>$row->alamat_asal);
                                  echo form_input($alamatAsal);
                                ?>
                              </td>
                              <td>
                                <?php
                                  echo form_error('alamatAsal','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td><?php echo form_label('Email ', 'email');?></td>
                              <td>
                                <?php
                                  $email = array('name'=>'email', 'type'=>'email', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Email Alumni', 'value'=>$row->email);
                                  echo form_input($email);
                                ?>
                              </td>
                              <td>
                                <?php
                                  echo form_error('email','<div class="alert alert-warning text-center">','</div>');
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <?php
                                $btn = array('type'=>'submit', 'name'=>'ubah', 'class'=>'button btn btn-primary btn-sm');
                                echo form_submit($btn, 'Ubah');
                                echo form_close();
                              ?>
                              </td>
                            </tr>
                          </table>
                          <!-- /.tabel input data -->
					</div>
				</div>
			</div>
		</div>
	<script src="<?php echo base_url().'apd_dump_persistent_resources()/assets/js/bootstrap-confirmation/bootstrap-confirmation.min.js'; ?>"></script>
	<script type="text/javascript">
      var tombolEditPassword = document.getElementById('tombol_edit_password');
      var formEditPassword = document.getElementById('ganti-password');
      var sidebar = document.getElementById('main-sidebar');
      var inputPassword1 = document.getElementById('password_baru1');
      var inputPassword2 = document.getElementById('password_baru2');
      var tombolSubmitPasswordBaru = document.getElementById('tombol_submit_password_baru');

      tombolEditPassword.onclick = function(){
        formEditPassword.style.display = "block";
        sidebar.style.display = "none";
      }

  
      // set def language indonesia
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

    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<?php $this->load->view('themes/footer'); ?>