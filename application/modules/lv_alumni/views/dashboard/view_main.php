	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
			<div class="page-content padding-30 container">	
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
				          <div class="panel-body">
				            <div class="text-center">
				              <form name="form_status" id="post" action="<?php echo base_url('alumni/add-status');?>" method="post">
				                <div class="form-group">
				                  <textarea class="form-control" rows="3" name="txtArea_status_alumni" placeholder="Sampaikan sesuatu disini . . ." required></textarea>
				                </div>
				                  <button class="btn btn-pure btn-default icon md-image waves-effect waves-classic pull-left" type="button" name="button"></button>
				                  <button class="btn btn-pure btn-default icon md-tv-play waves-effect waves-classic pull-left" type="button" name="button"></button>
				                  <button class="btn btn-pure btn-default icon md-calendar waves-effect waves-classic pull-left" type="button" name="button"></button>
				                  <button class="btn btn-pure btn-default icon md-map waves-effect waves-classic pull-left" type="button" name="button"></button>
				                  <button class="btn btn-primary waves-effect waves-light pull-right" value="simpan" type="submit"><i class="fa fa-send"></i> Kirim</button>
				              </form>
				            </div>
				          </div>
				      	</div>
				      	<div class="panel">
				      		<div class="panel-body nav-tabs-animate">
				      			<div class="tab-content">
				      				<ul class="list-group">
				      					<?php
				                            foreach($lini_masa_terbaru->result()as $row):
				                            $id_lini_masa	=$row->id_lini_masa;
				                            $isi 			=$row->isi;
				                            $foto_profil		=$row->foto_profil;
				                            $nama 			=$row->nama;
				                            $twitter 		=$row->twitter;
				                            $facebook 		=$row->facebook;
				                            $instagram 		=$row->instagram;
				                            $tanggal_kirim 	=$row->tanggal_kirim;
				                            if($foto_profil == null)
				                            {
				                              $set_foto = 'no_avatar.png';
				                            }
				                            else
				                            {
				                              $set_foto = $foto_profil;
				                            }
				                        ?>
				      					<li class="list-group-item">
				      						<div class="media">
						                        <div class="media-left">
						                          <a class="avatar" href="javascript:void(0)">
						                            <img class="img-responsive" src="<?php echo base_url();?>resources/assets/img/profil/thumb/<?php echo $set_foto;?>" alt="...">
						                          </a>
						                        </div>
						                        <div class="media-body">
						                          <h4 class="media-heading"><?php echo $nama;?></h4>
						                          <h4 class="media-heading pull-right">
									                  <a class="label bg-twitter" href="<?php echo $twitter;?>"><i class="fa fa-twitter"></i></a>&nbsp;
									                  <a class="label bg-facebook" href="<?php echo $facebook;?>"><i class="fa fa-facebook"></i></a>&nbsp;
									                  <a class="label bg-instagram" href="<?php echo $instagram;?>"><i class="fa fa-instagram"></i></a>&nbsp;
						                          </h4>
						                          <small>di posting pada <?php echo $tanggal_kirim;?></small>
						                          <div class="profile-brief" align="justify"><?php echo $isi;?></div>
						                        </div>
						                    </div>
				      					</li>
				      					<?php endforeach;?>
				      				</ul>
				      			</div>
				      		</div>
				      	</div>
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