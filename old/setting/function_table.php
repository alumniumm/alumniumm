<?php
function CreateTable($tahun_ajar, $semester){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_kuis_"."$table"."_"."$semester";
	
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="semester int(11) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="no_dosen int(11) NOT NULL,";
	$tbl_SQL .="nim varchar(20) NOT NULL,";
	$tbl_SQL .="prodi varchar(3) NOT NULL,";
	$tbl_SQL .="isi_kurang_s int(1) NOT NULL,";
	$tbl_SQL .="isi_kurang int(1) NOT NULL,";
	$tbl_SQL .="isi_baik int(1) NOT NULL,";
	$tbl_SQL .="isi_baik_s int(1) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL2 .= "COMMENT='Tabel Ev. Pemb. Dosen $tahun_ajar $semester'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	return $kuis_table;
}

function CreateTableZperpus($tahun_ajar, $semester){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_perpustakaan_"."$table"."_"."$semester";
	$kuis_table_saran="$kuis_table"."_saran";
	
	#create table kuesioner perpus
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="semester int(11) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="nim varchar(20) NOT NULL,";
	$tbl_SQL .="jenis_perpus int(11) NOT NULL,";
	$tbl_SQL .="id_perpus int(11) NOT NULL,";
	$tbl_SQL .="prodi varchar(3) NOT NULL,";
	$tbl_SQL .="isi_kurang_s int(1) NOT NULL,";
	$tbl_SQL .="isi_kurang int(1) NOT NULL,";
	$tbl_SQL .="isi_baik int(1) NOT NULL,";
	$tbl_SQL .="isi_baik_s int(1) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL .= "COMMENT='Tabel Kuis Perpus $tahun_ajar $semester'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	#create table saran perpus
	$tbl_SQL2 .= "CREATE TABLE $kuis_table_saran ( ";
	$tbl_SQL2 .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL2 .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL2 .="semester int(11) NOT NULL,";
	$tbl_SQL2 .="nim varchar(20) NOT NULL,";
	$tbl_SQL2 .="prodi varchar(3) NOT NULL,";
	$tbl_SQL2 .="jenis_perpus int(11) NOT NULL,";
	$tbl_SQL2 .="id_perpus int(11) NOT NULL,";
	$tbl_SQL2 .="saran text NOT NULL,";
	$tbl_SQL2 .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL2 .="PRIMARY KEY (id)";
	$tbl_SQL2 .= ") TYPE=MyISAM ";
	$tbl_SQL2 .= "COMMENT='Tabel Kuis Perpus $tahun_ajar $semester Saran'";
	
	$sqld2="select * from $kuis_table_saran limit 1";
	if(!mysql_query($sqld2)){
		@mysql_query($tbl_SQL2);
	}
	
	return $kuis_table;
}

function CreateTableTA($tahun_ajar, $semester){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_ta_"."$table"."_"."$semester";
	$kuis_table_saran="$kuis_table"."_saran";
	
	#create table kuesioner ta
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="semester int(11) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="no_dosen int(11) NOT NULL,";
	$tbl_SQL .="pembimbing int(1) NOT NULL,";
	$tbl_SQL .="nim varchar(20) NOT NULL,";
	$tbl_SQL .="prodi varchar(3) NOT NULL,";
	$tbl_SQL .="isi_kurang_s int(1) NOT NULL,";
	$tbl_SQL .="isi_kurang int(1) NOT NULL,";
	$tbl_SQL .="isi_baik int(1) NOT NULL,";
	$tbl_SQL .="isi_baik_s int(1) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL .= "COMMENT='Tabel Kuis TA $tahun_ajar $semester'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	#create table saran ta
	$tbl_SQL2 .= "CREATE TABLE $kuis_table_saran ( ";
	$tbl_SQL2 .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL2 .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL2 .="semester int(11) NOT NULL,";
	$tbl_SQL2 .="no_dosen int(11) NOT NULL,";
	$tbl_SQL2 .="pembimbing int(1) NOT NULL,";
	$tbl_SQL2 .="nim varchar(20) NOT NULL,";
	$tbl_SQL2 .="prodi varchar(3) NOT NULL,";
	$tbl_SQL2 .="saran text NOT NULL,";
	$tbl_SQL2 .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL2 .="PRIMARY KEY (id)";
	$tbl_SQL2 .= ") TYPE=MyISAM ";
	$tbl_SQL2 .= "COMMENT='Tabel Kuis TA $tahun_ajar $semester Saran'";
	
	$sqld2="select * from $kuis_table_saran limit 1";
	if(!mysql_query($sqld2)){
		@mysql_query($tbl_SQL2);
	}
	
	return $kuis_table;
}

