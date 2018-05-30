<?php
session_start();
$ss_user=$_SESSION["ss_user"];
$ss_pwd=$_SESSION["ss_pwd"];
$ss_nama=$_SESSION["ss_nama"];
$ss_level=$_SESSION["ss_level"];
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SIM - Badan Kendali Mutu Akademik | UMM</title>

<style>
	@page A4{
		size: 8.27in 11.69in !important;
	}
	
	@media print{
		.disnon{
			display: none;
		}
		
		body{
			margin:10px 10px 10px 30px!important;
			width:100% !important;
			float:left !important;
		}
	}
	
	@page{
		margin:10px 10px 10px 30px!important;
		size:A4 Landscape !important;
		float:left;
	}
	
	body{
		font-size:12px;
	}
	
	h2{
		font-size:14px;
		line-height:2px;
		text-align: center;
		text-transform: uppercase;
	}
	
	table.border{
		border:1px solid #000000;
		border-collapse: collapse;
		font-size:8px;
		margin:0;
	}
	
	table.border th{
		font-weight: bold;
		border:1px solid #000000;
		margin:0;
		padding:0px 3px;
	}
	
	table.border td{
		border:1px solid #000000;
		margin:0;
		padding:0px 3px;
	}
	
	.font7{
		font-size:7px;
	}
	
</style>

</head>
<body>

