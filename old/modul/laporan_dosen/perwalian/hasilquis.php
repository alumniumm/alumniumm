<?php
include"setting/kon.php";	

$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $nio++;
 $bag=$dat['id']; 
 $par=$dat['bagian'];	
	$rata = HitRataDosen($bag,$IDdosen,$NamaTable);
	$kat_nilai = Nilai($rata,2);
	
	$totrata[] = $rata;
	$rekap[] = $par;
	$NilaiRata[] = $rata;
	
	$eval .="<tr>
	<td>$nio</td>
	<td>$par</td>
	<td align='center'>$rata</td>
	<td align='center'>$kat_nilai</td>
	</tr>";
	
	$ra="<tr>
	<td colspan='2' align='center'><b>Rata-rata $par</b></td>
	<td align='center'><b>$rata</b></td>
	<td><b>$kat_nilai</b></td>
	</tr>";
	
 	$question1 ="<tr><td colspan='7'>$bag</td></tr>";
	$question = ""; 
	
	$sqltanya = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	$value = HitKuesionerDosen($IDdosen,$id_tanya,$IDjur,$NamaTable);
	
	$valnilai = round($value,2);
	$kat = Nilai($valnilai,2);		
	
	$name ="cose-$bag-$id_tanya";
	$question .="
	<tr>
	<td>$noq</td>
	<td>$dd[pertanyaan]</td>
	<td align='center'>$value</td>
	<td align='center'>$kat</td>
	</tr>";
	$noq++;	
	}
	}
	
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
   
 
  }
 }
?> 
