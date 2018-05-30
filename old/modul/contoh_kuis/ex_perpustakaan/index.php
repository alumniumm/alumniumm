<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="master_siswa";
	
	$nama_table2="db_bagian";
	$nama_table3="db_pertanyaan";
	$nama_table4="db_tgl_kuis";
	
	$kategori="3";
	$title_page="Kuesioner Perpustakaan";
	
	switch($act){
		default:
			if($ss_level==2){
				echo"<meta http-equiv=\"refresh\" content=\"0;url=?pages=$pages&act=kuis\" />";
			}else{
				$cnpage="<form name=\"fkuisioner\" method=\"get\" action=\"?pages=$pages&act=kuis\"/>
					<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
					<input type=\"hidden\" name=\"act\" value=\"kuis\" />
					
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
		
		case"kuis":
			$title_page.=" &raquo; Kuesioner Perpustakaan";
			
			if($ss_level==2){
				$link_back="?pages=home";
				$sqld="select * from $nama_table4 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\"";
				
				$gname="$ss_user";
				$meta="";
			}else{
				$link_back="?pages=$pages";
				$gbase="$gbase";
				$gp="$gp";
				$gname="$gname";
				
				$sqld="select * from $nama_table4 where tahun_ajar=\"$gbase\" and semester=\"$gp\"";
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
			
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				$gp=$fdata["semester"];
				
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table where kode_siswa=\"$gname\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$xprodi=NamaProdi($ref_program_studi);
					$nama_prodi=$xprodi["nama_depart"];
					$nama_fakultas=$xprodi["namaFakultas"];
					$kode_fakultas=$xprodi["kodeFakultas"];
					$nama_semester=SelSemester($gp, "gp", "1");
						
					include"setting/kon.php";
					$sql="SELECT * FROM db_lokasi_perpus where status=\"1\" and hapus=\"0\" ";
					$hs = mysql_query($sql);
					$hit = mysql_num_rows($hs);
					while($dat=mysql_fetch_array($hs)){
					$idPerpus=$dat[id];
					$cek = CekPerpusKuisioner($gbase,$gp,$gname,$idPerpus,"1");
					
					$lbuton1=($ss_level!=2)? "&gname=$gname&gbase=$gbase&gp=$gp" : "";
					$button="<a href=\"?pages=$pages&act=kuis2$lbuton1&idperpus=$idPerpus&j=1\" class=\"blink\">Isi Kuisioner</a>";
					$Tperp .="<tr>
					<td>$dat[nama_perpus]</td>
					<td>$cek</td>
					<td>$button</td>
					</tr>";
					}
					$cek1 = CekPerpusKuisioner($gbase,$gp,$gname,$kode_fakultas,"2");
					$button2="<a href=\"?pages=$pages&act=kuis2$lbuton1&proses=Proses&idperpus=$kode_fakultas&j=2\" class=\"blink\">Isi Kuisioner</a>";
					
					$cek2 = CekPerpusKuisioner($gbase,$gp,$gname,$ref_program_studi,"3");
					$button3="<a href=\"?pages=$pages&act=kuis2$lbuton1&proses=Proses&idperpus=$ref_program_studi&j=3\" class=\"blink\">Isi Kuisioner</a>";
					
					
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
					<hr/><br />
					
					<table class='tablesorter'>
					<thead>
					<tr>
					<th>Perpustakaan</th><th>Status Kuisioner</th><th>Aksi</th>
					</tr>
					</thead>
					<tbody>
					$Tperp
					</tbody>
					<thead>
					<th colspan='3'>&nbsp;</th>
					</thead>
					<tbody>
					<tr>
					<td>Perpustakaan $nama_fakultas</td><td>$cek1</td><td>$button2</td>
					</tr>
					<tr>
					<td>Perpustakaan Program Studi $nama_prodi</td><td>$cek2</td><td>$button3</td>
					</tr>
					</tbody>
					</table>";
				
				

				}
			}else{
				/*$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";*/
			}
		break;
		
		case"kuis2":
			if($ss_level==2){
				$link_back="?pages=home";
				$sqld="select * from $nama_table4 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\"";
				
				$gname="$ss_user";
				$meta="";
			}else{
				$link_back="?pages=$pages";
				$gbase="$gbase";
				$gp="$gp";
				$gname="$gname";
				
				$sqld="select * from $nama_table4 where tahun_ajar=\"$gbase\" and semester=\"$gp\"";
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
			
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				$gp=$fdata["semester"];
			
				$IDperpus = $_GET['idperpus'];
				$JPerpus = $_GET['j'];
				/*Jenis perpus
				1=Perpus Universitas
				3.Perpus Fakultas*/
				if($JPerpus==3){
				include"setting/kon_baa.php";
		
				$sqld="SELECT a.nama_depart FROM in_programstudi AS a where a.kode=\"$IDperpus\"";
				$data=mysql($neomaaref, $sqld);
				$fdata=mysql_fetch_assoc($data);
				
				$NamaPerpus = $fdata['nama_depart'];
				}
				if($JPerpus==2){
				
				include"setting/kon_baa.php";
				$sqld="SELECT namaFakultas FROM in_fakultas  where kode=\"$IDperpus\" ";
				$data=mysql($neomaaref, $sqld);
				$fdata=mysql_fetch_assoc($data);
				
				$NamaPerpus = $fdata['namaFakultas'];
				
				}
				if($JPerpus==1){
				include"setting/kon.php";
				$qr="SELECT nama_perpus,alamat FROM db_lokasi_perpus WHERE id = \"$IDperpus\" ";
				$data=mysql_query($qr);
				$fdata=mysql_fetch_assoc($data);
				
				$NamaPerpus = $fdata['nama_perpus'];
				}
				
				$title_page.=" &raquo; $NamaPerpus";
				
				$error.=(empty($gbase))? "Tahun Akademik Masih Kosong<br />" : "";
				$error.=(empty($gp))? "Semester Masih Kosong<br />" : "";
				
				if(empty($error)){
					include"setting/kon.php";
					$sqld="select * from $nama_table4 where tahun_ajar=\"$gbase\" and semester=\"$gp\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						
						include"setting/kon_baa.php";
						$sqld="select * from $nama_table where kode_siswa=\"$gname\"";
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
									
									<td>Nama Perpustakaan</td>
									<td>:</td>
									<td>$NamaPerpus</td>
								</tr>
								
							</table>
							<hr/><br />";
							
							include"setting/kon.php";
							$kuis_table=CreateTableZperpus($gbase, $gp);
							$kuis_table_saran="$kuis_table"."_saran";
							$arr_bp=CekPerpus($kuis_table, $kode_siswa, $gbase, $gp,$JPerpus,$IDperpus);
							
							$sqld5="select * from $kuis_table_saran where nim=\"$kode_siswa\" and tahun_ajar=\"$gbase\" ".
									"and semester=\"$gp\" and jenis_perpus=\"$JPerpus\" and id_perpus=\"$IDperpus\" ";
							$data5=mysql_query($sqld5);
							$ndata5=mysql_num_rows($data5);
							if($ndata5>0){
								$fdata2=mysql_fetch_assoc($data5);
								$saran=$fdata2["saran"];
							}
								
							$sqld3="select * from $nama_table2 where kategori=\"$kategori\" and hapus=\"0\" ".
									"and status=\"1\" order by urutan asc";
							$data3=mysql_query($sqld3);
							$ndata3=mysql_num_rows($data3);
							if($ndata3>0){
								$cnpage.="<form name=\"form1\" method=\"post\" action=\"?pages=$pages&act=proses\">
									<input type=\"hidden\" name=\"nim\" value=\"$gname\" />
									<input type=\"hidden\" name=\"tahun_ajar\" value=\"$gbase\" />
									<input type=\"hidden\" name=\"semester\" value=\"$gp\" />
									<input type=\"hidden\" name=\"prodi\" value=\"$ref_program_studi\" />
									<input type=\"hidden\" name=\"IDperpus\" value=\"$IDperpus\" />
									<input type=\"hidden\" name=\"Jperpus\" value=\"$JPerpus\" />";
								
								while($fdata3=mysql_fetch_assoc($data3)){
									$id_bagian=$fdata3["id"];
									$nama_bagian=$fdata3["bagian"];
									
									$sqld4="select * from $nama_table3 where hapus=\"0\" and status=\"1\" ".
											"and bagian=\"$id_bagian\" order by urutan asc";
									$data4=mysql_query($sqld4);
									$ndata4=mysql_num_rows($data4);
									if($ndata4>0){ $no=1;
										while($fdata4=mysql_fetch_assoc($data4)){
											extract($fdata4);
											$radio_name="pilih_"."$id_bagian"."_"."$id";
											$namefd4="$id_bagian"."$id";
											
											$ck1=($arr_bp["$namefd4"]==1)? "checked=\"checked\"" : "";
											$ck2=($arr_bp["$namefd4"]==2)? "checked=\"checked\"" : "";
											$ck3=($arr_bp["$namefd4"]==3)? "checked=\"checked\"" : "";
											$ck4=($arr_bp["$namefd4"]==4)? "checked=\"checked\"" : "";
											
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
								
								$cnpage.="<h2>Saran</h2><hr />
								<table class=\"tablesorter\" cellspacing=\"0\"> 
									<tbody>
										<tr>
											<textarea name=\"saran\" cols=\"50\" rows=\"5\" required>$saran</textarea>
										</tr>
									</tbody>
								</table><br /><br/>";
								
								$cnpage.="<input type=\"submit\" name=\"proses\" value=\"Proses\" onclick=\"return confirm('Apakah Anda Yakin dengan Isian Anda?')\" />
									<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=kuis&gname=$gname&gbase=$gbase&gp=$gp'\"/>	
								</form>";
							}
						}else{
							$cnpage="<h4 class=\"alert_warning\">Mahasiswa Tidak Mengambil Mata Kuliah Aktif</h4><br />
							<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
							<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
						}
					}else{
						$nama_semester=SelSemester($gp, "gp", "1");
						$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner untuk Tahun Akademik $gbase dan Semester $nama_semester Belum Disetting</h4><br />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
						<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
					}
				}else{
					$cnpage="<h4 class=\"alert_warning\">$error</h4><br />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
						<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner Belum Disetting</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"proses":
			$JPerpus = $_POST['Jperpus'];
			$title_page.=" &raquo; Proses Data";
			extract($_POST);
			$kuis_table=CreateTableZperpus($tahun_ajar, $semester);
			$kuis_table_saran="$kuis_table"."_saran";
			
			$sqld="SELECT a.*, b.id as idp FROM $nama_table2 AS a INNER JOIN $nama_table3 AS b ON ".
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
							"and nim=\"$nim\" and bagian=\"$id_bagian\" and id_pertanyaan=\"$id_pertanyaan\" and jenis_perpus=\"$JPerpus\" and id_perpus=\"$IDperpus\" ";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2==0){
						$vdata="tahun_ajar, semester, bagian, id_pertanyaan, nim, prodi,id_perpus,jenis_perpus, ";
						$vdata.="isi_kurang_s, isi_kurang, isi_baik, isi_baik_s, tanggal_insert";
						
						$vvalue="\"$tahun_ajar\", \"$semester\", \"$id_bagian\",\"$id_pertanyaan\", \"$nim\", \"$prodi\",\"$IDperpus\",\"$JPerpus\", ";
						$vvalue.= "\"$ck1\", \"$ck2\", \"$ck3\", \"$ck4\", \"$ndatetime\"";
						
						$inp="insert into $kuis_table ($vdata) values ($vvalue)";
						mysql_query($inp);
					}
					elseif($ndata2==1){
						$vdata="isi_kurang_s=\"$ck1\", isi_kurang=\"$ck2\", isi_baik=\"$ck3\", isi_baik_s=\"$ck4\", ";
						$vdata.="tanggal_insert=\"$ndatetime\"";
						
						$vvalue="tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" and bagian=\"$id_bagian\" and id_perpus=\"$IDperpus\" and jenis_perpus=\"$JPerpus\" ";
						$vvalue.="and id_pertanyaan=\"$id_pertanyaan\" and nim=\"$nim\"";
						
						$inp="update $kuis_table set $vdata where $vvalue";
						mysql_query($inp);
					}
				}
				
				$sqld3="SELECT * FROM $kuis_table_saran where nim=\"$nim\" and tahun_ajar=\"$tahun_ajar\" ".
						"and semester=\"$semester\" and jenis_perpus=\"$JPerpus\" and id_perpus=\"$IDperpus\" ";
				$data3=mysql_query($sqld3);
				$ndata3=mysql_num_rows($data3);
				if($ndata3==0){
					$vdata2="tahun_ajar, semester, nim, prodi, saran, jenis_perpus, id_perpus, tanggal_insert";
					$vvalue2="\"$tahun_ajar\", \"$semester\", \"$nim\", \"$prodi\", \"$saran\", \"$JPerpus\", \"$IDperpus\", \"$ndatetime\"";
					
					$inp2="insert into $kuis_table_saran ($vdata2) values ($vvalue2)";
					mysql_query($inp2);
				}elseif($ndata3==1){
					$vdata2="saran=\"$saran\", tanggal_insert=\"$ndatetime\"";
					$vvalue2="tahun_ajar=\"$tahun_ajar\" and semester=\"$semester\" and nim=\"$nim\"";
					
					$inp2="update $kuis_table_saran set $vdata2 where $vvalue2";
					mysql_query($inp2);
				}
				
				$link_back="?pages=$pages";
				$cnpage="<h4 class=\"alert_warning\">Data Berhasil Diproses</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2000;url=$link_back\">";
			}
		break;
	}
}
?>
