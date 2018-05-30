	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
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
						<?php
				            foreach($awal_alumni as $row):
				            echo form_open_multipart('alumni/profil/edit/'.$row->id_alumni);
				            endforeach;
				        ?>
						<div class="margin-bottom-15">
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
	                    		<!-- form upload foto -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Edit Foto Profil', 'foto_profil');
		                            ?>
		                          </div>
		                        </div>
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              $att_form_upload = array(
		                                'name' => 'upFotoProfil',
		                                'type' => 'file',
		                                'style' => ''
		                              );
		                              echo form_upload($att_form_upload);
		                            ?>    
		                          </div>
		                        </div><br>

		                        <!-- nama -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Nama Lengkap', 'namaLengkap');
		                              $namaLengkap = array('name'=>'namaLengkap', 'class'=>'form-control input-sm', 'placeholder'=>'Tuliskan Nama Lengkap', 'value'=>$row->nama);
		                              echo form_input($namaLengkap);
		                              echo form_error('namaLengkap');
		                            ?>
		                          </div><!--/. col -->
		                        </div><!--/. row-->
		                        <br>

		                        <!-- alamat asal -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Alamat Asal', 'alamatAsal');
		                              $alamatAsal = array('name'=>'alamatAsal', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Alamat Asal', 'value'=>$row->alamat_asal);
		                              echo form_input($alamatAsal);
		                              echo form_error('alamatAsal');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- jenis kelamin -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Jenis Kelamin', 'jenisKelamin');?>
		                              <br>
		                              <?php
		                              $jenisKelamin = array(''=>'----', '1' => 'Laki - Laki', '2' => 'Perempuan');
		                              $ddName = 'jenisKelamin';
		                              $dataJk = $row->jenisKelamin;
		                              echo form_dropdown($ddName, $jenisKelamin, $dataJk);
		                              echo form_error('jenisKelamin');
		                            ?>
		                          </div><!--/. col -->
		                        </div><!--/. row-->
		                        <br>

		                        <!-- tanggal lahir -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Tanggal Lahir', 'tanggalLahir');
		                              $tanggalLahir = array('id' => 'tanggalLahir', 'name'=>'tanggalLahir', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Tanggal Lahir Alumni', 'value'=>$row->tanggalLahir);
		                              echo form_input($tanggalLahir);
		                              echo form_error('tanggalLahir');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- email -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Email (Contoh : aluminium@xyz.com)', 'email');
		                              $email = array('name'=>'email', 'type'=>'email', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Email Alumni', 'value'=>$row->email);
		                              echo form_input($email);
		                              echo form_error('email');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- facebook -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Facebook (Copy Link Profil Fb Anda Contoh : https://www.facebook.com/andy.hartanto.9)', 'facebook');
		                              $facebook = array('name'=>'facebook', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Facebook Alumni', 'value'=>$row->facebook);
		                              echo form_input($facebook);
		                              echo form_error('facebook');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- twitter -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Twitter (Contoh : andyvigor - Tanpa "@")', 'twitter');
		                              $twitter = array('name'=>'twitter', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Nama Twitter @Alumni', 'value'=>$row->twitter);
		                              echo form_input($twitter);
		                              echo form_error('twitter');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- instagram -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              echo form_label('Instagram (Contoh : andyhartanto11 - Tanpa "@")', 'instagram');
		                              $instagram = array('name'=>'instagram', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Nama Instagram @alumni', 'value'=>$row->instagram);
		                              echo form_input($instagram);
		                              echo form_error('instagram');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->
		                        <br>

		                        <!-- tombol submit -->
		                        <div class="row">
		                          <div class="col-lg-12">
		                            <?php
		                              $btn = array('type'=>'submit', 'name'=>'edit', 'class'=>'button');
		                              echo form_submit($btn,'Ubah');
		                            ?>
		                          </div><!--/.col-->
		                        </div><!--/.row-->    


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