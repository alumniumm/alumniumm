<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_perwalian_"."$table";
	
	$nama_table2="master_siswa";
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	$nama_table5="master_dosen";
	
	$kategori="3";
	$title_page="Laporan Kuesioner Perpustakaan (Mahasiswa)";
	
	switch($act){
		default:
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"data\" />
				
				<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td>:</td>
						<td>".SelTahunMasuk($gbase, "gbase", "required")."</td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\"></div>";
		break;
		
		case"data":
			$title_page.=" &raquo; Data";
			$link_page="?pages=$pages&act=$act&gbase=$gbase";
			$posisi=cariPosisi($batas, $hal);
			$nama_semester=SelSemester($gp, "gp", "1");
			
			if(!empty($gname)){
				$selgbase.="and nim=\"$gname\"";
			}
			
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
			</table>
			<hr/><br />";
			
			$cnpage.="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"$act\" />
				<input type=\"hidden\" name=\"gbase\" value=\"$gbase\" />
				
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
			
			include"setting/kon.php";
			$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" $selgbase ".
					"group by nim order by nim asc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_mhs=NamaMhs($nim);
					
					$detail="<a href=\"?pages=$pages&act=detail&gbase=$gbase&gid=$nim\" class=\"blink\">Detail</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$nim</td>
						<td>$nama_mhs</td>
						<td>$detail</td>
					</tr>";
					
					$no++;
				}
				
				include"setting/kon.php";
				$jrow=mysql_query($sqld);
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
		   					<th width='10'>No</th> 
		    				<th>Nim</th>
		    				<th>Nama</th>
		    				<th width='100'>Aksi</th>
						</tr> 
					</thead> 
					<tbody>
						$td_table
					</tbody>
				</table>
				<div class=\"clear\"></div>
				$thal
				";
				
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
				$cnpage.="<br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"detail":
			$title_page.=" &raquo; Data Kuesioner Mahasiswa";
			
			include"setting/kon_baa.php";
			$sqld="select * from $nama_table2 where kode_siswa=\"$gid\"";
			$data=mysql($neomaa, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				extract($fdata);
				$xprodi=NamaProdi($ref_program_studi);
				$nama_prodi=$xprodi["nama_depart"];
				
				$nama_semester=SelSemester($gp, "gp", "1");
				$nama_dosen=NamaDosen($gdid);
				
				$cnpage.="<table class='pad5'>
					<tr>
						<td>Nim</td>
						<td width='10'>:</td>
						<td>$kode_siswa</td>
						
						<td rowspan='3' width='100'></td>
						<td>Tahun Akademik</td>
						<td width='10'>:</td>
						<td>$gbase</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td width='10'>:</td>
						<td>$nama_siswa</td>
						
						<td>Semester</td>
						<td width='10'>:</td>
						<td>$nama_semester</td>
					</tr>
					<tr>
						<td>Program Studi</td>
						<td width='10'>:</td>
						<td>$nama_prodi</td>
						
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
				</table>
				<hr/><br />";
				
				include"setting/kon.php";
				$sqld2="select * from $nama_table where nim=\"$gid\" limit 1";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					$arr_bp=CekPerpus($nama_table, $kode_siswa, $gbase, $gp);
				
					$sqld5="select * from $nama_table_saran where nim=\"$kode_siswa\" and tahun_ajar=\"$gbase\" ".
							"and semester=\"$gp\"";
					$data5=mysql_query($sqld5);
					$ndata5=mysql_num_rows($data5);
					if($ndata5>0){
						$fdata2=mysql_fetch_assoc($data5);
						$saran=$fdata2["saran"];
					}
						
					$sqld3="select * from $nama_table3 where hapus=\"0\" and status=\"1\" and ".
							"kategori=\"$kategori\" order by urutan asc";
					$data3=mysql_query($sqld3);
					$ndata3=mysql_num_rows($data3);
					if($ndata3>0){
						
						while($fdata3=mysql_fetch_assoc($data3)){
							$id_bagian=$fdata3["id"];
							$nama_bagian=$fdata3["bagian"];
							
							$sqld4="select * from $nama_table4 where hapus=\"0\" and status=\"1\" ".
									"and bagian=\"$id_bagian\" order by urutan asc";
							$data4=mysql_query($sqld4);
							$ndata4=mysql_num_rows($data4);
							if($ndata4>0){ $no=1;
								while($fdata4=mysql_fetch_assoc($data4)){
									extract($fdata4);
									$radio_name="pilih_"."$id_bagian"."_"."$id";
									$name_fd="$id_bagian"."$id";
									
									$ck1=($arr_bp["$name_fd"]==1)? "v" : "";
									$ck2=($arr_bp["$name_fd"]==2)? "v" : "";
									$ck3=($arr_bp["$name_fd"]==3)? "v" : "";
									$ck4=($arr_bp["$name_fd"]==4)? "v" : "";
									
									$td_table.="<tr>
										<td>$no</td>
										<td>$pertanyaan</td>
										<td align='center'>$ck1</td>
										<td align='center'>$ck2</td>
										<td align='center'>$ck3</td>
										<td align='center'>$ck4</td>
									</tr>";
									
									$no++;
								}
								
								$cnpage.="<h2>$nama_bagian</h2><hr />
								<table class=\"tablesorter\" cellspacing=\"0\"> 
									<thead> 
										<tr> 
						   					<th width='10'>No</th> 
						    				<th>Pertanyaan</th>
						    				<th width='80'>Kurang Sekali</th>
						    				<th width='80'>Kurang</th>
						    				<th width='80'>Baik</th>
						    				<th width='80'>Baik Sekali</th>
										</tr> 
									</thead>
									<tbody>
										$td_table
									</tbody>
								</table><br /><br/>";
								
								$td_table="";
							}
						}
						
						$cnpage.="<h2>Saran</h2><hr />$saran<br /><br/>";
						$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=pilih&gbase=$gbase&gp=$gp&gid=$gid'\"/>";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil Mata Kuliah Aktif</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<meta http-equiv=\"refresh\" content=\"200;url=?pages=$pages\">";
			}
		break;
	}
	
}
?>