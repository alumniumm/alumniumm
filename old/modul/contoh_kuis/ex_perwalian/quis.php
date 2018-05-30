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
	
	$sqltanya = "SELECT id,pertanyaan,bagian,urutan FROM db_pertanyaan WHERE bagian=\"$bag\" and hapus=\"0\" order by urutan asc";
	$hasilsql = mysql_query($sqltanya);
	$hitsql = mysql_num_rows($hasilsql);
 	
	if($hitsql){ $noq=1;
	while($dd = mysql_fetch_array($hasilsql)){
	$bag = $dd['bagian'];
	$id_tanya = $dd['id'];
	
	$name ="cose-$bag-$id_tanya";
	$question .="
	<tr>
	<td>$noq</td>
	<td>$dd[pertanyaan]</td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"1\" required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"2\" required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"3\" required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"4\" required></td>
	<td align='center'><input type=\"radio\" name='".$name."' value=\"5\" required></td>
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