function CreateTableProdi($tahun_ajar){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_prodi_"."$table";
	
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="prodi varchar(3) NOT NULL,";
	$tbl_SQL .="isi_standart varchar(50) NOT NULL,";
	$tbl_SQL .="isi_standart2 varchar(50) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL .= "COMMENT='Tabel Kinerja Program Studi $tahun_ajar'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	return $kuis_table;
}

function CreateTableKdosen($tahun_ajar){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_kdosen_"."$table";
	
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="id_dosen varchar(11) NOT NULL,";
	$tbl_SQL .="isi_standart varchar(50) NOT NULL,";
	$tbl_SQL .="isi_standart2 varchar(50) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL .= "COMMENT='Tabel Ev. Kinerja Dosen $tahun_ajar'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	return $kuis_table;
}

function CreateTableLab($tahun_ajar){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_lab_"."$table";
	
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="id_lab varchar(3) NOT NULL,";
	$tbl_SQL .="isi_standart varchar(50) NOT NULL,";
	$tbl_SQL .="isi_standart2 varchar(50) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM ";
	$tbl_SQL .= "COMMENT='Tabel Ev. Kinerja Lab $tahun_ajar'";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	return $kuis_table;
}

function CekKuis($gbase, $gp, $kode_siswa, $no_dosen, $id=""){
	include"kon.php";
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_kuis_"."$table"."_"."$gp";
	
	if(!empty($id)){
		list($id_bagian, $idp)=explode("#", $id);
		$where="and bagian=\"$id_bagian\" and id_pertanyaan=\"$idp\"";
	}else{
		$where="";
	}
	
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" and nim=\"$kode_siswa\" ".
			"and no_dosen=\"$no_dosen\" $where limit 1";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	
	if($ndata>0){
		if(!empty($id)){
			$list=array();
			
			$fdata=mysql_fetch_assoc($data);
			extract($fdata);
			
			$list["ck1"]="$isi_kurang_s";
			$list["ck2"]="$isi_kurang";
			$list["ck3"]="$isi_baik";
			$list["ck4"]="$isi_baik_s";
			
		}else{
			$list=$ndata;
		}
	}else{
		$list=$ndata;
	}
	
	return $list;
}


function CekKuisTA($gbase, $gp, $kode_siswa, $no_dosen, $id=""){
	include"kon.php";
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_ta";
	
	if(!empty($id)){
		list($id_bagian, $idp)=explode("#", $id);
		$where="and bagian=\"$id_bagian\" and id_pertanyaan=\"$idp\"";
	}else{
		$where="";
	}
	
	$sqld="select * from $nama_table where nim=\"$kode_siswa\" and no_dosen=\"$no_dosen\" $where limit 1";
	$data=@mysql_query($sqld);
	$ndata=@mysql_num_rows($data);
	
	if($ndata>0){
		if(!empty($id)){
			$list=array();
			
			$fdata=mysql_fetch_assoc($data);
			extract($fdata);
			
			$list["ck1"]="$isi_kurang_s";
			$list["ck2"]="$isi_kurang";
			$list["ck3"]="$isi_baik";
			$list["ck4"]="$isi_baik_s";
			
		}else{
			$list=$ndata;
		}
	}else{
		$list=$ndata;
	}
	
	return $list;
}

