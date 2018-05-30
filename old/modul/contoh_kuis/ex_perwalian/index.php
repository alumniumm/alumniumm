<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
$title_page="Kuesioner Perwalian";
$nama_table="db_tahun_akademik";
$nama_table2="master_siswa";
$nama_table7="db_tgl_kuis";

switch($act){
default:
	if($ss_level==2){
		echo"<meta http-equiv=\"refresh\" content=\"0;url=?pages=$pages&act=proses\" />";
	}else{
		$sqlta="SELECT tahun_ajar FROM $nama_table where status=\"0\" order by tahun_ajar desc ";
		$hs=mysql_query($sqlta);
		$count=mysql_num_rows($hs);
		if($count){
			while($data = mysql_fetch_array($hs)){
				$option .="<option value=\"$data[tahun_ajar]\">$data[tahun_ajar]</option>"; 
			}
		}

		$cnpage.="<form name=\"form1\" action=\"?pages=cb-perwalian&act=proses\" method=\"post\">
			<table class='pad5'>
				<tr>
					<td>Masukan Nim :</td> 
					<td><input type=\"text\" name=\"nim\" value=\"$nim\" size=\"18\" /></td>
				</tr>
				<tr>
					<td>Tahun Akademik :</td> 
					<td>
					<select name=\"tahun\">
					<option value=\"\">-Pilih-</option>
					$option
					</select>
					</td>
				</tr>
			</table><br />
			<input type=\"submit\" name=\"proses\" value=\"Proses\" />
		</form>";
	}
break;

case"proses":

	if($ss_level==2){
		$link_back="?pages=home";
		$sqld="select * from $nama_table7 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
				"and status=\"0\" and id_kategori like \"%,2,%\"";
		
		$nim="$ss_user";
		$meta="";
		$link21="";
	}else{
		$link_back="?pages=$pages";
		$nim = $_POST['nim'];
		$TahunAkademik = $_POST['tahun'];
		
		$sqld="select * from $nama_table7 where tahun_ajar=\"$TahunAkademik\"";
		$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
		$link21="&gname=$gname&gbase=$gbase&gp=$gp";
	}
	
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$fdata=mysql_fetch_assoc($data);
		$TahunAkademik=$fdata["tahun_ajar"];
		$gp=$fdata["semester"];
		$nama = NamaMhs($nim);
		
		include"setting/kon_baa.php";
		$sqlkrs="SELECT * FROM transaksi_krs WHERE tahun_ajar = '$TahunAkademik' and kode_siswa='$nim' ";
		$hsqlkrs = mysql($neomaa, $sqlkrs);
		$hitkrs = mysql_num_rows($hsqlkrs);
		if($hitkrs){
			$sqljur="select * from $nama_table2 where kode_siswa=\"$nim\" ";
			$h = mysql_query($sqljur);
			$co = mysql_num_rows($h);

			$sq ="SELECT b.namaDosen,b.gelarLengkap,b.no_dosen  FROM transaksi_pembimbing a
			LEFT JOIN master_dosen b
			ON a.no_dosen = b.no_dosen
			WHERE a.kode_siswa =\"$nim\" ";
			$hsll = mysql_query($sq);
			$coi = mysql_num_rows($hsll);
			if($coi){
				$di = mysql_fetch_array($hsll); 
				$nama_dosen = $di["namaDosen"];
				$gelar_dosen = $di["gelarLengkap"];
				$no_dosen = $di["no_dosen"];
			}

			if($co){
				$d = mysql_fetch_array($h); 
				$jur = $d["ref_program_studi"]; 
				$prodi = NamaProdi($jur);
				$nama_prodi=$prodi["nama_depart"];
				$fakultas = $prodi["namaFakultas"];
			}
			
			$tableakhiran=str_replace("/", "_", $TahunAkademik);
			$table_name1="zdb_perwalian_$tableakhiran";
			include"setting/kon.php";	
			$qcektable ="SHOW TABLES FROM db_bkma WHERE Tables_in_db_bkma = '$table_name1'";
			$hacektable = mysql_query($qcektable);
			$hitcektable = mysql_num_rows($hacektable);

			if($hitcektable){
				$sqlceknim1="SELECT * FROM $table_name1 WHERE tahun_ajar='$TahunAkademik' and no_dosen= '$no_dosen' and nim='$nim' ";
				$hasilnim1 = mysql_query($sqlceknim1);
				$hitnim1 = mysql_num_rows($hasilnim1);
				if($hitnim1){
					$status="Sudah";
					$isikuesioner="<a href=\"?pages=cb-perwalian&act=edit_kuesioner&th=$TahunAkademik&ds=$no_dosen&nim=$nim&jur=$jur\" class=\"blink\">Edit Kuesioner</a>";
				}else{
					$status="Belum";
					$isikuesioner="<a href=\"?pages=cb-perwalian&act=isi_kuesioner&th=$TahunAkademik&ds=$no_dosen&nim=$nim&jur=$jur\" class=\"blink\">Isi Kuesioner</a>";
				}

			}else{
				$status="Belum";
				$isikuesioner="<a href=\"?pages=cb-perwalian&act=isi_kuesioner&th=$TahunAkademik&ds=$no_dosen&nim=$nim&jur=$jur\" class=\"blink\">Isi Kuesioner</a>";
			}

			$cnpage.="<table class='pad5'>
			<tr>
			<td>NIM</td><td>:</td><td>$nim</td>
			<td rowspan='3' width='100'></td>
			<td>Tahun Akademik</td><td>:</td><td>$TahunAkademik</td>
			</tr>
			<tr>
			<td>Nama</td><td>:</td><td>$nama</td>
			</tr>
			<tr>
			<td>Program Studi</td><td>:</td><td>$nama_prodi</td>
			</tr>
			</table> <hr>";


			$cnpage.="<table class='tablesorter'>
			<thead> 
			<tr>
			<th>Nama Dosen Wali</th><th width='200'>Status Kuisioner</th><th width='150'>Aksi</th>
			</tr>
			</thead> 
			<tbody>
			<td>$nama_dosen $gelar_dosen</td><td>$status</td><td>$isikuesioner</td>
			</tbody>
			</table><br>
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=cb-perwalian'\"/> ";
		}else{
			$cnpage="<h4 class=\"alert_success\">Mahasiswa tidak mengambil matakuliah aktif</h4>";

			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
		}
	}else{
		$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
		<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
		<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
	}
