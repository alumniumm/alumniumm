<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage.="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	switch($kat){
		default:
			$title_page.=" &raquo; Data Pertanyaan";
			$link_page="$link_back2&gname=$gname&gbase=$gbase";
			$posisi=cariPosisi($batas, $hal);
			
			if(!empty($gbase)){
				$selgbase.="and status=\"$gbase\"";
			}
			
			$sqld="SELECT * FROM $nama_table2 where pertanyaan like \"%$gname%\" and status=\"1\" and hapus=\"0\" ".
					"and bagian=\"$gid\" $selgbase order by urutan asc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_status=($status==1)? "Aktif" : "Tidak Aktif";
					
					$edit="<a href=\"$link_back2&kat=input&tab=edit&gdid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"$link_back2&kat=hapus&gdid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$pertanyaan</td>
						<td>$urutan</td>
						<td>$nama_status</td>
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
			
			$cnpage.="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"$act\" />
				<input type=\"hidden\" name=\"gid\" value=\"$gid\" />
				
				<table class='pad5'>
					<tr>
						<td>Pertanyaan</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>".SelStatus($gbase, "gbase")."</td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='$link_back2'\"/>
			</form>
			<div class=\"clear\"></div>
			<br /><hr /><br />
			
			<a href=\"$link_back2&kat=input&tab=tambah\" class=\"alt_btn\">Tambah Data</a>
			<div class=\"clear\"></div><br />
			
			<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th>Pertanyaan</th>
	    				<th>Urutan</th>
	    				<th>Status</th>
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
				
				$sqld="select * from $nama_table2 where bagian=\"$gid\" and id=\"$gdid\" and hapus=\"0\"";
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
				
				$sqld="select * from $nama_table2 where bagian=\"$gid\" and hapus=\"0\" order by urutan desc limit 1";
				$data=mysql_query($sqld);
				$fdata=mysql_fetch_assoc($data);
				$urutan=$fdata["urutan"] + 1;
				$ndata=1;
				
				$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
			}
			
			if($ndata>0){
				$cnpage.="<form name=\"form1\" action=\"$link_back2&kat=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Pertanyaan</td>
							<td>:</td>
							<td><input type=\"text\" name=\"pertanyaan\" value=\"$pertanyaan\" size='70' required /></td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td>".SelStatus($status, "status", "required")."</td>
						</tr>
						<tr>
							<td>Urutan</td>
							<td>:</td>
							<td><input type=\"text\" name=\"urutan\" value=\"$urutan\" size=\"2\" required /></td>
						</tr>
						
					</table><br />
					$edit
					<input type=\"submit\" name=\"proses\" value=\"Simpan\" />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back2'\"/>
				</form>";
			}else{
				$cnpage.="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back2'\"/>";
			}
		break;
		
		case"proses":
			$title_page.=" &raquo; Proses Data";
			
			extract($_POST);
			$pertanyaan=trim($pertanyaan);
			$pertanyaan=str_replace("\"", "'", $pertanyaan);
			$pertanyaan=mysql_escape_string($pertanyaan);
			
			$error="";
			
			if(empty($pertanyaan)){
				$error.="<h4 class=\"alert_warning\">Pertanyaan masih kosong</h4>";
			}
			
			if(empty($status)){
				$error.="<h4 class=\"alert_warning\">Status masih kosong</h4>";
			}
			
			if(empty($urutan)){
				$error.="<h4 class=\"alert_warning\">Urutan masih kosong</h4>";
			}
			
			if(empty($error)){
				if($edit=="edit"){
					$sqld="select * from $nama_table2 where id=\"$pid\" and bagian=\"$gid\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fpertanyaan=$fdata["pertanyaan"];
						
						if($fpertanyaan==$pertanyaan){
							$vdata="urutan=\"$urutan\", tgl_update=\"$ndatetime\", status=\"$status\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table2 set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage.="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage.="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							$sqld="select * from $nama_table2 where pertanyaan=\"$pertanyaan\" and hapus=\"0\" ".
									"and bagian=\"$gid\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="pertanyaan=\"$pertanyaan\", urutan=\"$urutan\", status=\"$status\", ";
								$vdata.="tgl_update=\"$ndatetime\"";
								$vvalue="id=\"$pid\"";
								
								$inp="update $nama_table2 set $vdata where $vvalue";
								$upd=mysql_query($inp);
								if($upd==1){
									$cnpage.="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
								}else{
									$cnpage.="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
								}
							}else{
								$cnpage.="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
							}
						}
					}else{
						$cnpage.="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					}
				}
				
				if($edit=="tambah"){
					$sqld="select * from $nama_table2 where pertanyaan=\"$pertanyaan\" and hapus=\"0\" ".
							"and bagian=\"$gid\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="bagian, pertanyaan, urutan, tgl_insert, status, hapus";
						$vvalue="\"$gid\", \"$pertanyaan\", \"$urutan\", \"$ndatetime\", \"$status\", \"0\"";
						
						$inp="insert into $nama_table2 ($vdata) values ($vvalue)";
						$upd=mysql_query($inp);
						if($upd==1){
							$cnpage.="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
						}else{
							$cnpage.="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
						}
					}else{
						$cnpage.="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
					}
				}
				
			}else{
				$cnpage.="$error";
			}
			
			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back2'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=$link_back2\">";
		break;
		
		case"hapus":
			$title_page.=" &raquo; Hapus Data";
			
			$sqld="select * from $nama_table2 where id=\"$gdid\" and bagian=\"$gid\" and hapus=\"0\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$vdata="hapus=\"1\", tgl_update=\"$ndatetime\"";
				$vvalue="id=\"$gdid\" and bagian=\"$gid\"";
				
				$inp="update $nama_table2 set $vdata where $vvalue";
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
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back2'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=$link_back2\">";
		break;
		
	}
}
?>