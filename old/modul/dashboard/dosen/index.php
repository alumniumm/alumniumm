<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	include"setting/kon_baa.php";
	$nama_table="master_dosen";
	$nama_table2="transaksi_homebase";
	
	$title_page="Data Dosen Aktif";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname&gbase=$gbase";
			$posisi=cariPosisi($batas, $hal);
			
			if(!empty($gbase)){
				$selgbase="and b.ref_prodi like \"%$gbase%\"";
			}
			
			$sqld="SELECT a.*, b.ref_prodi FROM $nama_table AS a LEFT JOIN $nama_table2 AS b ".
					"ON a.no_dosen = b.no_dosen where a.ref_aktivasiDosen=\"A\" and namaDosen like \"%$gname%\" ".
					"$selgbase order by a.namaDosen asc";
			$data=mysql($neomaa, $sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$xprodi=NamaProdi($ref_prodi);
					$nama_prodi=$xprodi["nama_depart"];
					
					$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$nama_dosen</td>
						<td>$nama_prodi</td>
					</tr>";
					
					$no++;
				}
			}
			
			$jrow=mysql($neomaa, $sqld);
			$jnrow=mysql_num_rows($jrow);
			$jmlHal=jumlahHalaman($jnrow, $batas);	
			$LinkHal=navPage($hal, $jmlHal, $link_page);	
			if($jnrow > $batas){
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<div id=\"paging\">$LinkHal</div>";
			}
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				
				<table class='pad5'>
					<tr>
						<td>Nama Dosen</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
					<tr>
						<td>Homebase</td>
						<td>:</td>
						<td>".SelProdi($gbase, "gbase")."</td>
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
	    				<th>Nama Dosen</th> 
	    				<th>Homebase</th>
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