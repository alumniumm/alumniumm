	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola Karir Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Karir</a></li>
		        <li class="active">Sebaran Alumni Teknik Informatika UMM</li>
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
						<?php
				    		echo $map['html'];
				    	?>
				</div>
			</div>
		</div>

	<script type="text/javascript">
	  var centreGot = false;
	  var mapCenter;
	  var tombol_kembali_peta_alumni = document.getElementById('tombolKembali');
	  var status_cari = document.getElementById('statusCari');
	  if(navigator.geolocation){
	    navigator.geolocation.getCurrentPosition(success, fail);
	  }else{
	    alert('sorry tidak suport geolocation');
	  }

	  function success(position){
	   	document.getElementById('lat').value = position.coords.latitude;
	    document.getElementById('long').value = position.coords.longitude;
	  }

	  function fail() {
	    alert('data lokasi null');
	  } 

	  function cek_status()
	  {      
	    if(status_cari.value == 1)
	    {
	      tombol_kembali_peta_alumni.style.display = "block";
	    }
	    else if(status_cari.value == 0)
	    {
	      tombol_kembali_peta_alumni.style.display = "none";
	    }
	  }

	  tombol_kembali_peta_alumni.onclick = function(){
	    window.location.href = "<?php echo base_url('alumniterdekathaversine')?>";
	  }

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