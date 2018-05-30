<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="db_kepala";
	
	$title_page="Data Kepala BKMA";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname";
			$posisi=cariPosisi($batas, $hal);
			
			$sqld="SELECT * FROM $nama_table where kep_bkma like \"%$gname%\" and hapus=\"0\" ".
					"order by tgl_insert desc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$status=($status==1)? "Aktif" : "Tidak Aktif";
					
					$edit="<a href=\"?pages=$pages&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"?pages=$pages&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$kep_bkma</td>
						<td>$pr1</td>
						<td>$status</td>
						<td>".TglFormat5($tgl_insert)."</td>
						<td>$edit $hapus</td>
					</tr>";
					
					$no++;
				}
			}
			
			$jrow=mysql_query($sqld);
			$jnrow=mysql_num_rows($jrow);
			$jmlHal=jumlahHalaman($jnrow, $batas);	
			$LinkHal=navPage($hal, $jmlHal, $link_page);	
			if($jnrow > $batas){
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<div id=\"paging\">$LinkHal</div>";
			}
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				
				<table class='pad5'>
					<tr>
						<td>Kepala BKMA</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\"></div>
			<br /><hr /><br />
			
			<a href=\"?pages=$pages&act=input&tab=tambah\" class=\"alt_btn\">Tambah Data</a>
			<div class=\"clear\"></div><br />
			
			<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th>Kepala BKMA</th>  
	    				<th>Pembantu Rektor I</th> 
	    				<th>Status</th> 
	    				<th>Tanggal Input</th>
	    				<th width='150'>Aksi</th>
					</tr> 
				</thead> 
				<tbody>
					$td_table
				</tbody>
			</table>
			<div class=\"clear\"></div>
			$thal
			";
		break;
		
		case"input":
			if($tab=="edit"){
				$title_page.=" &raquo; Edit Data";
				
				$sqld="select * from $nama_table where id=\"$gid\" and hapus=\"0\"";
				$data=mysql_query($sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					
					$edit="<input type=\"hidden\" name=\"pid\" value=\"$id\" />";
					$edit.="<input type=\"hidden\" name=\"edit\" value=\"edit\" />";
				}
			}
			
			if($tab=="tambah"){
				$title_page.=" &raquo; Tambah Data";
				$ndata=1;
				
				$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
			}
			
			if($ndata>0){
				$cnpage="<form name=\"form1\" action=\"?pages=$pages&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Kepala BKMA</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"kep_bkma\" value=\"$kep_bkma\" size=\"50\" required />
							</td>
						</tr>
						<tr>
							<td>Pembatu Rektor I</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"pr1\" value=\"$pr1\" size=\"50\" required />
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td>".SelStatus($status, "status", "required")."</td>
						</tr>
					</table><br />
					$edit
					<input type=\"submit\" name=\"proses\" value=\"Simpan\" />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				</form>";
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>";
			}
			
		break;
		
		case"proses":
			$title_page.=" &raquo; Proses Data";
			
			extract($_POST);
			$error="";
			
			$kep_bkma=trim($kep_bkma);
			$pr1=trim($pr1);
			
			if(empty($error)){
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fkep_bkma=$fdata["kep_bkma"];
						$fpr1=$fdata["pr1"];
						
						if($kep_bkma=="$fkep_bkma" and $fpr1=="$pr1"){
							$vdata="status=\"$status\", tgl_update=\"$ndatetime\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							
							$sqld="select * from $nama_table where kep_bkma=\"$kep_bkma\" and pr1=\"$pr1\" and hapus=\"0\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="kep_bkma=\"$kep_bkma\", pr1=\"$pr1\", status=\"$status\", tgl_update=\"$ndatetime\"";
								$vvalue="id=\"$pid\"";
								
								$inp="update $nama_table set $vdata where $vvalue";
								$upd=mysql_query($inp);
								if($upd==1){
									$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
								}else{
									$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
								}
							}else{
								$cnpage="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
							}
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					}
				}
				
				if($edit=="tambah"){
					$sqld="select * from $nama_table where kep_bkma=\"$kep_bkma\" and pr1=\"$pr1\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="pr1, kep_bkma, status, tgl_insert";
						$vvalue="\"$pr1\", \"$kep_bkma\", \"$status\", \"$ndatetime\"";
						
						$inp="insert into $nama_table ($vdata) values ($vvalue)";
						$upd=mysql_query($inp);
						if($upd==1){
							$cnpage="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
						}else{
							$cnpage="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
					}
				}
			}else{
				$cnpage="$error";
			}
			
			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
		break;
		
		case"hapus":
			$title_page.=" &raquo; Hapus Data";
			
			$sqld="select * from $nama_table where id=\"$gid\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$vdata="hapus=\"1\", tgl_update=\"$ndatetime\"";
				$vvalue="id=\"$gid\"";
				
				$inp="update $nama_table set $vdata where $vvalue";
				$upd=mysql_query($inp);
				if($upd==1){
					$cnpage="<h4 class=\"alert_success\">Data Berhasil Dihapus</h4>";
				}else{
					$cnpage="<h4 class=\"alert_error\">Data Gagal Dihapus</h4>";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
			}
			
			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
		break;
	}
	
}
?>