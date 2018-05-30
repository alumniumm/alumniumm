<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	include"setting/kon_baa.php";
	$nama_table="in_semester";
	
	$title_page="Data Semester";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname";
			$posisi=cariPosisi($batas, $hal);
			
			$sqld="SELECT * FROM $nama_table where semester like \"%$gname%\" order by id asc";
			$data=mysql($neomaaref, $sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					
					$td_table.="<tr>
						<td>$no</td>
						<td align='center'>$id</td>
						<td>$semester</td>
					</tr>";
					
					$no++;
				}
			}
			
			$jrow=mysql($neomaaref, $sqld);
			$jnrow=mysql_num_rows($jrow);
			$jmlHal=jumlahHalaman($jnrow, $batas);	
			$LinkHal=navPage($hal, $jmlHal, $link_page);	
			if($jnrow > $batas){
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<div id=\"paging\">$LinkHal</div>";
			}
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				
				<table>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\"></div>
			<br /><hr /><br />
			
			<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th width='20'>Kode</th> 
	    				<th>Semester</th>
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
	}
	
}
?>