function CekKuisProdi($gbase, $gid, $idkat){
	include"kon.php";
	
	if($idkat=="1"){
		$nm_tbl="zdb_prodi_";
		$wprod="prodi";
	}
	
	if($idkat=="2"){
		$nm_tbl="zdb_kdosen_";
		$wprod="id_dosen";
	}
	
	if($idkat=="3"){
		$nm_tbl="zdb_lab_";
		$wprod="id_lab";
	}
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="$nm_tbl"."$table";
	
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and $wprod=\"$gid\" limit 1";
	$data=@mysql_query($sqld);
	$ndata=@mysql_num_rows($data);
	
	return $ndata;
}

function CekKuisProdiData($gbase, $gid, $gname, $id, $jenis, $idp, $ket, $idkat){
	include"kon.php";
	
	if($idkat=="1"){
		$nm_tbl="zdb_prodi_";
		$wprod="prodi";
	}
	
	if($idkat=="2"){
		$nm_tbl="zdb_kdosen_";
		$wprod="id_dosen";
	}
	
	if($idkat=="3"){
		$nm_tbl="zdb_lab_";
		$wprod="id_lab";
	}
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="$nm_tbl"."$table";
	$var=",2,,5,,6,7,,8,";
	list($ket1, $ket2)=explode("/",$ket);
	list($id_bagian, $id_pert)=explode("#", $id);
	$gname="$gname"."_$id_bagian"."_$id_pert";
	
	$sqld="select a.*, b.pertanyaan from $nama_table as a left join db_pertanyaan as b on a.id_pertanyaan=b.id ".
			"where a.tahun_ajar=\"$gbase\" and a.$wprod=\"$gid\" and a.bagian=\"$id_bagian\" and ".
			"a.id_pertanyaan=\"$id_pert\" limit 1";
	$data=@mysql_query($sqld);
	$fdata=@mysql_fetch_assoc($data);
	@extract($fdata);
	
	$list=JenisInputan($jenis, $isi_standart, $isi_standart2, "", "required", $gname)." $ket";
	
	return $list;
}

function CekKuisProdiArray($gbase, $gid, $id_bagian, $id_pert, $idkat){
	include"kon.php";
	
	if($idkat=="1"){
		$nm_tbl="zdb_prodi_";
		$wprod="prodi";
	}
	
	if($idkat=="2"){
		$nm_tbl="zdb_kdosen_";
		$wprod="id_dosen";
	}
	
	if($idkat=="3"){
		$nm_tbl="zdb_lab_";
		$wprod="id_lab";
	}
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="$nm_tbl"."$table";
	
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and $wprod=\"$gid\" and bagian=\"$id_bagian\" ".
			"and id_pertanyaan=\"$id_pert\" limit 1";
	$data=@mysql_query($sqld);
	$fdata=@mysql_fetch_assoc($data);
	
	return $fdata;
}