break;


case"isi_kuesioner":

$tab = $_GET['tab'];
$no_dosen = $_GET['ds'];
$id_jur = $_GET['jur'];
$nim = $_GET['nim'];
$TahunAkademik = $_GET['th'];
$nama = NamaMhs($nim);

$prodi = NamaProdi($id_jur);
$nama_prodi=$prodi["nama_depart"];
$fakultas = $prodi["namaFakultas"];

include"quis.php";

$cnpage.="<form name=\"form1\" action=\"?pages=cb-perwalian&act=proses_quis\" method=\"post\">
<input type=\"hidden\" name=\"no_dosen\" value=\"$no_dosen\" />
<input type=\"hidden\" name=\"nim\" value=\"$nim\" />
<input type=\"hidden\" name=\"id_jur\" value=\"$id_jur\" />
<input type=\"hidden\" name=\"akademik\" value=\"$TahunAkademik\" />


<table class='pad5'>
<tr>
<td>NIM</td><td>:</td><td>$nim</td>
<td rowspan='3' width='100'></td>
<td>Tahun Akademik</td><td>:</td><td>$TahunAkademik</td>
</tr>
<tr>
<td>Nama</td><td>:</td><td>$nama</td>
</tr>
<tr>
<td>Program Studi</td><td>:</td><td>$nama_prodi</td>
</tr>
</table> <hr><br>
$lop
<input type=\"submit\" name=\"submit\" value=\"Proses\" />
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=cb-perwalian'\"/>
</form>
";

break;

case"proses_quis":

$no_dosen= $_POST['no_dosen'];
$nim= $_POST['nim'];
$id_jur= $_POST['id_jur'];
$akademik= $_POST['akademik'];

$table_namelast=str_replace("/", "_", $akademik);
$table_name ="zdb_perwalian_$table_namelast";

$q ="SHOW TABLES FROM db_bkma WHERE Tables_in_db_bkma = '$table_name'";
$ha = mysql_query($q);
$cek = mysql_num_rows($ha);
if($cek){
$sqlceknim="SELECT * FROM $table_name WHERE tahun_ajar='$akademik' and no_dosen= '$no_dosen' and nim='$nim' ";
$hasilnim = mysql_query($sqlceknim);
$hitnim = mysql_num_rows($hasilnim);
if($hitnim < 1){
//Tabel Ada
$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $bag=$dat['id']; 
 
 	$sqltanya = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	
	$name ="cose-$bag-$id_tanya";
	
	$hasil = $_POST[$name];
	if($hasil==1){$isi_kurang_s=1; $isi_kurang=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==2){$isi_kurang=1; $isi_kurang_s=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==3){$isi_cukup=1; $isi_kurang=0; $isi_kurang_s=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==4){$isi_baik=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik_s=0;}
	if($hasil==5){$isi_baik_s=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik=0;}
	$val="tahun_ajar,bagian,id_pertanyaan,no_dosen,nim,prodi,isi_kurang_s,isi_kurang,isi_cukup,isi_baik,isi_baik_s,tanggal_insert";
	$vval="'$akademik','$bag','$id_tanya','$no_dosen','$nim','$id_jur','$isi_kurang_s','$isi_kurang','$isi_cukup','$isi_baik','$isi_baik_s',now()";
	
	$qinsert="INSERT INTO $table_name ($val) VALUES ($vval)";
	$hal = mysql_query($qinsert);
	if($hal==1){
		$cnpage="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
	}else{
		$cnpage="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
		}
		
	}}
  
 }
}

	}else{$cnpage="<h4 class=\"alert_error\">Data Sudah Ada</h4>";}
	$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
