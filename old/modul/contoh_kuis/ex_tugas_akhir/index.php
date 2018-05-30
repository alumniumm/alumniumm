<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="transaksi_tugas_akhir";
	$nama_table2="transaksi_tugas_akhir_dosen";
	$nama_table3="master_siswa";
	$nama_table4="master_dosen";
	
	$nama_table5="db_bagian";
	$nama_table6="db_pertanyaan";
	$nama_table7="db_tgl_kuis";
	$nama_table8="master_siswa_wisuda";
	
	$kategori="4";
	$title_page="Kuesioner Pembimbingan Tugas Akhir";
	
	switch($act){
		default:
			if($ss_level==2){
				echo"<meta http-equiv=\"refresh\" content=\"0;url=?pages=$pages&act=pilih\" />";
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
					</table><br />
					<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				</form>";
			}
		break;
		
		case"pilih":
			$title_page.=" &raquo; Pilih Dosen Pembimbing";
			
			if($ss_level==2){
				$link_back="?pages=home";
				
				$gname="$ss_user";
				$meta="";
				$link21="";
			}else{
				$link_back="?pages=$pages";
				$gname="$gname";
				
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
				$link21="&gname=$gname&gbase=$gbase&gp=$gp";
			}
			
			$sqld="select * from $nama_table7 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
					"and status=\"0\" order by tanggal_awal desc, id desc";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				$gp=$fdata["semester"];
				
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table8 where kode_siswa=\"$gname\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					$tahun_wisuda=$fdata["tahun"];
					$periode_wisuda=$fdata["periode"];
					
					$sqld="select * from $nama_table where kode_siswa=\"$gname\"";
					$data=mysql($neomaa, $sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$judul=$fdata["judul"];
						
						#ambil data mahasiswa
						$sqld="select * from $nama_table3 where kode_siswa=\"$gname\"";
						$data=mysql($neomaa, $sqld);
						$ndata=mysql_num_rows($data);
						if($ndata>0){
							$fdata=mysql_fetch_assoc($data);
							extract($fdata);
							$xprodi=NamaProdi($ref_program_studi);
							$nama_prodi=$xprodi["nama_depart"];
							$nama_semester=SelSemester($gp, "gp", "1");
							
							$arr_dosen=array();
							$tabel_kuis="zdb_ta";
							
							include"setting/kon.php";
							$sqld2="select * from $tabel_kuis where nim=\"$gname\" group by pembimbing ".
									"order by pembimbing asc";
							$data2=@mysql_query($sqld2);
							$ndata2=@mysql_num_rows($data2);
							if($ndata2>0){
								while($fdata2=mysql_fetch_assoc($data2)){
									$p1_dosen=$fdata2["no_dosen"];
									$p1_pmb=$fdata2["pembimbing"];
									$p1_tglins=$fdata2["tanggal_insert"];
									$p1_nama_dosen=NamaDosen($p1_dosen);
									
									list($p1_tglins1, $p1_tglins2)=explode(" ", $p1_tglins);
									
									$arr_dosen[$p1_pmb]="$p1_dosen#$p1_nama_dosen#$p1_tglins1";
								}
							}
							
							#pembimbing 1
							if($arr_dosen[1]!=""){
								$p1_dosen1=$arr_dosen[1];
								list($kode_dosen1, $nama_dosen1, $tgl_ins1)=explode("#", $p1_dosen1);
								
								$detail1="Edit Kuesioner";
							}else{
								$detail1="Isi Kuesioner";
							}
							
							#pembimbing 2
							if($arr_dosen[2]!=""){
								$p1_dosen2=$arr_dosen[2];
								list($kode_dosen2, $nama_dosen2, $tgl_ins2)=explode("#", $p1_dosen2);
								
								$detail2="Edit Kuesioner";
							}else{
								$detail2="Isi Kuesioner";
							}
							
							$link_page="?pages=$pages&act=kuis"."$link21";
							
							if($ss_level==2){
								#if($tgl_ins1==$ndate){
									$detail1="<a href=\"$link_page&gid=1\" class=\"blink\">$detail1</a>";
								#}else{
								#	$detail1="";
								#}
								
								#if($tgl_ins2==$ndate){
									$detail2="<a href=\"$link_page&gid=2\" class=\"blink\">$detail2</a>";
								#}else{
								#	$detail2="";
								#}
							}else{
								$detail1="<a href=\"$link_page&gid=1\" class=\"blink\">$detail1</a>";
								$detail2="<a href=\"$link_page&gid=2\" class=\"blink\">$detail2</a>";
							}
							
							
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
									
									<td>Periode</td>
									<td width='10'>:</td>
									<td>$nama_semester</td>
								</tr>
								<tr>
									<td>Program Studi</td>
									<td width='10'>:</td>
									<td>$nama_prodi</td>
									
									<td>Tahun Wisuda/Periode</td>
									<td>:</td>
									<td>$tahun_wisuda/$periode_wisuda</td>
								</tr>
								
							</table>
							<hr/><br />";
							
							$cnpage.="<div class=\"judulta\">
								<u>Judul Tugas Akhir</u><br />
								$judul
							</div><hr />";
							
							$cnpage.="<table class=\"tablesorter\">
								<thead>
									<tr>
										<th width='10'>No</th>
										<th>Nama Pembimbing</th>
										<th>Pembimbing</th>
										<th width='150'>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>$nama_dosen1</td>
										<td>Pembimbing 1</td>
										<td>$detail1</td>
									</tr>
									<tr>
										<td>2</td>
										<td>$nama_dosen2</td>
										<td>Pembimbing 2</td>
										<td>$detail2</td>
								</tr>
								</tbody>
							</table>";
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Nim Belum Terdaftar Pada Pengambilan Tugas Akhir</h4><br />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
						<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">Nim Belum Terdaftar Sebagai Wisudawan</h4><br />
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
			$title_page.=" &raquo; Kuesioner Dosen Pembimbing";
			
			if($ss_level==2){
				$link_back="?pages=home";
				
				$gname="$ss_user";
				$meta="";
				$link21="";
			}else{
				$link_back="?pages=$pages";
				$gname="$gname";
				
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
				$link21="&gname=$gname&gbase=$gbase&gp=$gp";
			}
			
			$sqld="select * from $nama_table7 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\" order by tanggal_awal desc, id desc";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				$gp=$fdata["semester"];
				
				$tabel_kuis="zdb_ta";
				$tabel_kuis_saran="$tabel_kuis"."_saran";
	
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table3 where kode_siswa=\"$gname\"";
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
					
					include"setting/kon.php";
					$sqld2="SELECT * FROM $tabel_kuis where nim=\"$kode_siswa\" and prodi=\"$ref_program_studi\" ".
							"and pembimbing=\"$gid\" limit 1";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						$fdata2=mysql_fetch_assoc($data2);
						$id_dosen=$fdata2["no_dosen"];
					}
					
					$seldosen="<table class=\"pad5\">
						<tr>
							<td>Dosen Pembimbing</td>
							<td>:</td>
							<td>".SelDosen($id_dosen, "nodosen", "", "required")."</td>
						</tr>
						<tr>
							<td>Pembimbing</td>
							<td>:</td>
							<td>Pembimbing $gid</td>
						</tr>
					</table>";
					
					include"setting/kon.php";
					$sqld3="select * from $nama_table5 where hapus=\"0\" and status=\"1\" and kategori=\"$kategori\" ".
							"order by urutan asc";
					$data3=mysql_query($sqld3);
					$ndata3=mysql_num_rows($data3);
					if($ndata3>0 and ($gid==1 or $gid==2)){
						$cnpage.="<form name=\"form1\" method=\"post\" action=\"?pages=$pages&act=proses&gid=$gid\">
							<input type=\"hidden\" name=\"nim\" value=\"$kode_siswa\" />
							<input type=\"hidden\" name=\"tahun_ajar\" value=\"$gbase\" />
							<input type=\"hidden\" name=\"semester\" value=\"$gp\" />
							<input type=\"hidden\" name=\"prodi\" value=\"$ref_program_studi\" />
							<input type=\"hidden\" name=\"pembimbing\" value=\"$gid\" />
							$seldosen";
							
						while($fdata3=mysql_fetch_assoc($data3)){
							$id_bagian=$fdata3["id"];
							$nama_bagian=$fdata3["bagian"];
							
							$sqld4="select * from $nama_table6 where hapus=\"0\" and status=\"1\" ".
									"and bagian=\"$id_bagian\" order by urutan asc";
							$data4=mysql_query($sqld4);
							$ndata4=mysql_num_rows($data4);
							if($ndata4>0){ $no=1;
								while($fdata4=mysql_fetch_assoc($data4)){
									extract($fdata4);
									$radio_name="pilih_"."$id_bagian"."_"."$id";
									$ck=CekKuisTA($gbase, $gp, $gname, $id_dosen, "$id_bagian#$id");
									
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
						
						#cek saran
						$sqld5="select * from $tabel_kuis_saran where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
								"and nim=\"$kode_siswa\" and no_dosen=\"$id_dosen\" and ".
								"pembimbing=\"$gid\" limit 1";
						$data5=@mysql_query($sqld5);
						$fdata5=@mysql_fetch_assoc($data5);
						$saran=$fdata5["saran"];
						
						$cnpage.="<h2>Komentar Umum</h2><hr />
						<table class=\"tablesorter\" cellspacing=\"0\"> 
							<tbody>
								<tr>
									<textarea name=\"saran\" cols=\"50\" rows=\"5\" required>$saran</textarea>
								</tr>
							</tbody>
						</table><br /><br/>";
						
						$cnpage.="<input type=\"submit\" name=\"proses\" value=\"Proses\" onclick=\"return confirm('Apakah Anda Yakin dengan Isian Anda?')\" />
							<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=pilih$link21'\"/>	
						</form>";
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
			
			if($ss_level==2){
				$link_back="?pages=home";
				
				
				$nim="$ss_user";
				$meta="";
				$link21="";
				$link_back2="?pages=$pages";
			}else{
				$link_back="?pages=$pages";
				$link21="&gname=$gname&gbase=$gbase&gp=$gp";
				$link_back2="?pages=$pages&act=pilih&gname=$nim&gbase=$tahun_ajar&gp=$semester";
			}
			
			$sqld="select * from $nama_table7 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\" order by tanggal_awal desc, id desc";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0 and ($gid==1 or $gid==2)){
			
				$kuis_table="zdb_ta";
				$kuis_table_saran="$kuis_table"."_saran";
				
				$sqld="SELECT a.*, b.id as idp FROM $nama_table5 AS a INNER JOIN $nama_table6 AS b ON ".
						"a.id=b.bagian where a.hapus=\"0\" and b.hapus=\"0\" and a.`status`=\"1\" ".
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
						
						$sqld2="select * from $kuis_table where nim=\"$nim\" and bagian=\"$id_bagian\" ".
								"and id_pertanyaan=\"$id_pertanyaan\" and pembimbing=\"$gid\"";
						$data2=mysql_query($sqld2);
						$ndata2=mysql_num_rows($data2);
						if($ndata2==0){
							$vdata="tahun_ajar, semester, bagian, id_pertanyaan, no_dosen, pembimbing, nim, prodi, ";
							$vdata.="isi_kurang_s, isi_kurang, isi_baik, isi_baik_s, tanggal_insert";
							
							$vvalue="\"$tahun_ajar\", \"$semester\", \"$id_bagian\",\"$id_pertanyaan\", \"$nodosen\", ";
							$vvalue.="\"$pembimbing\", \"$nim\", \"$prodi\", \"$ck1\", \"$ck2\", \"$ck3\", \"$ck4\", ";
							$vvalue.="\"$ndatetime\"";
							
							$inp="insert into $kuis_table ($vdata) values ($vvalue)";
							@mysql_query($inp);
						}
						elseif($ndata2==1){
							$vdata="no_dosen=\"$nodosen\", isi_kurang_s=\"$ck1\", isi_kurang=\"$ck2\", ";
							$vdata.="isi_baik=\"$ck3\", isi_baik_s=\"$ck4\", tanggal_insert=\"$ndatetime\"";
							
							$vvalue="tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" and bagian=\"$id_bagian\" ";
							$vvalue.="and id_pertanyaan=\"$id_pertanyaan\" and nim=\"$nim\" and pembimbing=\"$gid\"";
							
							$inp="update $kuis_table set $vdata where $vvalue";
							@mysql_query($inp);
						}
					}
					
					$sqld3="SELECT * FROM $kuis_table_saran where nim=\"$nim\" and pembimbing=\"$gid\"";
					$data3=mysql_query($sqld3);
					$ndata3=mysql_num_rows($data3);
					if($ndata3==0){
						$vdata2="tahun_ajar, semester, no_dosen, pembimbing, nim, prodi, saran, tanggal_insert";
						$vvalue2="\"$tahun_ajar\", \"$semester\", \"$nodosen\", \"$gid\", \"$nim\", \"$prodi\", ".
									"\"$saran\", \"$ndatetime\"";
						
						$inp2="insert into $kuis_table_saran ($vdata2) values ($vvalue2)";
						mysql_query($inp2);
					}elseif($ndata3==1){
						$vdata2="no_dosen=\"$nodosen\", saran=\"$saran\", tanggal_insert=\"$ndatetime\"";
						$vvalue2="nim=\"$nim\" and pembimbing=\"$gid\"";
						
						$inp2="update $kuis_table_saran set $vdata2 where $vvalue2";
						mysql_query($inp2);
					}
					
					$cnpage="<h4 class=\"alert_warning\">Data Berhasil Diproses</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back2'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=$link_back2\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
	}
}
?>
