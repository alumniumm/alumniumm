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
		font-size:12px;
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
	$link_back="$locate/home.php?pages=kd-perpustakaan&act=detail&gbase=$gbase&gp=$gp";
	
	echo"<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" $non/>";
	echo"<input type=\"button\" name=\"button2\" value=\"Cetak\" onclick=\"window.print()\" $non/>";
	
	
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_perpustakaan_"."$table"."_"."$gp";
	$nama_table2="db_bagian";
	$nama_table3="db_pertanyaan";
	$noth="";
	$kategori="3";
	
	$nama_sem=SelSemester($gp, "gp", "1");
	
	echo"<h2>Rekapitulasi Kinerja Pelayanan Perpustakaan</h2>
	<h2>Universitas Muhammadiyah Malang</h2>
	<h2>Tahun Akademik $gbase</h2>
	<h2>Semester $nama_sem</h2><br />";
	
	include"$locate/setting/kon.php";
	$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
			"group by nim order by nim asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){ $arr_nim=array(); $no=1;
		while($fdata=mysql_fetch_assoc($data)){
			$fnim=$fdata["nim"];
			
			$sqld2="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
					"and nim=\"$fnim\"";
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
			
			$no++;
		}
	}
	
	$th_bagian=""; $th_pertanyaan=""; $arr_bagian=array(); $arr_nobag=array();
	$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" ".
			" order by urutan asc";
	$data2=mysql_query($sqld2);
	$ndata2=mysql_num_rows($data2);
	if($ndata2>0){ $no=1;
		while($fdata2=mysql_fetch_assoc($data2)){
			$id_bagian=$fdata2["id"];
			$nama_bagian=$fdata2["bagian"];
			
			$sqld3="select * from $nama_table3 where hapus=\"0\" and status=\"1\" ".
					"and bagian=\"$id_bagian\" order by urutan asc";
			$data3=mysql_query($sqld3);
			$ndata3=mysql_num_rows($data3);
			if($ndata3>0){ $no2=1;
				while($fdata3=mysql_fetch_assoc($data3)){
					$id_pertanyaan=$fdata3["id"];
					$pertanyaan=$fdata3["pertanyaan"];
					
					$th_pertanyaan.="<th>$no2</th>";
					$arr_bagian["$no.$no2"]="$id_bagian.$id_pertanyaan";
					$no2++;
				}
			}
			
			$th_bagian.="<th colspan='$ndata3'>$nama_bagian</th>";
			$arr_nobag[$no]="$ndata3";
			
			$no++;
		}
		
		$cols=$ndata2 * $ndata3;
		$tr_data="";
		
		#data kuesioner
		for($i=1;$i<=$ndata;$i++){
			$tr_data.="<tr>";
			$tr_data.="<td align='center'>$i</td>";
			
			
			for($j=1;$j<=$ndata2;$j++){
				$jml_pertanyaan=$arr_nobag[$j];
				
				for($k=1;$k<=$jml_pertanyaan;$k++){
					$sp_bagian=$arr_bagian["$j.$k"];
					$sp_nim=$arr_nim["$i.$sp_bagian"];
					
					$tr_data.="<td align='center'>$sp_nim</td>";
				}
			}
			
			$tr_data.="</tr>";
		}
		
		#Rata2 kuesioner
		$th_rata.=""; $th_sigma="";
		for($i=1;$i<=$ndata2;$i++){
			$jml_pertanyaan=$arr_nobag[$i];
			
			$sps_rata2="";
			for($j=1;$j<=$jml_pertanyaan;$j++){
				$sp_bagian=$arr_bagian["$i.$j"];
				
				$sp_rata2="";
				for($k=1;$k<=$ndata;$k++){
					$sp_rata=$arr_nim["$k.$sp_bagian"];
					
					$sp_rata2=$sp_rata2 + $sp_rata;
				}
				
				$sp_rata2=($sp_rata2/$ndata);
				$spr_rata2=@round($sp_rata2,2);
				$th_rata.="<th align='center'>$spr_rata2</th>";
				
				$sps_rata2=$sps_rata2 + $spr_rata2;
			}
			
			$sps_rata2=($sps_rata2/$jml_pertanyaan);
			$spsr_rata2=@round($sps_rata2,2);
			$th_sigma.="<th colspan='$jml_pertanyaan' align='center'>$spsr_rata2</th>";
		}
		
		
		echo"<table class=\"border\">
			<tr>
				<th rowspan='3' width='50'>Respondent (Mahasiswa)</th>
				<th colspan='$cols'>Aspek Penilaian</th>
			</tr>
			<tr>
				$th_bagian
			</tr>
			<tr>
				$th_pertanyaan
			</tr>
			$tr_data
			<tr>
				<th>Rata-Rata</th>
				$th_rata
			</tr>
			<tr>
				<th>&Sigma; Rata-Rata</th>
				$th_sigma
			</tr>
		</table>";
	}
	
}
?>

</body>
</html>