//End
}else{
//Table Belum Ada
$buat_table = CreateTable2($akademik);

$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $bag=$dat['id']; 
 
 	$sqltanya = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	
	$name ="cose-$bag-$id_tanya";
	
	$hasil = $_POST[$name];
	if($hasil==1){$isi_kurang_s=1; $isi_kurang=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==2){$isi_kurang=1; $isi_kurang_s=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==3){$isi_cukup=1; $isi_kurang=0; $isi_kurang_s=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==4){$isi_baik=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik_s=0;}
	if($hasil==5){$isi_baik_s=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik=0;}
	$val="tahun_ajar,bagian,id_pertanyaan,no_dosen,nim,prodi,isi_kurang_s,isi_kurang,isi_cukup,isi_baik,isi_baik_s,tanggal_insert";
	$vval="'$akademik','$bag','$id_tanya','$no_dosen','$nim','$id_jur','$isi_kurang_s','$isi_kurang','$isi_cukup','$isi_baik','$isi_baik_s',now()";
	
	$qinsert="INSERT INTO $table_name ($val) VALUES ($vval)";
	$hal = mysql_query($qinsert);
	if($hal==1){
		$cnpage="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
	}else{
		$cnpage="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
		}
	}}
  
 }
}

//End
 }
break;

case"edit_kuesioner":

$tab = $_GET['tab'];
$no_dosen = $_GET['ds'];
$id_jur = $_GET['jur'];
$nim = $_GET['nim'];
$TahunAkademik = $_GET['th'];
$nama = NamaMhs($nim);

$prodi = NamaProdi($id_jur);
$nama_prodi=$prodi["nama_depart"];
$fakultas = $prodi["namaFakultas"];

$lastnametable=str_replace("/", "_", $TahunAkademik);
$tablename ="zdb_perwalian_$lastnametable";

include"edit_quis.php";

$cnpage.="<form name=\"form1\" action=\"?pages=cb-perwalian&act=proses_editquis\" method=\"post\">
<input type=\"hidden\" name=\"no_dosen\" value=\"$no_dosen\" />
<input type=\"hidden\" name=\"nim\" value=\"$nim\" />
<input type=\"hidden\" name=\"id_jur\" value=\"$id_jur\" />
<input type=\"hidden\" name=\"akademik\" value=\"$TahunAkademik\" />


<table class='pad5'>
<tr>
<td>NIM</td><td>:</td><td>$nim</td>
<td rowspan='3' width='100'></td>
<td>Tahun Akademik</td><td>:</td><td>$TahunAkademik</td>
</tr>
<tr>
<td>Nama</td><td>:</td><td>$nama</td>
</tr>
<tr>
<td>Program Studi</td><td>:</td><td>$nama_prodi</td>
</tr>
</table> <hr><br>
$lop
<input type=\"submit\" name=\"submit\" value=\"Proses\" />
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=cb-perwalian'\"/>
</form>
";

break;

case"proses_editquis":

$no_dosen= $_POST['no_dosen'];
$nim= $_POST['nim'];
$id_jur= $_POST['id_jur'];
$akademik= $_POST['akademik'];

$table_namelast=str_replace("/", "_", $akademik);
$table_name ="zdb_perwalian_$table_namelast";

$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $bag=$dat['id']; 
 		 
 	$sqltanya = "SELECT a.id as id_new, a.tahun_ajar,a.bagian,a.id_pertanyaan,a.nim,a.prodi,a.isi_kurang_s,a.isi_kurang,a.isi_cukup,a.isi_baik,a.isi_baik_s, b.id,b.pertanyaan,b.bagian,b.urutan 
FROM $table_name a 
LEFT JOIN db_pertanyaan b 
ON a.id_pertanyaan = b.id 

	WHERE a.nim='$nim' and a.no_dosen='$no_dosen' and a.tahun_ajar = '$akademik' and b.bagian=\"$bag\" and b.hapus=\"0\" 	order by b.urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	$id_newtab = $dd['id_new'];
	$name ="cose-$bag-$id_tanya";
	
	$hasil = $_POST[$name];
	if($hasil==1){$isi_kurang_s=1; $isi_kurang=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==2){$isi_kurang=1; $isi_kurang_s=0; $isi_cukup=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==3){$isi_cukup=1; $isi_kurang=0; $isi_kurang_s=0; $isi_baik=0; $isi_baik_s=0;}
	if($hasil==4){$isi_baik=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik_s=0;}
	if($hasil==5){$isi_baik_s=1; $isi_kurang_s=0; $isi_kurang=0; $isi_cukup=0; $isi_baik=0;}
	
	$qup="UPDATE $table_name SET isi_kurang_s = '$isi_kurang_s',isi_kurang='$isi_kurang',isi_cukup='$isi_cukup',isi_baik='$isi_baik',isi_baik_s='$isi_baik_s' WHERE id='$id_newtab'  ";
	$upquis = mysql_query($qup);
	if($upquis==1){
	$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
	}else{
	$cnpage="<h4 class=\"alert_success\">Data Gagal Dirubah</h4>";
	}
	
	$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
	
	}
}

}}


break;

}}
?>