function CekKuisProdiHasil($gbase, $gid, $id, $jenis, $idp, $ket, $simbol, $standart, $standart2, $idkat){
	include"kon.php";
	$list=array();
	
	if($idkat=="1"){
		$nm_tbl="zdb_prodi_";
		$wprod="prodi";
	}
	
	if($idkat=="2"){
		$nm_tbl="zdb_kdosen_";
		$wprod="id_dosen";
	}
	
	if($idkat=="3"){
		$nm_tbl="zdb_lab_";
		$wprod="id_lab";
	}
	
	$hasil_m="M";
	$hasil_bm="BM";
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="$nm_tbl"."$table";

	list($ket1, $ket2)=explode("/",$ket);
	list($id_bagian, $id_pert)=explode("#", $id);
	$gname="$gname"."_$id_bagian"."_$id_pert";
	
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and $wprod=\"$gid\" and bagian=\"$id_bagian\" ".
			"and id_pertanyaan=\"$id_pert\" limit 1";
	$data=@mysql_query($sqld);
	$ndata=@mysql_num_rows($data);
	if($ndata>0){
		$fdata=@mysql_fetch_assoc($data);
		@extract($fdata);
		
		$hsl=KetJenisInputan($jenis, $ket, $isi_standart, $isi_standart2);
		$jsimbol=$hsl["jsimbol"];
		$hasil=$hsl["hasil"];
		
		if($jenis==3){
			$kat=($standart<=$isi_standart and $standart2>=$isi_standart)? "$hasil_m" : "$hasil_bm";
			$hasil="$isi_standart $ket";
		}elseif($jenis==9){
			$st1=($standart==$isi_standart)? "1" : "";
			$st2=($standart2<=$isi_standart2)? "1" : "";
			
			$kat=($st1==1 and $st2==1)? "$hasil_m" : "$hasil_bm";
		}else{
			if($jsimbol==">"){
				$kat=($isi_standart > $standart)? "$hasil_m" : "$hasil_bm";
			}
			
			if($jsimbol=="<"){
				$kat=($isi_standart < $standart)? "$hasil_m" : "$hasil_bm";
			}
			
			if($jsimbol==">="){
				$kat=($isi_standart >= $standart)? "$hasil_m" : "$hasil_bm";
			}
			
			if($jsimbol=="<="){
				$kat=($isi_standart <= $standart)? "$hasil_m" : "$hasil_bm";
			}
			
			if($jsimbol=="="){
				$kat=($isi_standart == $standart)? "$hasil_m" : "$hasil_bm";
			}
		}
	}
	
	$list["hsl"]="$hasil";
	$list["kat"]="$kat";
	
	return $list;
}

function CekKuisLab($gbase, $gid, $idkat){
	include"kon.php";
	$kategori=7;
	$list=array();
	
	$sqld2="select * from db_bagian where hapus=\"0\" and status=\"1\" and kategori=\"$kategori\" ".
			"order by urutan asc";
	$data2=mysql_query($sqld2);
	$ndata2=mysql_num_rows($data2);
	if($ndata2>0){
		while($fdata2=mysql_fetch_assoc($data2)){
			$id_bagian=$fdata2["id"];
			$nama_bagian=$fdata2["bagian"];
			
			$sqld3="select * from db_pertanyaan where hapus=\"0\" and status=\"1\" ".
					"and bagian=\"$id_bagian\" order by urutan asc";
			$data3=mysql_query($sqld3);
			$ndata3=mysql_num_rows($data3);
			if($ndata3>0){ $no=1;
				while($fdata3=mysql_fetch_assoc($data3)){
					extract($fdata3);
					
					$ket_sk=KetJenisInputan($jenis, $keterangan, $standart, $standart2);
					$ck_ket=$ket_sk["ket"];
					
					$hsl=CekKuisProdiHasil($gbase, $gid, "$id_bagian#$id", $jenis, $id_pertanyaan, $keterangan, $simbol, $standart, $standart2, $idkat);
					$ck=$hsl["hsl"];
					$kat=$hsl["kat"];
					
					if($kat=="M"){
						$no2=$no2 + 1;
					}
					
					$no++; $no3++;
				}
			}
		}
		
		$phasil=($no2/$no3) * 100;
		$phasil=round($phasil,2);
		$ket_hasil=Nilai($phasil, $kategori);
	}
	
	$list["nilai"]="$phasil";
	$list["ket_nilai"]="$ket_hasil";
	
	return $list;
}

