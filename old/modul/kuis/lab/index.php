<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="db_bagian";
	$nama_table2="db_pertanyaan";
	$kategori="7";
	
	$title_page="Data Kuesioner Laboratorium";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname&gbase=$gbase";
			$posisi=cariPosisi($batas, $hal);
			
			if(!empty($gbase)){
				$selgbase.="and status=\"$gbase\"";
			}
			
			$sqld="SELECT * FROM $nama_table where bagian like \"%$gname%\" and status=\"1\" and hapus=\"0\" ".
					"$selgbase and kategori=\"$kategori\" order by urutan asc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_status=($status==1)? "Aktif" : "Tidak Aktif";
					
					$sqld2="select * from $nama_table2 where bagian=\"$id\" and hapus=\"0\" and status=\"1\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					
					$detail="<a href=\"?pages=$pages&act=detail&gid=$id\" class=\"blink\">Detail</a>";
					$edit="<a href=\"?pages=$pages&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"?pages=$pages&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$bagian</td>
						<td>$ndata2</td>
						<td>$urutan</td>
						<td>$nama_status</td>
						<td>$edit $hapus $detail</td>
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
						<td>Kegiatan</td>
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
	    				<th>Kegiatan</th>
	    				<th>Jml. Parameter Aktif</th>
	    				<th>Urutan</th>
	    				<th>Status</th>
	    				<th width='200'>Aksi</th>
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
				
				$sqld="select * from $nama_table where id=\"$gid\"and hapus=\"0\" and kategori=\"$kategori\"";
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
				
				$sqld="select * from $nama_table where hapus=\"0\" and kategori=\"$kategori\" ".
						"order by urutan desc limit 1";
				$data=mysql_query($sqld);
				$fdata=mysql_fetch_assoc($data);
				$urutan=$fdata["urutan"] + 1;
				$ndata=1;
				
				$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
			}
			
			if($ndata>0){
				$cnpage="<form name=\"form1\" action=\"?pages=$pages&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Nama Kegiatan</td>
							<td>:</td>
							<td><input type=\"text\" name=\"bagian\" value=\"$bagian\" size='70' required /></td>
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
			$bagian=trim($bagian);
			$bagian=str_replace("\"", "'", $bagian);
			$bagian=mysql_escape_string($bagian);
			
			$error="";
			
			if(empty($bagian)){
				$error.="<h4 class=\"alert_warning\">Bagian masih kosong</h4>";
			}
			
			if(empty($status)){
				$error.="<h4 class=\"alert_warning\">Status masih kosong</h4>";
			}
			
			if(empty($urutan)){
				$error.="<h4 class=\"alert_warning\">Urutan masih kosong</h4>";
			}
			
			if(empty($error)){
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and kategori=\"$kategori\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fbagian=$fdata["bagian"];
						
						if($fbagian==$bagian){
							$vdata="urutan=\"$urutan\", tgl_update=\"$ndatetime\", status=\"$status\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							$sqld="select * from $nama_table where bagian=\"$bagian\" and kategori=\"$kategori\" ".
									"and hapus=\"0\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="bagian=\"$bagian\", urutan=\"$urutan\", status=\"$status\", ";
								$vdata.="kategori=\"$kategori\", tgl_update=\"$ndatetime\"";
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
					$sqld="select * from $nama_table where bagian=\"$bagian\" and hapus=\"0\" and kategori=\"$kategori\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="bagian, urutan, kategori, tgl_insert, status, hapus";
						$vvalue="\"$bagian\", \"$urutan\", \"$kategori\", \"$ndatetime\", \"$status\", \"0\"";
						
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
			
			$sqld="select * from $nama_table where id=\"$gid\" and hapus=\"0\" and kategori=\"$kategori\"";
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
		
		case"detail":
			$title_page.=" &raquo; Detail";
			$link_back="?pages=$pages";
			$link_back2="?pages=$pages&act=detail&gid=$gid";
			
			$sqld="select * from $nama_table where id=\"$gid\" and hapus=\"0\" and kategori=\"$kategori\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$id_bagian=$fdata["id"];
				$bagian=$fdata["bagian"];
				
				if(empty($kat)){
					$cnpage="<a href=\"$link_back\" class=\"alt_btn\">&laquo; Kembali ke Halaman Utama</a>";
					$cnpage.="<div class=\"clear\"></div><br /><br />";
				}
				
				$cnpage.="<table class='pad5'>
					<tr>
						<td>Kegiatan</td>
						<td>:</td>
						<td><b>$bagian</b></td>
					</tr>
				</table>
				<hr /><br />";
				
				include"detail.php";
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
				$cnpage.="<br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" />
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
	}
	
}
?>