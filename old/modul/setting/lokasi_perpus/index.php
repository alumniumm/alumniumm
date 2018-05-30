<?php 
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
$title_page="Lokasi Perpustakaan";
$nama_table="db_lokasi_perpus";



	switch($act){
	default:
	$link_page="?pages=$pages&gname=$gname";
			$posisi=cariPosisi($batas, $hal);
			
			$sqld="SELECT * FROM $nama_table where nama_perpus like \"%$gname%\" and hapus=\"0\" ".
					"order by nama_perpus asc";
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
						<td>$nama_perpus</td>
						<td>$alamat</td>
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
						<td>Nama Perpustakaan</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<table border='0' align='right' width='100%'>
			<tr>
			<td align='right'><input type=\"button\" value=\"Aktifasi Perpustakaan\" onclick=\"window.location.href='?pages=$pages&act=aktifasiperpus'\"/></td>
			</tr>
			</table>
			<div class=\"clear\"></div>
			<hr /><br />
			
			<a href=\"?pages=$pages&act=input&tab=tambah\" class=\"alt_btn\" >Tambah Data</a>
			<div class=\"clear\"></div><br />
			
			<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th>Nama Perpustakaan</th>
						<th>Alamat</th>  
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
	
	case"aktifasiperpus":
	$title_page ="Aktifasi Perpustakaan";
	include"setting/kon_baa.php";
	
	$qrf="SELECT * FROM in_fakultas";
	$data=mysql($neomaaref, $qrf);
	$hit = mysql_num_rows($data);
	if($hit){
		while ($fdat=mysql_fetch_array($data)){
		$fakultas = $fdat['namaFakultas'];
		$kode = $fdat['kode'];
		//$valFak = "2.$kode";
		include"setting/kon.php";
		$qcek ="SELECT * FROM db_aktifasi_perpus WHERE jenis_perpus=\"2\" and kode_perpus=\"$kode\" ";
		$hs = mysql_query($qcek);
		$hitcek = mysql_num_rows($hs);
		if($hitcek){
			$dd = mysql_fetch_array($hs);
			$stat = $dd['status'];
			if($stat == 1){$cek = "checked ";}else{$cek = "";}
		}else{
		$cek = "";
		}
		
				
		$tab .="<tr>
			<td></td><td><b>$fakultas</b></td>
			</tr>
			<tr>
			<td><input type='checkbox' value=\"$kode\" name=\"$kode\" $cek ></td><td>Perpustakaan Fakultas</td>
			</tr>";
		
		include"setting/kon_baa.php";
		$qrp="SELECT * FROM in_programstudi where kodeFakultas=\"$kode\" ";
		$data2=mysql($neomaaref, $qrp);
			while ($fdatp=mysql_fetch_array($data2)){
			$prodi = $fdatp['nama_depart'];
			$kodeP = $fdatp['kode'];
			//$valJur = "3.$kodeP";
			
			include"setting/kon.php";
		$qcek2 ="SELECT * FROM db_aktifasi_perpus WHERE jenis_perpus=\"3\" and kode_perpus=\"$kodeP\" ";
		$hs2 = mysql_query($qcek2);
		$hitcek2 = mysql_num_rows($hs2);
		if($hitcek2){
			$dd2 = mysql_fetch_array($hs2);
			$statp = $dd2['status'];
			if($statp == 1){$cek = "checked ";}else{$cek = "";}
		}else{
		$cek = "";
		}
			
			$tab .="<tr>
			<td><input type='checkbox' value=\"$kodeP\" name=\"$kodeP\" $cek ></td><td>Perpustakaan Program Studi $prodi</td>
			</tr>
			";
						
			}
			$tab .="<tr>
			<td><br></td><td></td>
			</tr>
			";
		}
	}
	
	$cnpage ="<form method='POST' action=\"?pages=$pages&act=aktif_proses\" ><table>
	$tab
	</table>
	<input type=\"submit\" value=\"Simpan\" >
	<input type=\"button\" value=\"Kembali\"  onclick=\"window.location.href='?pages=perpus' \">	
	</form>";
	
	break;
	
	case"aktif_proses":
	include"setting/kon_baa.php";
	$qrf="SELECT * FROM in_fakultas";
	$data=mysql($neomaaref, $qrf);
	$hit = mysql_num_rows($data);
	if($hit){
		while ($fdat=mysql_fetch_array($data)){
		$kode = $fdat['kode'];
		
		include"setting/kon.php";
		$qcek ="SELECT * FROM db_aktifasi_perpus WHERE jenis_perpus=\"2\" and kode_perpus=\"$kode\" ";
		$hs = mysql_query($qcek);
		$hitcek = mysql_num_rows($hs);
			if($hitcek==0){
				$fakultas = $_POST[$kode];
					if($kode == $fakultas){
					$qrin="INSERT INTO db_aktifasi_perpus (jenis_perpus,kode_perpus,status,tgl_update) VALUES (2,'$kode',1,now())";
					$hsl = mysql_query($qrin);
					}else{
					$qrin2="INSERT INTO db_aktifasi_perpus (jenis_perpus,kode_perpus,status,tgl_update) VALUES (2,'$kode',0,now())";
					$hsl = mysql_query($qrin2);
					}
			
			}else{
				$fakultas = $_POST[$kode];
				if($kode == $fakultas){
				$qrup="UPDATE db_aktifasi_perpus SET status=\"1\",tgl_update = now() WHERE jenis_perpus=\"2\" and kode_perpus=\"$kode\" ";
				$hsl = mysql_query($qrup);
				}else{
				$qrup2="UPDATE db_aktifasi_perpus SET status=\"0\",tgl_update = now() WHERE jenis_perpus=\"2\" and kode_perpus=\"$kode\" ";
				$hsl = mysql_query($qrup2);
				}
			}
			
				
		}
	}
	
	include"setting/kon_baa.php";
	$qrp="SELECT * FROM in_programstudi ";
	$data2=mysql($neomaaref, $qrp);
			while ($fdatp=mysql_fetch_array($data2)){
			$kodeP = $fdatp['kode'];
						
		include"setting/kon.php";
		$qcek2 ="SELECT * FROM db_aktifasi_perpus WHERE jenis_perpus=\"3\" and kode_perpus=\"$kodeP\" ";
		$hs2 = mysql_query($qcek2);
		$hitcek2 = mysql_num_rows($hs2);
		if($hitcek2 == 0){
			$jurusan = $_POST[$kodeP];
			if($kodeP == $jurusan){
			$qrin3="INSERT INTO db_aktifasi_perpus (jenis_perpus,kode_perpus,status,tgl_update) VALUES (3,'$kodeP',1,now())";
			$hsl = mysql_query($qrin3);
			}else{
			$qrin4="INSERT INTO db_aktifasi_perpus (jenis_perpus,kode_perpus,status,tgl_update) VALUES (3,'$kodeP',0,now())";
			$hsl = mysql_query($qrin4);
			}
		
		}else{
			$jurusan = $_POST[$kodeP];
			if($kodeP == $jurusan){
			$qrup3="UPDATE db_aktifasi_perpus SET status=\"1\",tgl_update = now() WHERE jenis_perpus=\"3\" and kode_perpus=\"$kodeP\" ";
			$hsl = mysql_query($qrup3);
			}else{
			$qrup4="UPDATE db_aktifasi_perpus SET status=\"0\",tgl_update = now() WHERE jenis_perpus=\"3\" and kode_perpus=\"$kodeP\" ";
			$hsl = mysql_query($qrup4);
			}
		}
		
	}
	
	$cnpage="<h4 class=\"alert_success\">Data Telah Disimpan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=perpus&act=aktifasiperpus'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=perpus&act=aktifasiperpus\">";
	
	break;
	
	case"input":
	if($tab=="tambah"){
		$title_page.=" &raquo; Tambah Data";
		$ndata=1;
				
	$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
	}
	
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
			
	if($ndata>0){
				$cnpage="<form name=\"form1\" action=\"?pages=$pages&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Nama Perpustakaan</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"nama_perpus\" value=\"$nama_perpus\" size=\"40\" required />
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"alamat\" value=\"$alamat\" size=\"50\" required />
							</td>
						</tr>
						<tr>
							<td>Kampus</td>
							<td>:</td>
							<td>".SelKampus($kampus,"kampus")."</td>
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
			
			$nama_perpus=trim($nama_perpus);
			$error.=($nama_perpus=="")? "<h4 class=\"alert_error\">Nama Perpus Kosong</h4>" : "";
			
			$alamat=trim($alamat);
			$error.=($alamat=="")? "<h4 class=\"alert_error\">Alamat Perpus Kosong</h4>" : "";
			
			
			
			if(empty($error)){
			if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fnama_perpus=$fdata["nama_perpus"];
						
						if($nama_perpus=="$fnama_perpus"){
							$vdata="status=\"$status\", tgl_insert=\"$ndatetime\", nama_perpus=\"$nama_perpus\" , alamat=\"$alamat\" ";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah </h4>";
							}
						}else{
							
							$sqld="select * from $nama_table where nama_perpus=\"$nama_perpus\" and hapus=\"0\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
							$vdata="status=\"$status\", tgl_insert=\"$ndatetime\", nama_perpus=\"$nama_perpus\" , alamat=\"$alamat\" ";
							$vvalue="id=\"$pid\"";
								
								$inp="update $nama_table set $vdata where $vvalue";
								$upd=mysql_query($inp);
								if($upd==1){
									$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah </h4>";
								}else{
									$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah </h4>";
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
					$kampus = $_POST['kampus'];
					if($kampus != " "){
					$sqld="select * from $nama_table where nama_perpus=\"$nama_perpus\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="nama_perpus, alamat, status, tgl_insert";
						$vvalue="\"$nama_perpus\", \"$alamat\" , \"$status\", \"$ndatetime\"";
						
						$inp="insert into $nama_table ($vdata) values ($vvalue)";
						//$upd=mysql_query($inp);
						if($upd==1){
							$cnpage="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
						}else{
							$cnpage="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
						
						}
						
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
					}
				  }else{$cnpage="<h4 class=\"alert_error\">Kampus belum diisi</h4>";}	
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
				$vdata="hapus=\"1\", tgl_insert=\"$ndatetime\"";
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