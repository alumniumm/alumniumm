<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="zdb_ta";
	$nama_table_saran="$nama_table"."_saran";
	
	$nama_table2="master_siswa";
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	$nama_table5="master_dosen";
	$nama_table6="master_siswa_wisuda";
	
	$kategori="4";
	$title_page="Laporan Kuesioner Pembimbingan Tugas Akhir";
	
	include"setting/kon_baa.php";
	
	switch($act){
		default:
			$posisi=cariPosisi($batas, $hal);
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"data\" />
				
				<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td>:</td>
						<td>".SelTahunMasuk($gbase, "gbase")."</td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td>".SelSemester($gp, "gp", "")."</td>
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
				<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\">&nbsp;</div>";
			
			$wgbase=($gbase!="")? "and tahun_ajar=\"$gbase\"" : "";
			$wgp=($gp!="")? "and semester_ajar=\"$gp\"" : "";
			$wth=($gtahun!="")? "and tahun=\"$gtahun\"" : "";
			$wgn=($gtanggal!="")? "and periode=\"$gtanggal\"" : "";
			
			$sqld="select * from $nama_table6 where tahun_ajar!=\"\" $wgbase $wgp $wth $wgn ".
					"group by tahun, periode order by id desc";
			$data=mysql($neomaa, $sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_semester=SelSemester($semester_ajar, "semester_ajar", "1");
					
					$link_detail="?pages=$pages&act=data&gbase=$tahun_ajar&gp=$semester_ajar&gtahun=$tahun&gtanggal=$periode";
					$detail="<a href=\"$link_detail\" class=\"blink\">Detail</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$tahun_ajar</td>
						<td>$nama_semester</td>
						<td>$tahun</td>
						<td align='center'>$periode</td>
						<td>$detail</td>
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
			
			$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='15'>No</th> 
	    				<th>Tahun Ajar</th>
	    				<th>Semester</th>
	    				<th>Tahun Wisuda</th>
	    				<th>Periode</th>
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
			$link_page="?pages=$pages&act=$act&gbase=$gbase&gp=$gp";
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
				<tr>
					<td>Tahun Wisuda</td>
					<td width='10'>:</td>
					<td>$gtahun</td>
				</tr>
				<tr>
					<td>Periode</td>
					<td width='10'>:</td>
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
			
			#jumlah data wisuda
			$gf2_kode_siswa="";
			$sqld2="select * from $nama_table6 where tahun_ajar=\"$gbase\" and ".
					"semester_ajar=\"$gp\" and tahun=\"$gtahun\" and periode=\"$gtanggal\"";
			$data2=mysql($neomaa, $sqld2);
			$ndata2=mysql_num_rows($data2);
			if($ndata2>0){
				while($fdata2=mysql_fetch_assoc($data2)){
					$f2_kode_siswa=$fdata2["kode_siswa"];
					$gf2_kode_siswa.="'$f2_kode_siswa',";
				}
			}
			
			$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
			if($gf2_kode_siswa!=""){
				include"setting/kon.php";
				$sqld="select * from $nama_table where nim in ($gf2_kode_siswa) group by nim order by nim asc";
				$data=mysql_query($sqld." limit $posisi,$batas");
				$ndata=mysql_num_rows($data);
				if($ndata>0){ $no=$posisi+1;
					while($fdata=mysql_fetch_assoc($data)){
						extract($fdata);
						$nama_mhs=NamaMhs($nim);
						
						$link_detail="?pages=$pages&act=pilih&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$nim";
						$detail="<a href=\"$link_detail\" class=\"blink\">Detail</a>";
						
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
		
		case"pilih":
			$title_page.=" &raquo; Pilih Dosen";
			
			include"setting/kon_baa.php";
				
			$sqld="select * from $nama_table2 where kode_siswa=\"$gid\"";
			$data=mysql($neomaa, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				extract($fdata);
				$xprodi=NamaProdi($ref_program_studi);
				$nama_semester=SelSemester($gp, "gp", "1");
				$nama_prodi=$xprodi["nama_depart"];
				
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
						
						<td>Tahun Wisuda/Periode</td>
						<td>:</td>
						<td>$gtahun/$gtanggal</td>
					</tr>
					
				</table>
				<hr/><br />";
				
				include"setting/kon.php";
				$sqld2="select * from $nama_table where nim=\"$gid\" group by no_dosen";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					$id_dosen=array();
					
					while($fdata2=mysql_fetch_assoc($data2)){
						extract($fdata2);
						$id_dosen[]=(!empty($no_dosen))? "$no_dosen" : "";
					}
					
					$arr_dosen=array_unique($id_dosen);
					$arr_last=end($arr_dosen);
					$arr_key=key($arr_dosen);
					$i=0;
					
					while($i<=$arr_key){
					    $kode_dosen=$arr_dosen[$i];
					    if($kode_dosen!=""){$dosen.="'$kode_dosen',";}
					    $i++;
					}
					
					$dosen=substr($dosen,0,-1);
					
					include"setting/kon_baa.php";
					$sqld3="select * from $nama_table5 where no_dosen in ($dosen) order by namaDosen asc";
					$data3=mysql($neomaa, $sqld3);
					$ndata3=mysql_num_rows($data3);
					if($ndata3>0){ $no=1;
						while($fdata3=mysql_fetch_assoc($data3)){
							extract($fdata3);
							$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
							
							$link_page="?pages=$pages&act=detail&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$gid&gdid=$no_dosen";
							$detail="<a href=\"$link_page\" class=\"blink\">Detail</a>";
							
							$td_table.="<tr>
								<td>$no</td>
								<td>$nama_dosen</td>
								<td>$detail</td>
							</tr>";
							
							$no++;
						}
						
						$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
							<thead> 
								<tr> 
				   					<th width='10'>No</th> 
				    				<th>Nama Dosen</th>
				    				<th width='150'>Aksi</th>
								</tr> 
							</thead> 
							<tbody>
								$td_table
							</tbody>
						</table><br /><br />";
					}
					
					$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=data&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal'\"/>";
				}else{
					$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil / Belum Mengisi Kuesioner Tugas Akhir</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
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
						
						<td>Nama Dosen</td>
						<td>:</td>
						<td>$nama_dosen</td>
					</tr>
					
				</table>
				<hr/><br />";
				
				include"setting/kon.php";
				$sqld2="select * from $nama_table where nim=\"$gid\" limit 1";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
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
									$ck=CekKuisTA($gbase, $gp, $gid, $gdid, "$id_bagian#$id");
									
									$ck1=($ck["ck1"]==1)? "v" : "";
									$ck2=($ck["ck2"]==1)? "v" : "";
									$ck3=($ck["ck3"]==1)? "v" : "";
									$ck4=($ck["ck4"]==1)? "v" : "";
									
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
						$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=pilih&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$gid'\"/>";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil Mata Kuliah Aktif</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
	}
	
}
?>
