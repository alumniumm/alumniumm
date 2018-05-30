<?php

include"setting/kon.php";	

$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
$nnn="";

 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $nio++;
 $bag=$dat['id']; 
 $par=$dat['bagian'];	
	
	//Tampil Header
	$sqlth="SELECT DISTINCT nim FROM $Tb WHERE no_dosen = '$Dosen' and prodi = '$IDJur' ";
	$hds = mysql_query($sqlth);
	$htg = mysql_num_rows($hds);
	if($htg){
		$subP="";
					
		while($dfh = mysql_fetch_array($hds)){
		$nnn++;
		$subP .="<th bgcolor='#CCCCCC'>$nnn</th>";
		$Nm = $dfh[nim];
		
		}
	}
	
		$sqltanyasoal = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
		$hdf = mysql_query($sqltanyasoal);
		$res="";		
		while($dggf = mysql_fetch_array($hdf)){
		$IDtan = $dggf['id'];
		
		$sqlNim="SELECT DISTINCT nim FROM db_bkma.$Tb WHERE no_dosen = '$Dosen' and prodi = '$IDJur' ";
		$hds1 = mysql_query($sqlNim);
		$htg1 = mysql_num_rows($hds1);
			if($htg1){ 
				$resp="";
				while($fdt = mysql_fetch_array($hds1)){
				$fNim =  $fdt['nim'];
				
				$tgd = HitResponden($fNim,$IDtan,$Tb);
				$resp .="<td align='center'>$tgd</td>";
				
				}
				
			}
	
		
		}
		
	
		
	//tampil pertanyaan	
	$sqltanya = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ 
		$rrt="";
		$nob="";
		$nnn="";
		while($dd = mysql_fetch_array($hasilsql)){
		$nob++;
		$bag = $dd['bagian'];
		$id_tanya = $dd['id'];
		$pertanyaan = $dd['pertanyaan'];
		$jmlarraySum = HitKuesionerDosen($Dosen,$id_tanya,$IDJur,$Tb);
		$rrt .= " <tr>
		<td align='center'>$nob</td>
		<td>$pertanyaan</td>
		$resp
		<td align='center'>$jmlarraySum</td>
		</tr>";
		}
	}
		
	
	$lop .="<h2>$dat[bagian]</h2><hr>
	<table width=\"906\"  cellspacing=\"0\" border=\"1\">
<thead>
  <tr>
  	<th width=\"39\" rowspan=\"2\" bgcolor='#CCCCCC'>No.</th>
	<th width=\"408\" rowspan=\"2\" bgcolor='#CCCCCC'>KETERSEDIAAN PERWALIAN </th>
	<th colspan=\"$htg\" bgcolor='#CCCCCC'>RESPONDEN</th>
	<th width=\"100\" rowspan=\"2\" bgcolor='#CCCCCC'>RATA-RATA</th>
  </tr>
 
  	$subP
	
 </thead>
 
 <tbody>
 <tr>
 $rrt
 </tr>
 </tbody>
 </table>
 
 <br>";
	
	/*
	$lop .="<h2>$dat[bagian]</h2><hr>
  <table class=\"tablesorter\" cellspacing=\"0\">
  <thead>
  <tr>
  <th width='10'>No.</th>
  <th>Pertanyaan</th>
  <th width='80'>Skor</th>
  <th width='80'>Kategori</th>
  </tr>
  </thead>
  <tbody>
  	$question
	$ra
  </tbody>
  </table>
  "; 
   */
 
  }
 }
?> 
