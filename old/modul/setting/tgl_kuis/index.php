<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="db_tgl_kuis";
	$nama_table2="db_kategori";
	
	$title_page="Data Tanggal Kuesioner";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname&gbase=$gbase&gp=$gp&gtanggal=$gtanggal";
			$posisi=cariPosisi($batas, $hal);
			
			if(!empty($gbase)){
				list($gbase1, $gbase2)=explode("/", $gbase);
				$selgbase.=" and tahun_ajar like \"$gbase1/%\"";
				
			}
			
			if(!empty($gp)){
				$selgbase.="and semester=\"$gp\"";
			}
			
			if(!empty($gtanggal)){
				$selgbase.=" and (tanggal_awal<=\"$gtanggal\" and tanggal_akhir>=\"$gtanggal\")";
			}
			
			$sqld="SELECT * FROM $nama_table where keterangan like \"%$gname%\" and status=\"0\" ".
					"$selgbase order by tanggal_akhir desc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$ftanggal1=TglFormat1($tanggal_awal);
					$ftanggal2=TglFormat1($tanggal_akhir);
					$nama_sem=SelSemester($semester, "semester", "1");
					$wkat="";
					
					$edit="<a href=\"?pages=$pages&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"?pages=$pages&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$subkat1=substr($id_kategori,1);
					$subkat2=substr($subkat1,0,-1);
					if($subkat2!=""){
						include"setting/kon.php";
						
						$sqld2="select * from $nama_table2 where id in ($subkat2) order by id asc";
						$data2=mysql_query($sqld2);
						$ndata2=mysql_num_rows($data2);
						if($ndata2>0){
							while($fdata2=mysql_fetch_assoc($data2)){
								$nama_katerogi=$fdata2["nama_kategori"];
								$wkat.="&bull; $nama_katerogi<br />";
							}
						}
					}
					
					
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$keterangan</td>
						<td>$ftanggal1 - $ftanggal2</td>
						<td>$tahun_ajar</td>
						<td>$nama_sem</td>
						<td>$wkat</td>
						<td>$edit $hapus</td>
					</tr>";
					
					$no++;
				}
			}
			
			include"setting/kon.php";
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
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gtanggal\" value=\"$gtanggal\" class='tanggal' /></td>
					</tr>
					<tr>
						<td>Tahun Akademik</td>
						<td>:</td>
						<td>".SelTahunMasuk($gbase, "gbase")."</td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td>".SelSemester($gp, "gp")."</td>
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
	    				<th>Tanggal Kuesioner</th> 
	    				<th>Tahun Akademik</th> 
	    				<th>Semester</th>
	    				<th>Kuesioner</th>
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
				
				$sqld="select * from $nama_table where id=\"$gid\"and status=\"0\"";
				$data=mysql_query($sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					list($xthn1, $xthn2)=explode("/", $tahun_ajar);
					
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
				$wkat="";
				$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" order by id asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					while($fdata2=mysql_fetch_assoc($data2)){
						$nama_katerogi=$fdata2["nama_kategori"];
						$idkat=$fdata2["id"];
						
						$sel1=(strstr($id_kategori, ",$idkat,"))? "checked=\"checked\"" : "";
						
						$wkat.="<input type=\"checkbox\" name=\"kategori_$idkat\" value=\"1\" $sel1 /> $nama_katerogi <br />";
					}
				}
				
				
				$cnpage="<form name=\"form1\" action=\"?pages=$pages&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Tahun Ajar</td>
							<td>:</td>
							<td>".SelTahunMasuk($tahun_ajar, "tahun_ajar", "required")."</td>
						</tr>
						<tr>
							<td>Semester Ajar</td>
							<td>:</td>
							<td>".SelSemester($semester, "semester", "", "required")."</td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"tanggal_awal\" value=\"$tanggal_awal\" class='tanggal' required /> s/d 
								<input type=\"text\" name=\"tanggal_akhir\" value=\"$tanggal_akhir\" class='tanggal' required />
							</td>
						</tr>
						<tr>
							<td valign='top'>Kuesioner</td>
							<td valign='top'>:</td>
							<td>$wkat</td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>:</td>
							<td><textarea name=\"keterangan\" cols=\"50\" rows=\"5\">$keterangan</textarea></td>
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
			
			if(empty($tahun_ajar)){
				$error.="<h4 class=\"alert_warning\">Tahun ajar masih kosong</h4>";
			}
			
			if(empty($semester)){
				$error.="<h4 class=\"alert_warning\">Semester masih kosong</h4>";
			}
			
			if($tanggal_awal>$tanggal_akhir){
				$error.="<h4 class=\"alert_warning\">Tahun awal harus lebih kecil dari tahun akhir</h4>";
			}
			
			if(empty($error)){
				$wkat="";
				$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" order by id asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					while($fdata2=mysql_fetch_assoc($data2)){
						$idkat=$fdata2["id"];
						$post_kat=$_POST["kategori_$idkat"];
						
						if($post_kat==1){
							$wkat.=",$idkat";
						}
					}
					
					$wkat=($wkat!="")? "$wkat," : "";
				}
				
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and status=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$ftahun_ajar=$fdata["tahun_ajar"];
						$fsemester=$fdata["semester"];
						
						if($tahun_ajar==$ftahun_ajar and $fsemester==$semester){
							$vdata="tanggal_awal=\"$tanggal_awal\", tanggal_akhir=\"$tanggal_akhir\", ";
							$vdata.="keterangan=\"$keterangan\", id_kategori=\"$wkat\", tgl_update=\"$ndatetime\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							$sqld="select * from $nama_table where tahun_ajar=\"$tahun_ajar\" and ".
									"semester=\"$semester\" and status=\"0\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="tanggal_awal=\"$tanggal_awal\", tanggal_akhir=\"$tanggal_akhir\", ";
								$vdata.="tahun_ajar=\"$tahun_ajar\", semester=\"$semester\", ";
								$vdata.="keterangan=\"$keterangan\", id_kategori=\"$wkat\", tgl_update=\"$ndatetime\"";
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
						
						CreateTable($tahun_ajar, $semester);
						
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					}
				}
				
				if($edit=="tambah"){
					$sqld="select * from $nama_table where tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" ".
							"and tanggal_awal=\"$tanggal_awal\" and tanggal_akhir=\"$tanggal_akhir\" and status=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="tanggal_awal, tanggal_akhir, tahun_ajar, semester, keterangan, id_kategori, ".
								"tgl_insert, status";
						$vvalue="\"$tanggal_awal\", \"$tanggal_akhir\", \"$tahun_ajar\", \"$semester\", ";
						$vvalue.="\"$keterangan\", \"$wkat\", \"$ndatetime\", \"0\"";
						
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
			
			$sqld="select * from $nama_table where id=\"$gid\" and status=\"0\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$vdata="status=\"1\", tgl_update=\"$ndatetime\"";
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