//TABLE2@Bn
function CreateTable2($tahun_ajar){
	include"kon.php";
	
	$table=str_replace("/", "_", $tahun_ajar);
	$kuis_table="zdb_perwalian_"."$table";
	
	$tbl_SQL .= "CREATE TABLE $kuis_table ( ";
	$tbl_SQL .="id int(11) NOT NULL AUTO_INCREMENT,";
	$tbl_SQL .="tahun_ajar varchar(10) NOT NULL,";
	$tbl_SQL .="bagian int(11) NOT NULL,";
	$tbl_SQL .="id_pertanyaan int(11) NOT NULL,";
	$tbl_SQL .="no_dosen int(11) NOT NULL,";
	$tbl_SQL .="nim varchar(20) NOT NULL,";
	$tbl_SQL .="prodi varchar(3) NOT NULL,";
	$tbl_SQL .="isi_kurang_s int(1) NOT NULL,";
	$tbl_SQL .="isi_kurang int(1) NOT NULL,";
	$tbl_SQL .="isi_cukup int(1) NOT NULL,";
	$tbl_SQL .="isi_baik int(1) NOT NULL,";
	$tbl_SQL .="isi_baik_s int(1) NOT NULL,";
	$tbl_SQL .="tanggal_insert datetime NOT NULL,";
	$tbl_SQL .="PRIMARY KEY (id)";
	$tbl_SQL .= ") TYPE=MyISAM";
	
	$sqld="select * from $kuis_table limit 1";
	if(!mysql_query($sqld)){
		@mysql_query($tbl_SQL);
	}
	
	return $kuis_table;
}

//Rata Nilai Fakultas
function HitKuesioner($kodeFakultas,$tableN){
	include"kon_baa.php";
	
$qr="SELECT kode FROM in_programstudi b
WHERE b.kodeFakultas = '$kodeFakultas'";

$hh = mysql($neomaaref, $qr);
$d = mysql_num_rows($hh);	

if($d > 0){
while($di = mysql_fetch_array($hh)){
$kodeJur=$di['kode'];

include"kon.php";

$qy="SELECT count(a.id_pertanyaan) as jml,a.id_pertanyaan,a.bagian,a.prodi, sum(a.isi_baik) as isibaik, sum(a.isi_baik_s) as baiksekali,sum(a.isi_cukup) as cukup, sum(a.isi_kurang) as kurang, sum(a.isi_kurang_s) as kurangsekali
FROM $tableN a WHERE a.prodi ='$kodeJur' ";

$hasqy = mysql_query($qy);
$cekJum = mysql_num_rows($hasqy);
	if($cekJum){
		while($diRep = mysql_fetch_array($hasqy)){
		
		$jml=$diRep['jml'];
		$isibaik = $diRep['isibaik'];
		$baiksekali = $diRep['baiksekali'];
		$cukup = $diRep['cukup'];
		$kurang = $diRep['kurang'];
		$kurangsekali = $diRep['kurangsekali'];
		
		$tot_quis1 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
		$tot_quis= ($tot_quis1!=0)?($tot_quis1/$jml):0;
		$total = round($tot_quis,2); 

		return $total;
		
		}
	}



		}
	}

}

//Rata Nilai Jurusan
function HitKuesioner2($kodeJurusan,$tableN){
include"kon.php";
	
$qr="SELECT count(a.id_pertanyaan) as jml,a.id_pertanyaan,a.bagian,a.prodi, sum(a.isi_baik) as isibaik, sum(a.isi_baik_s) as baiksekali,sum(a.isi_cukup) as cukup, sum(a.isi_kurang) as kurang, sum(a.isi_kurang_s) as kurangsekali
FROM $tableN a
WHERE a.prodi = '$kodeJurusan'";

$hh = mysql_query($qr);
$d = mysql_num_rows($hh);	

if($d > 0){
while($di = mysql_fetch_assoc($hh)){
$jml=$di['jml'];
$isibaik = $di['isibaik'];
$baiksekali = $di['baiksekali'];
$cukup = $di['cukup'];
$kurang = $di['kurang'];
$kurangsekali = $di['kurangsekali'];

$tot_quis1 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
$tot_quis= ($tot_quis1!=0)?($tot_quis1/$jml):0;
$total = round($tot_quis,2); 

return $total;
		}
	}

}
//Rata Nilai Dosen tiap jurusan
function HitKuesionerDosen2($kodeDosen,$prodi,$tableN){
include"kon.php";
	
$qr="SELECT count(a.id_pertanyaan) as jml,a.id_pertanyaan,a.bagian,a.prodi, sum(a.isi_baik) as isibaik, sum(a.isi_baik_s) as baiksekali,sum(a.isi_cukup) as cukup, sum(a.isi_kurang) as kurang, sum(a.isi_kurang_s) as kurangsekali
FROM $tableN a
WHERE a.no_dosen = '$kodeDosen' and a.prodi = '$prodi'  ";

$hh = mysql_query($qr);
$d = mysql_num_rows($hh);	

if($d > 0){
while($di = mysql_fetch_assoc($hh)){
$jml=$di['jml'];
$isibaik = $di['isibaik'];
$baiksekali = $di['baiksekali'];
$cukup = $di['cukup'];
$kurang = $di['kurang'];
$kurangsekali = $di['kurangsekali'];

$tot_quis1 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
$tot_quis= ($tot_quis1!=0)?($tot_quis1/$jml):0;
$total = round($tot_quis,2); 

return $total;
		}
	}

}

