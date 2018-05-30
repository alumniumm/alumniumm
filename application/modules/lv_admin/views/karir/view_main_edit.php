	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Edit Data Karir Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Karir</a></li>
		        <li><a href="javascript:void(0)">Data Karir</a></li>
		        <li class="active">Edit Data</li>
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
					<div class="panel-heading">
						<h3 class="panel-title text-center">Edit Data Karir Alumni</h3>
					</div>
					<div class="panel-body">
		              	<table class="table table-responsive table-hover table-striped dataTable w-full"  data-plugin="dataTable">
		              	  <?php
                            foreach($data_awal_karir as $row):
                            echo form_open_multipart('admin/karir/edit/'.$row->id_karir);
                            endforeach;
                          ?>
                          <tr>
                            <td width="30%">
                            <?php
                              echo form_label('Nama Perusahaan / Instansi', 'namaPerusahaan');
                            ?>
                            </td>
                            <td>
                              <?php
                                $namaPerusahaan = array('name' => 'namaPerusahaan', 'class'=>'form-control input-sm', 'placeholder'=>'Masukkan Nama Perusahaan / Instansi', 'value'=>$row->namaPerusahaan);
                                echo form_input($namaPerusahaan);
                              ?>
                            </td>
                            <td>
                              <?php
                                echo form_error('namaPerusahaan', '<div class="alert alert-warning text-center">', '</div>');
                              ?> 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                echo form_label('Posisi yang dibutuhkan', 'posisi');
                              ?>
                            </td>
                            <td>
                              <?php
                                $posisi = array('name' => 'posisi', 'class' => 'form-control input-sm', 'placeholder' => 'Masukkan Posisi yang dibutuhkan', 'value'=>$row->posisi);
                                echo form_input($posisi);
                              ?>
                            </td>
                            <td>
                              <?php
                                echo form_error('posisi', '<div class="alert alert-warning text-center">', '</div>');
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                echo form_label('Syarat atau Kriteria atau Keterangan', 'kriteria');
                              ?>
                            </td>
                            <td>
                              <?php
                                $kriteria = array('name' => 'kriteria', 'class' => 'form-control input-sm', 'placeholder' => 'Masukkan Syarat atau Kriteria', 'value'=>$row->kriteria);
                                echo form_textarea($kriteria);
                              ?>
                            </td>
                            <td>
                              <?php
                                echo form_error('kriteria','<div class="alert alert-warning text-center">','</div>');
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                echo form_label('Batas Waktu', 'batasWaktu');
                              ?>
                            </td>
                            <td>
                              <div class="input-group date" id="tanggal_batas_waktu">
                                <?php
                                  $batasWaktu = array('id' => 'tanggalBatasWaktu', 'name' => 'batasWaktu', 'class' => 'form-control input-sm', 'placeholder' => 'Masukkan tanggal batas waktu, contoh : 2017-01-02, Format : yyyy-mm-dd', 'value'=>$batasWaktu);
                                  echo form_input($batasWaktu);
                                ?>
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>  
                              </div>
                              
                            </td>
                            <td>
                              <?php
                                echo form_error('batasWaktu','<div class="alert alert-warning text-center">','</div>');
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                echo form_label('Kontak', 'kontak');
                              ?>
                            </td>
                            <td>
                              <?php
                                $kontak = array('name' => 'kontak', 'class' => 'form-control input-sm', 'placeholder' => 'Kontak yang dapat dihubungi', 'value'=>$row->kontak);
                                echo form_input($kontak);
                              ?>
                            </td>
                            <td>
                              <?php
                                echo form_error('kontak','<div class="alert alert-warning text-center">','</div>');
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                echo form_label('Gambar', 'gambar');
                              ?>
                            </td>
                            <td>
                              <?php
                                echo form_upload('upGambar');
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <?php
                                $submit = array('type' => 'submit', 'name' => 'edit', 'class' => 'button');
                                echo form_submit($submit, 'Ubah');
                                echo form_close();
                              ?>
                            </td>
                          </tr> 
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
      // set def language indonesia
      $(document).ready(function(){
        $.fn.datepicker.defaults.language = 'id';
      });

      // set konfiguras datepicker
      $(document).ready(function(){
        $("#tanggal_batas_waktu").datepicker({
          // format: 'yyyy-mm-dd',
          format : 'dd-mm-yyyy'
        });
      });
    </script>

    <!-- inisialisasi Tinymce -->
    <script>
      tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker toc",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "save table contextmenu directionality emoticons template paste textcolor importcss colorpicker textpattern codesample"
        ],
        external_plugins: {
          //"moxiemanager": "/moxiemanager-php/plugin.js"
        },
        content_css: "css/development.css",
        add_unload_trigger: false,

        toolbar: "insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons table codesample",

        image_advtab: true,
        image_caption: true,

        style_formats: [
          {title: 'Bold text', format: 'h1'},
          {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
          {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
          {title: 'Example 1', inline: 'span', classes: 'example1'},
          {title: 'Example 2', inline: 'span', classes: 'example2'},
          {title: 'Table styles'},
          {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        template_replace_values : {
          username : "Jack Black"
        },

        template_preview_replace_values : {
          username : "Preview user name"
        },

        link_class_list: [
          {title: 'Example 1', value: 'example1'},
          {title: 'Example 2', value: 'example2'}
        ],

        image_class_list: [
          {title: 'Example 1', value: 'example1'},
          {title: 'Example 2', value: 'example2'}
        ],

        templates: [
          {title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
          {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
        ],

        setup: function(ed) {
          /*ed.on(
            'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
            'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
            'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
            console.log(e.type, e);
          });*/
        },

        spellchecker_callback: function(method, data, success) {
          if (method == "spellcheck") {
            var words = data.match(this.getWordCharPattern());
            var suggestions = {};

            for (var i = 0; i < words.length; i++) {
              suggestions[words[i]] = ["First", "second"];
            }

            success({words: suggestions, dictionary: true});
          }

          if (method == "addToDictionary") {
            success();
          }
        }
      });

      if (!window.console) {
        window.console = {
          log: function() {
            tinymce.$('<div></div>').text(tinymce.grep(arguments).join(' ')).appendTo(document.body);
          }
        };
      }
    </script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<?php $this->load->view('themes/footer'); ?>