<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="db_nilai";
	
	$kategori="6";
	$title_page="Setting Nilai Evaluasi Kinerja Dosen";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname";
			$posisi=cariPosisi($batas, $hal);
			
			$sqld="SELECT * FROM $nama_table where ket_nilai like \"%$gname%\" and hapus=\"0\" ".
					"and kategori=\"$kategori\" order by batas_akhir desc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$batas_awal=@number_format($batas_awal, 2, ",", ".");
					$batas_akhir=@number_format($batas_akhir, 2, ",", ".");
					
					$edit="<a href=\"?pages=$pages&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"?pages=$pages&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$ket_nilai</td>
						<td>$batas_awal</td>
						<td>$batas_akhir</td>
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
						<td>Keterangan</td>
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
	    				<th>Keterangan</th>  
	    				<th>Batas Awal</th> 
	    				<th>Batas Akhir</th>
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
				
				$sqld="select * from $nama_table where id=\"$gid\"and hapus=\"0\" and kategori=\"$kategori\"";
				$data=mysql_query($sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					list($xthn1, $xthn2)=explode("/", $tahun_ajar);
					$batas_awal=@number_format($batas_awal, 2, ",", ".");
					$batas_akhir=@number_format($batas_akhir, 2, ",", ".");
					
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
							<td>Keterangan</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"ket_nilai\" value=\"$ket_nilai\" required />
							</td>
						</tr>
						<tr>
							<td>Nilai Batas Awal</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"batas_awal\" value=\"$batas_awal\" size=\"4\" required />
								ex: 10
							</td>
						</tr>
						<tr>
							<td>Nilai Batas Akhir</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"batas_akhir\" value=\"$batas_akhir\" size=\"4\" required />
								ex: 100
							</td>
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
			
			$ket_nilai=trim($ket_nilai);
			
			if($batas_awal>$batas_akhir){
				$error.="<h4 class=\"alert_warning\">Batas awal harus lebih kecil dari batas akhir</h4>";
			}
			
			if(empty($error)){
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and hapus=\"0\" and kategori=\"$kategori\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fket_nilai=$fdata["ket_nilai"];
						
						if($ket_nilai==$fket_nilai){
							$vdata="batas_awal=\"$batas_awal\", batas_akhir=\"$batas_akhir\", tgl_update=\"$ndatetime\"";
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
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					}
				}
				
				if($edit=="tambah"){
					$sqld="select * from $nama_table where ket_nilai=\"$ket_nilai\" and kategori=\"$kategori\" ".
							"and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="ket_nilai, batas_awal, batas_akhir, status, tgl_insert";
						$vvalue="\"$ket_nilai\", \"$batas_awal\", \"$batas_akhir\", \"1\", \"$ndatetime\"";
						
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
	}
	
}
?>