//Rata tiap dosen per pertanyaan tiap jurusan
function HitKuesionerDosen($kodeDosen,$idtanya,$prodi,$tableN){
include"kon.php";
	
$qr="SELECT count(a.id_pertanyaan) as jml,a.id_pertanyaan,a.bagian,a.prodi, sum(a.isi_baik) as isibaik, sum(a.isi_baik_s) as baiksekali,sum(a.isi_cukup) as cukup, sum(a.isi_kurang) as kurang, sum(a.isi_kurang_s) as kurangsekali
FROM $tableN a
WHERE a.no_dosen = '$kodeDosen' and a.prodi = '$prodi' and a.id_pertanyaan = '$idtanya' ";

$hh = mysql_query($qr);
$d = mysql_num_rows($hh);	

if($d > 0){
while($di = mysql_fetch_assoc($hh)){
$jml=$di['jml'];
$isibaik = $di['isibaik'];
$baiksekali = $di['baiksekali'];
$cukup = $di['cukup'];
$kurang = $di['kurang'];
$kurangsekali = $di['kurangsekali'];

$tot_quis1 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
$tot_quis= ($tot_quis1!=0)?($tot_quis1/$jml):0;

$total = round($tot_quis,2);
return $total;
		}
	}

}

//Rata bagian pertanyaan tiap dosen
function HitRataDosen($bagian,$dosen,$db){
include"kon.php";

$qy = "SELECT count(id) as jml, sum(isi_baik_s) as isi_baik_s, sum(isi_baik) as isi_baik, sum(isi_cukup) as isi_cukup, sum(isi_kurang) as isi_kurang, sum(isi_kurang_s) as isi_kurang_s
FROM $db a
WHERE a.bagian = '$bagian' and a.no_dosen = '$dosen'";

$hs = mysql_query($qy);
$da = mysql_num_rows($hs);	
if($da > 0){
while($d = mysql_fetch_assoc($hs)){

$jml=$d['jml'];
$isibaik = $d['isi_baik'];
$baiksekali = $d['isi_baik_s'];
$cukup = $d['isi_cukup'];
$kurang = $d['isi_kurang'];
$kurangsekali = $d['isi_kurang_s'];

$tot_quis2 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
$tot_quis= ($tot_quis2!=0)?($tot_quis2/$jml):0;
$total = round($tot_quis,2);
return $total;
		}
	}
}


function HitRataDosenJur($bagian,$jurusan,$db){
include"kon.php";

$qy = "SELECT count(id) as jml, sum(isi_baik_s) as isi_baik_s, sum(isi_baik) as isi_baik, sum(isi_cukup) as isi_cukup, sum(isi_kurang) as isi_kurang, sum(isi_kurang_s) as isi_kurang_s
FROM $db a
WHERE a.bagian = '$bagian' and a.prodi = '$jurusan'";

$hs = mysql_query($qy);
$da = mysql_num_rows($hs);	
if($da > 0){
while($d = mysql_fetch_assoc($hs)){

$jml=$d['jml'];
$isibaik = $d['isi_baik'];
$baiksekali = $d['isi_baik_s'];
$cukup = $d['isi_cukup'];
$kurang = $d['isi_kurang'];
$kurangsekali = $d['isi_kurang_s'];

$tot_quis2 = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
$tot_quis= ($tot_quis2!=0)?($tot_quis2/$jml):0;
$total = round($tot_quis,2);
return $total;

		}
	}
}

