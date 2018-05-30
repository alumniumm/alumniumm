<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="transaksi_krs";
	$nama_table2="transaksi_kurikulum";
	$nama_table3="transaksi_jadwal";
	$nama_table4="master_siswa";
	$nama_table5="master_dosen";
	
	$nama_table6="db_bagian";
	$nama_table7="db_pertanyaan";
	$nama_table8="db_tgl_kuis";
	
	$kategori="1";
	$title_page="Kuesioner Evaluasi Pembelajaran Dosen";
	
	switch($act){
		default:
			if($ss_level==2){
				$cnpage="<meta http-equiv=\"refresh\" content=\"0;url=?pages=$pages&act=pilih\" />";
			}else{
				$cnpage="<form name=\"fkuisioner\" method=\"get\" action=\"?pages=$pages&act=pilih\"/>
					<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
					<input type=\"hidden\" name=\"act\" value=\"pilih\" />
					
					<table class='pad5'>
						<tr>
							<td>Masukkan Nim</td>
							<td width='10'>:</td>
							<td><input type=\"text\" name=\"gname\" size=\"30\" autocomplete=\"off\" required/></td>
						</tr>
						<tr>
							<td>Tahun Akademik</td>
							<td>:</td>
							<td>".SelTahunMasuk($gbase, "gbase", "required")."</td>
						</tr>
						<tr>
							<td>Semester Ajar</td>
							<td>:</td>
							<td>".SelSemester($gp, "gp", "", "required")."</td>
						</tr>
					</table><br />
					<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				</form>";
			}
		break;
		
		case"pilih":
			$title_page.=" &raquo; Pilih Dosen";
			
			if($ss_level==2){
				$link_back="?pages=home";
				$sqld="select * from $nama_table8 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\" and id_kategori like \"%,1,%\" order by tahun_ajar desc, semester desc limit 1";
				
				$gname="$ss_user";
				$meta="";
			}else{
				$link_back="?pages=$pages";
				$gbase="$gbase";
				$gp="$gp";
				$gname="$gname";
				
				#$sqld="select * from $nama_table8 where tahun_ajar=\"$gbase\" and semester=\"$gp\"";
				$sqld="select * from $nama_table8 limit 1";
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
			
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				
				if($ss_level==2){
					$gbase=$fdata["tahun_ajar"];
					$gp=$fdata["semester"];
				}else{
					$gbase=$gbase;
					$gp=$gp;
				}
				
				include"setting/kon_baa.php";
				
				#ambil data mahasiswa
				$sqld="select * from $nama_table4 where kode_siswa=\"$gname\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$xprodi=NamaProdi($ref_program_studi);
					$nama_prodi=$xprodi["nama_depart"];
					
					$nama_semester=SelSemester($gp, "gp", "1");
					
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
					
					#ambil data dosen
					#ambil data dosen
					$sqld2="SELECT b.no_dosen, b.no_dosen1, b.id_gabung FROM $nama_table AS a ".
							"INNER JOIN $nama_table3 AS b ON a.id_kurikulum = b.id_kurikulum ".
							"where a.kode_siswa=\"$kode_siswa\" and a.tahun_ajar=\"$gbase\" and a.semester_ajar=\"$gp\"";
					$data2=mysql($neomaa, $sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						$id_dosen=array();
						$gb="";
						
						while($fdata2=mysql_fetch_assoc($data2)){
							extract($fdata2);
							$gb.=((int)$id_gabung>0)? "'$id_gabung'," : "";
							
							$id_dosen[]=(!empty($no_dosen))? "$no_dosen" : "";
							$id_dosen[]=(!empty($no_dosen1))? "$no_dosen1" : "";
						}
						
						$gb=substr($gb,0,-1);
						if(!empty($gp)){
							$sqld3="select no_dosen, no_dosen1 from $nama_table3 where id_gabung in ($gb)";
							$data3=mysql($neomaa, $sqld3);
							$ndata3=mysql_num_rows($data3);
							if($ndata3>0){
								while($fdata3=mysql_fetch_assoc($data3)){
									extract($fdata3);
									
									$id_dosen[]=(!empty($no_dosen))? "$no_dosen" : "";
									$id_dosen[]=(!empty($no_dosen1))? "$no_dosen1" : "";
								}
							}
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
						
						$sqld3="select * from $nama_table5 where no_dosen in ($dosen) and ref_aktivasiDosen in ('A') ".
								"order by namaDosen asc";
						$data3=mysql($neomaa, $sqld3);
						$ndata3=mysql_num_rows($data3);
						if($ndata3>0){ $no=1;
							while($fdata3=mysql_fetch_assoc($data3)){
								extract($fdata3);
								$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
								$cekstatus=CekKuis($gbase, $gp, $kode_siswa, $no_dosen);
								
								if($cekstatus>0){
									$ket_status="Sudah";
									$edit_kuis="Edit Kuesioner";
									$bg_tr="bgcolor='#f2f4f7'";
								}else{
									$ket_status="Belum";
									$edit_kuis="Isi Kuesioner";
									$bg_tr="";
								}
								$link_page="?pages=$pages&act=kuis&gname=$gname&gbase=$gbase&gp=$gp&gid=$no_dosen";
								$detail="<a href=\"$link_page\" class=\"blink\">$edit_kuis</a>";
								
								$td_table.="<tr $bg_tr>
									<td>$no</td>
									<td>$nama_dosen</td>
									<td>$ket_status</td>
									<td>$detail</td>
								</tr>";
								
								$no++;
							}
							
							$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
								<thead> 
									<tr> 
					   					<th width='10'>No</th> 
					    				<th>Nama Dosen</th>
					    				<th>Status Kuesioner</th>
					    				<th width='150'>Aksi</th>
									</tr> 
								</thead> 
								<tbody>
									$td_table
								</tbody>
							</table><br /><br />";
						}
						
						$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>";
					}else{
						$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil Mata Kuliah Aktif</h4><br />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
						<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
		
		case"kuis":
			$title_page.=" &raquo; Kuesioner Dosen";
			
			if($ss_level==2){
				$link_back="?pages=home";
				
				$sqld="select * from $nama_table8 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\" and id_kategori like \"%,1,%\" order by tahun_ajar desc, semester desc limit 1";
				
				$gname="$ss_user";
				$meta="";
				$link21="";
			}else{
				$link_back="?pages=$pages";
				$gbase="$gbase";
				$gp="$gp";
				$gname="$gname";
				
				$sqld="select * from $nama_table8 where tahun_ajar=\"$gbase\" and semester=\"$gp\"";
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
				$link21="&gname=$gname&gbase=$gbase&gp=$gp";
			}
			
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				$gp=$fdata["semester"];
				
				include"setting/kon_baa.php";
				
				$sqld="select * from $nama_table4 where kode_siswa=\"$gname\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$xprodi=NamaProdi($ref_program_studi);
					$nama_prodi=$xprodi["nama_depart"];
					
					$nama_semester=SelSemester($gp, "gp", "1");
					$nama_dosen=NamaDosen($gid);
					
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
							
							<td>Dosen</td>
							<td>:</td>
							<td>$nama_dosen</td>
						</tr>
						
					</table>
					<hr/><br />";
					
					$sqld2="SELECT b.no_dosen, b.no_dosen1 FROM $nama_table AS a ".
							"INNER JOIN $nama_table3 AS b ON a.id_kurikulum = b.id_kurikulum ".
							"where a.kode_siswa=\"$kode_siswa\" and a.tahun_ajar=\"$gbase\" and a.semester_ajar=\"$gp\" ".
							"and (b.no_dosen=\"$gid\" or b.no_dosen1=\"$gid\") limit 1";
					$data2=mysql($neomaa, $sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						$fdata2=mysql_fetch_assoc($data2);
						extract($fdata2);
						
						include"setting/kon.php";
						$sqld3="select * from $nama_table6 where hapus=\"0\" and status=\"1\" and kategori=\"$kategori\" ".
								"order by urutan asc";
						$data3=mysql_query($sqld3);
						$ndata3=mysql_num_rows($data3);
						if($ndata3>0){
							$cnpage.="<form name=\"form1\" method=\"post\" action=\"?pages=$pages&act=proses\">
								<input type=\"hidden\" name=\"nim\" value=\"$gname\" />
								<input type=\"hidden\" name=\"tahun_ajar\" value=\"$gbase\" />
								<input type=\"hidden\" name=\"semester\" value=\"$gp\" />
								<input type=\"hidden\" name=\"nodosen\" value=\"$gid\" />
								<input type=\"hidden\" name=\"prodi\" value=\"$ref_program_studi\" />";
							
							while($fdata3=mysql_fetch_assoc($data3)){
								$id_bagian=$fdata3["id"];
								$nama_bagian=$fdata3["bagian"];
								
								$sqld4="select * from $nama_table7 where hapus=\"0\" and status=\"1\" ".
										"and bagian=\"$id_bagian\" order by urutan asc";
								$data4=mysql_query($sqld4);
								$ndata4=mysql_num_rows($data4);
								if($ndata4>0){ $no=1;
									while($fdata4=mysql_fetch_assoc($data4)){
										extract($fdata4);
										$radio_name="pilih_"."$id_bagian"."_"."$id";
										$ck=CekKuis($gbase, $gp, $gname, $gid, "$id_bagian#$id");
										
										$ck1=($ck["ck1"]==1)? "checked=\"checked\"" : "";
										$ck2=($ck["ck2"]==1)? "checked=\"checked\"" : "";
										$ck3=($ck["ck3"]==1)? "checked=\"checked\"" : "";
										$ck4=($ck["ck4"]==1)? "checked=\"checked\"" : "";
										
										$td_table.="<tr>
											<td>$no</td>
											<td>$pertanyaan</td>
											<td align='center'>
												<input type=\"radio\" name=\"$radio_name\" value=\"1\" $ck1 required/>
											</td>
											<td align='center'>
												<input type=\"radio\" name=\"$radio_name\" value=\"2\" $ck2 required/>
											</td>
											<td align='center'>
												<input type=\"radio\" name=\"$radio_name\" value=\"3\" $ck3 required/>
											</td>
											<td align='center'>
												<input type=\"radio\" name=\"$radio_name\" value=\"4\" $ck4 required/>
											</td>
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
							
							$cnpage.="<input type=\"submit\" name=\"proses\" value=\"Proses\" onclick=\"return confirm('Apakah Anda Yakin dengan Isian Anda?')\" />
								<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back&act=pilih$link21'\"/>	
							</form>";
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil Mata Kuliah Aktif</h4><br />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
						<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
		
		case"proses":
			$title_page.=" &raquo; Proses Data";
			extract($_POST);
			$kuis_table=CreateTable($tahun_ajar, $semester);
			
			$sqld="SELECT a.*, b.id as idp FROM $nama_table6 AS a INNER JOIN $nama_table7 AS b ON ".
					"a.id = b.bagian where a.hapus=\"0\" and b.hapus=\"0\" and a.`status`=\"1\" ".
					"and b.`status`=\"1\" and a.kategori=\"$kategori\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				while($fdata=mysql_fetch_assoc($data)){
					$id_bagian=$fdata["id"];
					$id_pertanyaan=$fdata["idp"];
					
					$radio_name="pilih_"."$id_bagian"."_"."$id_pertanyaan";
					$post_bp=$_POST[$radio_name];
					
					$ck1=($post_bp=="1")? "1" : "0";
					$ck2=($post_bp=="2")? "1" : "0";
					$ck3=($post_bp=="3")? "1" : "0";
					$ck4=($post_bp=="4")? "1" : "0";
					
					$sqld2="select * from $kuis_table where tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" ".
							"and nim=\"$nim\" and bagian=\"$id_bagian\" and id_pertanyaan=\"$id_pertanyaan\" ".
							"and no_dosen=\"$nodosen\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2==0){
						$vdata="tahun_ajar, semester, bagian, id_pertanyaan, no_dosen, nim, prodi, ";
						$vdata.="isi_kurang_s, isi_kurang, isi_baik, isi_baik_s, tanggal_insert";
						
						$vvalue="\"$tahun_ajar\", \"$semester\", \"$id_bagian\",\"$id_pertanyaan\", \"$nodosen\", ";
						$vvalue.="\"$nim\", \"$prodi\", \"$ck1\", \"$ck2\", \"$ck3\", \"$ck4\", \"$ndatetime\"";
						
						$inp="insert into $kuis_table ($vdata) values ($vvalue)";
						@mysql_query($inp);
					}
					elseif($ndata2==1){
						$vdata="isi_kurang_s=\"$ck1\", isi_kurang=\"$ck2\", isi_baik=\"$ck3\", isi_baik_s=\"$ck4\", ";
						$vdata.="tanggal_insert=\"$ndatetime\"";
						
						$vvalue="tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" and bagian=\"$id_bagian\" ";
						$vvalue.="and id_pertanyaan=\"$id_pertanyaan\" and no_dosen=\"$nodosen\" and nim=\"$nim\"";
						
						$inp="update $kuis_table set $vdata where $vvalue";
						@mysql_query($inp);
					}
				}
				
				if($ss_level==2){
					$link_back="?pages=$pages&act=pilih";
				}else{
					$link_back="?pages=$pages&act=pilih&gname=$nim&gbase=$tahun_ajar&gp=$semester";
				}
				
				$cnpage="<h4 class=\"alert_warning\">Data Berhasil Diproses</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
	}
}
?>
