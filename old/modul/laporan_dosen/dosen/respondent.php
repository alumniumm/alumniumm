<?php
session_start();
$ss_user=$_SESSION["ss_user"];
$ss_pwd=$_SESSION["ss_pwd"];
$ss_nama=$_SESSION["ss_nama"];
$ss_level=$_SESSION["ss_level"];
$ss_kode=$_SESSION["ss_kode"];
$vmode=1;
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
	
	include"$locate/setting/kon.php";
	include"$locate/setting/function.php";
	include"$locate/setting/variable.php";
	
	extract($_GET);
	$non="class=\"disnon\"";
	$link_back="$locate/home.php?pages=kd-dosen&act=data&gbase=$gbase&gp=$gp";
	
	echo"<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"Cetak\" onclick=\"window.print()\" $non/>";
	
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_kuis_"."$table"."_"."$gp";
	$nama_table2="db_bagian";
	$nama_table3="db_pertanyaan";
	$noth="";
	$kategori="1";
	
	$nama_sem=SelSemester($gp, "gp", "1");
	$nama_dosen=NamaDosen($gid);
	$xprodi=NamaProdi($gdid);
	
	$nama_prodi=$xprodi["nama_depart"];
	$nama_fak=$xprodi["namaFakultas"];
	
	echo"<h2>Rekapitulasi Kinerja Evaluasi Pembelajaran Dosen</h2>
	<h2>Universitas Muhammadiyah Malang	</h2>
	<h2>Semester $nama_sem</h2>
	<h2>Tahun Akademik $gbase</h2>
	
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
	
	include"$locate/setting/kon.php";
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" and no_dosen=\"$gid\" ".
			"group by nim order by nim asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){ $arr_nim=array(); $no=1;
		while($fdata=mysql_fetch_assoc($data)){
			$fnim=$fdata["nim"];
			
			$sqld2="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" and no_dosen=\"$gid\" ".
					"and nim=\"$fnim\"";
			$data2=mysql_query($sqld2);
			$ndata2=mysql_num_rows($data2);
			if($ndata2>0){
				while($fdata2=mysql_fetch_assoc($data2)){
					extract($fdata2);
					
					$isi_kurang_s=($isi_kurang_s==0)? "0" : "1";
					$isi_kurang=($isi_kurang==0)? "0" : "2";
					$isi_baik=($isi_baik==0)? "0" : "3";
					$isi_baik_s=($isi_baik_s==0)? "0" : "4";

					$nilai_max=@max($isi_kurang_s, $isi_kurang, $isi_baik, $isi_baik_s);
					
					$arr_nim["$no.$bagian.$id_pertanyaan"]="$nilai_max";
				}
			}
			
			$noth.="<th>$no</th>";
			
			$no++;
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
				
				$avbagian=@round($jml2/$ndata3,2);
				$numth=@number_format($avbagian, 2, ".", ",");
				
				$tot_rata=$tot_rata + $avbagian;
				$arr_bagian[]="$numth";
				$colsp=$ndata + 2;
				$jml2="";
				
				
				echo"<tr>
					<th colspan='$colsp' bgcolor='#cccccc'>Rata Rata $nama_bagian</th>
					<th bgcolor='#cccccc'>$numth</th>
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
		
		#banyak bagian
		for($b=0;$b<$ndata2;$b++){
			$bb=$b+1;
			$bd=$arr_bagian[$b];
			
			$bth.="<th>$bb</th>";
			$btd.="<td align='center'>$bd</td>";
		}
		
		$rj=RataJurusan($prodi, $gbase, $gp, $nama_table);
		$rata_jurusan=$rj["td"];
		
		$rf=RataFakultas($prodi, $gbase, $gp, $nama_table);
		$rata_fakultas=$rf["td"];
		
		$ru=RataUniversitas($prodi, $gbase, $gp, $nama_table);
		$rata_universitas=$ru["td"];
		
		echo"<table class=\"border\">
			<tr>
				<th rowspan='2'>No</th>
				<th rowspan='2'>Aspek Rata Rata</th>
				<th colspan='$ndata2'>Rata Rata Aspek</th>
			</tr>
			<tr>$bth</tr>
			<tr>
				<td>1</td>
				<td>Rata Rata Personal</td>
				$btd
			</tr>
			<tr>
				<td>2</td>
				<td>Rata Rata Jurusan</td>
				$rata_jurusan
			</tr>
			<tr>
				<td>3</td>
				<td>Rata Rata Fakultas</td>
				$rata_fakultas
			</tr>
			<tr>
				<td>4</td>
				<td>Rata Rata Universitas</td>
				$rata_universitas
			</tr>
		</table>";
	}
	
	
	
}
?>

</body>
</html>