function HitResponden($nim,$id_soal,$db){

$sqlT = "SELECT  b.nim, b.isi_baik,b.isi_baik_s,b.isi_cukup,b.isi_kurang,b.isi_kurang_s  
FROM $db b
WHERE b.nim = '$nim' and b.id_pertanyaan='$id_soal' ";
$hsq = mysql_query($sqlT);
$hitq = mysql_num_rows($hsq);
	if($hitq){
	while($dq = mysql_fetch_array($hsq)){
	
	$isibaik = $dq['isi_baik'];
	$baiksekali = $dq['isi_baik_s'];
	$cukup = $dq['isi_cukup'];
	$kurang = $dq['isi_kurang'];
	$kurangsekali = $dq['isi_kurang_s'];
	
	$tot_quis = ($baiksekali * 5)+($isibaik * 4)+($cukup * 3)+($kurang * 2)+($kurangsekali * 1);
	$total = round($tot_quis,2);
	return $total;

	}
								
	}
}

//CEK Kuisioner jenisperpus
function CekPerpusKuisioner($tahun,$semester,$nim,$id_perpus,$jenis){
$TAkademik = str_replace("/","_",$tahun);
$tablename="zdb_perpustakaan_"."$TAkademik"."_"."$semester";
include"kon.php";

$qcektable ="SHOW TABLES FROM db_bkma WHERE Tables_in_db_bkma = '$tablename'";
$hacektable = mysql_query($qcektable);
$hitcektable = mysql_num_rows($hacektable);
$ket1="Sudah"; $ket2="Belum";
	if($hitcektable){
		$q="SELECT * FROM  $tablename WHERE nim=\"$nim\" and jenis_perpus=\"$jenis\" and id_perpus=\"$id_perpus\" ";
		$hasil = mysql_query($q);
		$hit = mysql_num_rows($hasil);
			if($hit){
			return $ket1;
			}else{return $ket2;}
	}else{
	return $ket2;}

}

function CekTablePerpus($tahun,$semester){
$TAkademik = str_replace("/","_",$tahun);
$tablename="zdb_perpustakaan_"."$TAkademik"."_"."$semester";
include"kon.php";

$qcektable ="SHOW TABLES FROM db_bkma WHERE Tables_in_db_bkma = '$tablename'";
$hacektable = mysql_query($qcektable);
$hitcektable = mysql_num_rows($hacektable);
	if($hitcektable){
	return 1;
	}else{return 0;}
}

//EditFunction Perpus
function CekPerpus($kuis_table, $nim, $tahun_ajar, $sem,$JPerpus,$IDperpus){
	include"kon.php";
	$list=array();
	
	$sqld2="select * from $kuis_table where nim=\"$nim\" and tahun_ajar=\"$tahun_ajar\" ".
			"and semester=\"$sem\" and jenis_perpus=\"$JPerpus\" and id_perpus=\"$IDperpus\" ";
	$data2=mysql_query($sqld2);
	$ndata2=mysql_num_rows($data2);
	if($ndata2>0){
		while($fdata2=mysql_fetch_assoc($data2)){
			extract($fdata2);
			
			if($isi_kurang_s==1){
				$fd=1;
			}
			elseif($isi_kurang==1){
				$fd=2;
			}
			elseif($isi_baik==1){
				$fd=3;
			}
			elseif($isi_baik_s==1){
				$fd=4;
			}
			
			$fd_nama="$bagian"."$id_pertanyaan";
			$list["$fd_nama"]="$fd";
		}
	}
	
	return $list;
}

?>
