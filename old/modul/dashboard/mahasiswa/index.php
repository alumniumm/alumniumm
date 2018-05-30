<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	include"setting/kon_baa.php";
	$nama_table="master_siswa";
	
	$title_page="Data Mahasiswa Aktif";
	
	switch($act){
		default:
			$link_page="?pages=$pages&gname=$gname&gbase=$gbase&gp=$gp";
			$posisi=cariPosisi($batas, $hal);
			
			if(!empty($gbase)){
				$selgbase.="and ref_program_studi=\"$gbase\"";
			}
			
			if(!empty($gp)){
				list($gp1, $gp2)=explode("/", $gp);
				$selgbase.=" and tahun_masuk=\"$gp1\"";
			}
			
			$sqld="SELECT * FROM $nama_table where nama_siswa like \"%$gname%\" and ref_akademik in ('A') ".
					"$selgbase order by nama_siswa asc";
			$data=mysql($neomaa, $sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$xprodi=NamaProdi($ref_program_studi);
					$nama_prodi=$xprodi["nama_depart"];
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$kode_siswa</td>
						<td>$nama_siswa</td>
						<td>$nama_prodi</td>
						<td>$tahun_masuk</td>
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
						<td>Nama Mahasiswa</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
					<tr>
						<td>Progam Studi</td>
						<td>:</td>
						<td>".SelProdi($gbase, "gbase")."</td>
					</tr>
					<tr>
						<td>Tahun Masuk</td>
						<td>:</td>
						<td>".SelTahunMasuk($gp, "gp")."</td>
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
	    				<th>Nim</th> 
	    				<th>Nama Mahasiswa</th> 
	    				<th>Program Studi</th> 
	    				<th>Tahun Masuk</th>
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