<?php
if(empty($ss_user) or empty($ss_pwd)){
	echo"<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$locate="../../..";
	$r=1;
		
	include"$locate/setting/kon.php";
	include"$locate/setting/function.php";
	include"$locate/setting/variable.php";
	
	extract($_GET);
	$v=($v>1)? "$v" : "1";
	
	$non="class=\"disnon\"";
	$link_back="$locate/home.php?pages=kd-tugas-akhir&act=data&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gcetak=$gcetak";
	
	$link_back2="?gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$gid&gdid=$gdid&gcetak=$gcetak";
	
	echo"<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"Cetak\" onclick=\"window.print()\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V1\" onclick=\"window.location.href='$link_back2&v=1'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V2\" onclick=\"window.location.href='$link_back2&v=2'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V3\" onclick=\"window.location.href='$link_back2&v=3'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V4\" onclick=\"window.location.href='$link_back2&v=4'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V5\" onclick=\"window.location.href='$link_back2&v=5'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V6\" onclick=\"window.location.href='$link_back2&v=6'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V7\" onclick=\"window.location.href='$link_back2&v=7'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V8\" onclick=\"window.location.href='$link_back2&v=8'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V9\" onclick=\"window.location.href='$link_back2&v=9'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V10\" onclick=\"window.location.href='$link_back2&v=10'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V11\" onclick=\"window.location.href='$link_back2&v=11'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V12\" onclick=\"window.location.href='$link_back2&v=12'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V13\" onclick=\"window.location.href='$link_back2&v=13'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V14\" onclick=\"window.location.href='$link_back2&v=14'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V15\" onclick=\"window.location.href='$link_back2&v=15'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V16\" onclick=\"window.location.href='$link_back2&v=16'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V17\" onclick=\"window.location.href='$link_back2&v=17'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V18\" onclick=\"window.location.href='$link_back2&v=18'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V19\" onclick=\"window.location.href='$link_back2&v=19'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V20\" onclick=\"window.location.href='$link_back2&v=20'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V21\" onclick=\"window.location.href='$link_back2&v=21'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"V22\" onclick=\"window.location.href='$link_back2&v=22'\" $non/>";
	
	
	$nama_table="zdb_ta";
	$nama_table2="db_bagian";
	$nama_table3="db_pertanyaan";
	$nama_table4="master_siswa_wisuda";
	
	$noth="";
	$kategori="4";
	
	$error="";
	$error.=(empty($gbase))? "<h4 class=\"alert_warning\">Tahun Wisuda Awal Belum Disi</h4>" : "";
	$error.=(empty($gp))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
	$error.=(empty($gtahun))? "<h4 class=\"alert_warning\">Tahun Wisuda Akhir Belum Disi</h4>" : "";
	$error.=(empty($gtanggal))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
	
	if(empty($error)){
		$nama_dosen=NamaDosen($gid);
		$xprodi=NamaProdi($gdid);
		
		$nama_prodi=$xprodi["nama_depart"];
		$nama_fak=$xprodi["namaFakultas"];
		
		if($gtahun=="$gbase" and $gtanggal=="$gp"){
			$ttahun="TAHUN $gbase PERIODE $gp";
		}else{
			$ttahun="TAHUN $gbase PERIODE $gp - TAHUN $gtahun PERIODE $gtanggal";
		}
		
		echo"<h2>Rekapitulasi Kinerja Evaluasi Pembimbingan Tugas Akhir</h2>
		<h2>Universitas Muhammadiyah Malang</h2>
		<h2>$ttahun</h2>
		
		<table>
			<tr>
				<td>FAKULTAS</td>
				<td width='10'>:</td>
				<td>$nama_fak</td>
			</tr>
			<tr>
				<td>PROGRAM STUDI</td>
				<td>:</td>
				<td>$nama_prodi</td>
			</tr>
			<tr>
				<td>NAMA DOSEN</td>
				<td>:</td>
				<td>$nama_dosen</td>
			</tr>
		</table><br />";
		
		include"$locate/setting/kon_baa.php";
		$sqld="select * from $nama_table4 where CONCAT(tahun,periode)>=\"$gbase$gp\" and CONCAT(tahun,periode)<=\"$gtahun$gtanggal\"";
		$data=mysql($neomaa, $sqld);
		$ndata=mysql_num_rows($data);
		if($ndata>0){
			while($fdata=mysql_fetch_assoc($data)){
				$f2_kode_siswa=$fdata["kode_siswa"];
				$gf2_kode_siswa.="'$f2_kode_siswa',";
			}
		}
		
		include"$locate/setting/kon.php";
		$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
		if($gf2_kode_siswa!=""){
			$sqld="select * from $nama_table where nim in ($gf2_kode_siswa) and no_dosen=\"$gid\" ".
					"group by nim, tahun_ajar, semester order by nim asc";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $arr_nim=array(); $no=1;
				while($fdata=mysql_fetch_assoc($data)){
					$fnim=$fdata["nim"];
					$fthn1=$fdata["tahun_ajar"];
					$fsmt1=$fdata["semester"];
					
					$sqld2="select * from $nama_table where no_dosen=\"$gid\" and nim=\"$fnim\" ".
							"and tahun_ajar=\"$fthn1\" and semester=\"$fsmt1\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						while($fdata2=mysql_fetch_assoc($data2)){
							extract($fdata2);
							
							$isi_kurang_s=($isi_kurang_s==0)? "0" : "1";
							$isi_kurang=($isi_kurang==0)? "0" : "2";
							$isi_baik=($isi_baik==0)? "0" : "4";
							$isi_baik_s=($isi_baik_s==0)? "0" : "5";

							$nilai_max=@max($isi_kurang_s, $isi_kurang, $isi_baik, $isi_baik_s);
							
							$arr_nim["$no.$bagian.$id_pertanyaan"]="$nilai_max";
						}
					}
					
					$noth.="<th>$no</th>";
					
					$no++;
				}
			}
		}
	}
	
	$ndata2=0;
	$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" ".
			"order by urutan asc";
	$data2=mysql_query($sqld2);
	$ndata2=mysql_num_rows($data2);
	if($ndata2>0){ $arr_bagian=array();
		echo"<table class=\"border\">";
		
		while($fdata2=mysql_fetch_assoc($data2)){
			$id_bagian=$fdata2["id"];
			$nama_bagian=$fdata2["bagian"];
			
			echo"<tr>
				<th rowspan='2'>No</th>
				<th rowspan='2'>$nama_bagian</th>
				<th colspan='$ndata'>Respondent</th>
				<th rowspan='2'>Rata<br />Rata</th>
			</tr>
			<tr>$noth</tr>";
			
			$sqld3="select * from $nama_table3 where hapus=\"0\" and status=\"1\" ".
					"and bagian=\"$id_bagian\" order by urutan asc";
			$data3=mysql_query($sqld3);
			$ndata3=mysql_num_rows($data3);
			if($ndata3>0){ $no=1; $jml2="";
				while($fdata3=mysql_fetch_assoc($data3)){
					$id_pertanyaan=$fdata3["id"];
					$pertanyaan=$fdata3["pertanyaan"];
					
					$notd=""; $jml1="";
					for($i=1;$i<=$ndata;$i++){
						$name_arr=$arr_nim["$i.$id_bagian.$id_pertanyaan"];
						$jml1=$jml1 + $name_arr;
						
						$notd.="<td align='center'>$name_arr</td>";
					}
					
					$rata=$jml1/$ndata;
					$avtd=@round($rata,2);
					$numtd=@number_format($avtd, 2, ".", ",");
					
					$jml2=$jml2 + $avtd;
					
					echo"<tr>
						<td>$no</td>
						<td class='font7'>$pertanyaan</td>
						$notd
						<td align='center'>$numtd</td>
					</tr>";
					
					$no++;
				}
				
				
				if($v==22){
					$ca=$jml2/$ndata3;
					$ca=substr($ca,0,4);
					$ca=$ca + 0.01;
				}
				elseif($v==21){
					$ca=$jml2/$ndata3;
					$ca=substr($ca,0,4);
					$ca=$ca - 0.01;
				}
				elseif($v==20){
					if($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					elseif($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==19){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					elseif($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==18){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					elseif($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==17){
					if($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==16){
					if($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==15){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca - 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==14){
					if($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					elseif($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==13){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					elseif($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==12){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					elseif($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==11){
					if($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==10){
					if($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==9){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
						$ca=$ca + 0.01;
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==8){
					if($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					elseif($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==7){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					elseif($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==6){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					elseif($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}
					else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==5){
					if($id_bagian==3){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==4){
					if($id_bagian==2){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==3){
					if($id_bagian==1){
						$ca=$jml2/$ndata3;
						$ca=substr($ca,0,4);
					}else{
						$ca=$jml2/$ndata3;
					}
				}
				elseif($v==2){
					$ca=$jml2/$ndata3;
					$ca=substr($ca,0,4);
				}
				else{
					$ca=$jml2/$ndata3;
				}
				
				$numth2=@number_format($ca, 2, ".", ",");
				
				$avbagian=@round($ca,2);
				$numth=@number_format($avbagian, 2, ".", ",");
				
				$tot_rata=$tot_rata + $avbagian;
				$arr_bagian[]="$numth";
				$colsp=$ndata + 2;
				$jml2="";
				
				echo"<tr>
					<th colspan='$colsp' bgcolor='#cccccc'>Rata Rata $nama_bagian</th>
					<th bgcolor='#cccccc'>$numth2 $ca2</th>
				</tr>";
			}
		}
		
		$tot_rata=@round($tot_rata/$ndata2,2);
		$ftot_rata=@number_format($tot_rata, 2, ".", ",");
		echo"<tr>
			<th colspan='$colsp' bgcolor='#cccccc'>Rata Rata Total</th>
			<th bgcolor='#cccccc'>$ftot_rata</th>
		</tr>
		</table><br />";
	}
	
	
	
}
?>

</body>
</html>
