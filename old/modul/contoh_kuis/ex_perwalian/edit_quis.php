<?php
include"setting/kon.php";	

$sqlbag = "SELECT * FROM db_bagian WHERE kategori=\"2\" and hapus=\"0\" order by urutan asc";
$h = mysql_query($sqlbag);
$hit = mysql_num_rows($h);
if($hit){
 while($dat = mysql_fetch_array($h)){ 
 $no++;
 $bag=$dat['id']; 
 
 	$question1 ="<tr><td colspan='7'>$bag</td></tr>";
	$question = ""; 
	
	$sqltanya = "SELECT a.*, b.id,b.pertanyaan,b.bagian,b.urutan 
	FROM $tablename a
	LEFT JOIN db_pertanyaan b
	ON a.id_pertanyaan = b.id
	WHERE a.nim='$nim' and a.no_dosen='$no_dosen' and tahun_ajar = '$TahunAkademik' and b.bagian=\"$bag\" and b.hapus=\"0\" 
	order by b.urutan asc";
	
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	
	$name ="cose-$bag-$id_tanya";
	
	$isi_kurang_s = $dd['isi_kurang_s']; if($isi_kurang_s > 0){$val1="checked";}else{$val1="";}
	$isi_kurang = $dd['isi_kurang']; if($isi_kurang > 0){$val2="checked";}else{$val2="";}
	$isi_cukup = $dd['isi_cukup']; if($isi_cukup > 0){$val3="checked";}else{$val3="";}
	$isi_baik = $dd['isi_baik']; if($isi_baik > 0){$val4="checked";}else{$val4="";}
	$isi_baik_s = $dd['isi_baik_s']; if($isi_baik_s > 0){$val5="checked";}else{$val5="";} 
	
		
	$question .="
	<tr>
	<td>$noq</td>
	<td>$dd[pertanyaan]</td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"1\" $val1  required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"2\" $val2 required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"3\" $val3 required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"4\" $val4 required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"5\" $val5 required></td>
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
  <th width='80'>Kurang Sekali</th>
  <th width='80'>Kurang</th>
  <th width='80'>Cukup</th>
  <th width='80'>Baik</th>
  <th width='80'>Baik Sekali</th>
  </tr>
  </thead>
  <tbody>
  	$question
  </tbody>
  </table><br><br>
  "; 
 
  }
 }
?> 
