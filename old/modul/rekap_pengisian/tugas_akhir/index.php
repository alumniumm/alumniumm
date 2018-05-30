<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_ta";
	
	$nama_table2="master_siswa_wisuda";
	$nama_table3="master_siswa";
	
	$kategori="4";
	$title_page="Laporan Pengisian Kuesioner Tugas Akhir";
	
	include"setting/kon_baa.php";
	
	switch($act){
		default:
			$posisi=cariPosisi($batas, $hal);
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				
				<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td>:</td>
						<td>".SelTahunMasuk($gbase, "gbase")."</td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td>".SelSemester($gp, "gp")."</td>
					</tr>
					<tr>
						<td>Tahun Wisuda</td>
						<td>:</td>
						<td>".SelTahun($gtahun, "gtahun")."</td>
					</tr>
					<tr>
						<td>Periode</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gtanggal\" value=\"$gtanggal\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"proses\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\">&nbsp;</div>";
			
			$wgbase=($gbase!="")? "and tahun_ajar=\"$gbase\"" : "";
			$wgp=($gp!="")? "and semester_ajar=\"$gp\"" : "";
			$wth=($gtahun!="")? "and tahun=\"$gtahun\"" : "";
			$wgn=($gtanggal!="")? "and periode=\"$gtanggal\"" : "";
			
			$sqld="select * from $nama_table2 where tahun_ajar!=\"\" $wgbase $wgp $wth $wgn ".
					"group by tahun, periode order by tahun desc, periode desc";
			$data=mysql($neomaa, $sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_semester=SelSemester($semester_ajar, "semester_ajar", "1");
					
					$link_detail="?pages=$pages&act=data&gbase=$tahun_ajar&gp=$semester_ajar&gtahun=$tahun&gtanggal=$periode";
					$detail="<a href=\"$link_detail\" class=\"blink\">Detail</a>";
					
					#jumlah data wisuda
					$gf2_kode_siswa="";
					$sqld2="select * from $nama_table2 where tahun_ajar=\"$tahun_ajar\" and ".
							"semester_ajar=\"$semester_ajar\" and tahun=\"$tahun\" and periode=\"$periode\"";
					$data2=mysql($neomaa, $sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						while($fdata2=mysql_fetch_assoc($data2)){
							$f2_kode_siswa=$fdata2["kode_siswa"];
							$gf2_kode_siswa.="'$f2_kode_siswa',";
						}
					}
					
					#jumlah yang mengisi
					$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
					if($gf2_kode_siswa!=""){
						include"setting/kon.php";
						$sqld3="select * from $nama_table where nim in ($gf2_kode_siswa) group by nim";
						$data3=mysql_query($sqld3);
						$ndata3=mysql_num_rows($data3);
					}
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$tahun_ajar</td>
						<td>$nama_semester</td>
						<td>$tahun</td>
						<td align='center'>$periode</td>
						<td align='right'>".number_format($ndata2, 0, ",", ".")."</td>
						<td align='right'>".number_format($ndata3, 0, ",", ".")."</td>
						<td>$detail</td>
					</tr>";
					
					include"setting/kon_baa.php";
					$no++;
				}
			}
			
			$link_page="?pages=$pages&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal";
			$jrow=mysql($neomaa, $sqld);
			$jnrow=mysql_num_rows($jrow);
			$jmlHal=jumlahHalaman($jnrow, $batas);	
			$LinkHal=navPage($hal, $jmlHal, $link_page);	
			if($jnrow > $batas){
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<div id=\"paging\">$LinkHal</div>";
			}
			
			$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='15'>No</th> 
	    				<th>Tahun Ajar</th>
	    				<th>Semester</th>
	    				<th>Tahun Wisuda</th>
	    				<th>Periode</th>
	    				<th>Jumlah Wisuda</th>
	    				<th>Jumlah Pegisian</th>
	    				<th width='100'>Aksi</th>
					</tr> 
				</thead> 
				<tbody>
					$td_table
				</tbody>
			</table>
			<div class=\"clear\"></div>
			$thal";
			
		break;
		
		case"data":
			$title_page.=" &raquo; Data";
			$link_page="?pages=$pages&act=$act&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal";
			$posisi=cariPosisi($batas, $hal);
			$nama_semester=SelSemester($gp, "gp", "1");
			
			$cnpage="<table class='pad5'>
				<tr>
					<td>Tahun Akademik</td>
					<td width='10'>:</td>
					<td>$gbase</td>
				</tr>
				<tr>
					<td>Semester</td>
					<td width='10'>:</td>
					<td>$nama_semester</td>
				</tr>
				<tr>
					<td>Tahun Wisuda</td>
					<td>:</td>
					<td>$gtahun</td>
				</tr>
				<tr>
					<td>Periode</td>
					<td>:</td>
					<td>$gtanggal</td>
				</tr>
			</table>
			<hr/><br />";
			
			$cnpage.="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"$act\" />
				<input type=\"hidden\" name=\"gbase\" value=\"$gbase\" />
				<input type=\"hidden\" name=\"gp\" value=\"$gp\" />
				<input type=\"hidden\" name=\"gtahun\" value=\"$gtahun\" />
				<input type=\"hidden\" name=\"gtanggal\" value=\"$gtanggal\" />
				
				<table class='pad5'>
					<tr>
						<td>NIM</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='$link_page'\"/>
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\"></div>
			<br /><hr /><br />";
			
			$sqld="select a.*, b.nama_siswa from $nama_table2 as a left join $nama_table3 as b ".
					"on a.kode_siswa=b.kode_siswa where a.tahun_ajar=\"$gbase\" and a.semester_ajar=\"$gp\" ".
					"and a.tahun=\"$gtahun\" and a.periode=\"$gtanggal\"";
			$data=mysql($neomaa, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi + 1;
				while($fdata=mysql_fetch_assoc($data)){
					$nim=$fdata["kode_siswa"];
					$nama_mhs=$fdata["nama_siswa"];
					
					include"setting/kon.php";
					$sqld2="select * from $nama_table where nim=\"$nim\" group by no_dosen, pembimbing";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						$np1=""; $np2=""; $np="";
						
						while($fdata2=mysql_fetch_assoc($data2)){
							$id_dosen=$fdata2["no_dosen"];
							$pembimbing=$fdata2["pembimbing"];
							
							if($pembimbing==1){
								$nm_pem1=NamaDosen($id_dosen);
								$np1=1;
							}
							
							if($pembimbing==2){
								$nm_pem2=NamaDosen($id_dosen);
								$np2=1;
							}
							
							$np=$np1+$np2;
							$nstatus=($np==2)? "Sudah" : "Kurang";
						}
					}else{
						$nm_pem1="";
						$nm_pem2="";
						$nstatus="Belum";
						$n3++;
					}
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$nim</td>
						<td>$nama_mhs</td>
						<td>$nm_pem1</td>
						<td>$nm_pem2</td>
						<td>$nstatus</td>
					</tr>";
					
					$no++;
					include"setting/kon_baa.php";
				}
				
				$n2=$ndata - $n3;
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<br /><b>Jumlah yang Mengisi = $n2</b>";
				$thal.="<br /><b>Jumlah belum Mengisi = $n3</b>";
			}
				
			$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th>Nim</th>
	    				<th>Nama</th>
	    				<th>Pembimbing 1</th>
	    				<th>Pembimbing 2</th>
	    				<th>Pengisian</th>
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

