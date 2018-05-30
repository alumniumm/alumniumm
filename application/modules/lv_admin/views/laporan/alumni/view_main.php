<?php $this->load->view('themes/admin/header') ?>
	<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		<div class="page-content padding-30 container-fluid">	
			<div class="row">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Laporan <i>Tracer Study</i> Alumni<small> (Kelola Laporan)</small></h3>
					</div>
					<div class="panel-body container-fluid">
						<table class="table table-hover dataTable table-striped width-full" role="grid" data-plugin="dataTable">
				            <thead>
				              <tr>
				                <th class="text-center" width="20">No</th>
				                <th class="text-center">Nama</th>
				                <th class="text-center">Username</th>
				                <th class="text-center" width="150">Aksi</th>
				              </tr>
				            </thead>
				            <tbody>
				              <tr>
				                <td class="text-center"></td>
				                <td></td>
				                <td></td>
				                <td class="text-center">
				                	<a href="" ><button class="btn btn-warning btn-sm"><i class="fa fa-credit-card"></i> Detail </button></a>
				                	<a href="" ><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus </button></a>
				                </td>
				              </tr>
				            </tbody>
				        </table>	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('themes/admin/footer') ?>
<?php $this->load->view('themes/footer-script') ?>