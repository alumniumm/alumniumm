<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="master_dosen";
	$nama_table2="transaksi_homebase";
	
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	$nama_table5="db_tgl_kuis";
	
	$kategori="6";
	$idkat="2";
	$title_page="Kuesioner Kinerja Dosen";
	
	switch($act){
		default:
			$cnpage="<form name=\"fkuisioner\" method=\"get\" action=\"?pages=$pages&act=pilih\"/>
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				<input type=\"hidden\" name=\"act\" value=\"pilih\" />
				
				<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td width='10'>:</td>
						<td>".SelTahunMasuk($gbase, "gbase", "required")."</td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"proses\" value=\"Proses\" />
			</form>";
		break;
		
		case"pilih":
			$title_page.=" &raquo; Pilih Dosen";
			$link_page="?pages=$pages&act=$act&gbase=$gbase";
			
			$sqld="select * from $nama_table5 where tahun_ajar=\"$gbase\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$cnpage.="<form name=\"fkuisioner\" method=\"get\" action=\"?pages=$pages&act=pilih\"/>
					<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
					<input type=\"hidden\" name=\"act\" value=\"$act\" />
					<input type=\"hidden\" name=\"gbase\" value=\"$gbase\" />
					
					<table class='pad5'>
						<tr>
							<td>Tahun Akademik</td>
							<td width='10'>:</td>
							<td>$gbase</td>
						</tr>
						<tr>
							<td>Nama Dosen</td>
							<td>:</td>
							<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
						</tr>
					</table><br />
					<input type=\"submit\" name=\"cari\" value=\"Cari\" /> 
					<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='$link_page'\"/>
				</form>
				<hr/><br />";
				
				include"setting/kon_baa.php";
				#ambil data dosen
				$posisi=cariPosisi($batas, $hal);
				$sqld="SELECT a.*, b.ref_prodi FROM $nama_table AS a LEFT JOIN $nama_table2 AS b ".
						"ON a.no_dosen = b.no_dosen where a.ref_aktivasiDosen=\"A\" and namaDosen like \"%$gname%\" ".
						"order by a.namaDosen asc";
				$data=mysql($neomaa, $sqld." limit $posisi,$batas");
				$ndata=mysql_num_rows($data);
				if($ndata>0){$no=1;
					while($fdata=mysql_fetch_assoc($data)){
						extract($fdata);
						$cekstatus=CekKuisProdi($gbase, $no_dosen, $idkat);
						$xprodi=NamaProdi($ref_prodi);
						$nama_prodi=$xprodi["nama_depart"];
						$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
						
						if($cekstatus>0){
							$ket_status="Sudah";
							$edit_kuis="Edit Kuesioner";
							$bg_tr="bgcolor='#f2f4f7'";
						}else{
							$ket_status="Belum";
							$edit_kuis="Isi Kuesioner";
							$bg_tr="";
						}
						
						$link_detail="?pages=$pages&act=kuis&gbase=$gbase&gid=$no_dosen";
						$detail="<a href=\"$link_detail\" class=\"blink\">$edit_kuis</a>";
						
						$td_table.="<tr $bg_tr>
							<td>$no</td>
							<td>$nama_dosen</td>
							<td>$nama_prodi</td>
							<td>$ket_status</td>
							<td>$detail</td>
						</tr>";
						
						$no++;
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
			   					<th width='10'>No</th> 
			    				<th>Nama Dosen</th>
			    				<th>Program Studi</th>
			    				<th>Status Kuesioner</th>
			    				<th width='150'>Aksi</th>
							</tr> 
						</thead> 
						<tbody>
							$td_table
						</tbody>
					</table>
					<div class=\"clear\"></div>
					$thal
					<br /><br />";
					
					$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>";
				}else{
					$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Tanggal Kuesioner untuk Tahun Akademik $gbase Belum Disetting</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"kuis":
			$title_page.=" &raquo; Kuesioner";
			$error.=(empty($gbase) or strstr("/", $gbase))? "Tahun Akademik Masih Kosong<br />" : "";
			
			if(empty($error)){
				$tabel_kuis=CreateTableKdosen($gbase);
	
				include"setting/kon_baa.php";
				$sqld="SELECT a.*, b.ref_prodi FROM $nama_table AS a LEFT JOIN $nama_table2 AS b ".
						"ON a.no_dosen = b.no_dosen where a.ref_aktivasiDosen=\"A\" and a.no_dosen=\"$gid\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){$no=1;
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$xprodi=NamaProdi($ref_prodi);
					$nama_prodi=$xprodi["nama_depart"];
					$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
					
					$cnpage.="<table class='pad5'>
						<tr>
							<td>Tahun Akademik</td>
							<td width='10'>:</td>
							<td>$gbase</td>
						</tr>
						<tr>
							<td>Nama Dosen</td>
							<td>:</td>
							<td>$nama_dosen</td>
						</tr>
						<tr>
							<td>Program Studi/Homebase</td>
							<td>:</td>
							<td>$nama_prodi</td>
						</tr>
					</table>
					<hr /><br />";
					
					$cnpage.="<form name=\"form1\" method=\"post\" action=\"?pages=$pages&act=proses\">
							<input type=\"hidden\" name=\"tahun_ajar\" value=\"$gbase\" />
							<input type=\"hidden\" name=\"iddosen\" value=\"$gid\" />";
					
					include"setting/kon.php";
					$tr_table="";
					
					$sqld2="select * from $nama_table3 where hapus=\"0\" and status=\"1\" and kategori=\"$kategori\" ".
							"order by urutan asc";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){
						while($fdata2=mysql_fetch_assoc($data2)){
							$id_bagian=$fdata2["id"];
							$nama_bagian=$fdata2["bagian"];
							
							$td_table="";
							$sqld3="select * from $nama_table4 where hapus=\"0\" and status=\"1\" ".
									"and bagian=\"$id_bagian\" order by urutan asc";
							$data3=mysql_query($sqld3);
							$ndata3=mysql_num_rows($data3);
							if($ndata3>0){ $no=1;
								while($fdata3=mysql_fetch_assoc($data3)){
									extract($fdata3);
									$ck=CekKuisProdiData($gbase, $gid, "pert", "$id_bagian#$id", $jenis, $id_pertanyaan, $keterangan, $idkat);
									$ket_sk=KetJenisInputan($jenis, $keterangan, $standart, $standart2);
									$ck_ket=$ket_sk["ket"];
									
									if($no==1){
										$td_table.="<tr>
											<td rowspan='$ndata3'>$nama_bagian</td>
											<td>$pertanyaan</td>
											<td>$ck_ket</td>
											<td>$ck</td>
										</tr>";
									}else{
										$td_table.="<tr>
											<td>$pertanyaan</td>
											<td>$ck_ket</td>
											<td>$ck</td>
										</tr>";
									}
									
									$no++;
								}
								
							}
							
							$tr_table.="$td_table";
						}
						
						$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
							<thead> 
								<tr>
				    				<th width='180'>Kegiatan Kinerja</th>
				    				<th width='200'>Parameter Kinerja</th>
				    				<th>Standart Kinerja</th>
				    				<th>Capaian Kinerja</th>
								</tr> 
							</thead> 
							<tbody>
								$tr_table
							</tbody>
						</table><br />";
					}
					
					$cnpage.="<input type=\"submit\" name=\"proses\" value=\"Proses\" onclick=\"return confirm('Apakah Anda Yakin dengan Isian Anda?')\" />
						<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=pilih&gbase=$gbase'\"/>	
					</form>";
				
				}else{
					$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">$error</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"proses":
			$title_page.=" &raquo; Proses Data";
			extract($_POST);
			$kuis_table=CreateTableKdosen($tahun_ajar);
			
			$sqld="SELECT a.*, b.id as idp, b.id_pertanyaan, b.jenis FROM $nama_table3 AS a INNER JOIN ".
					"$nama_table4 AS b ON a.id=b.bagian where a.hapus=\"0\" and b.hapus=\"0\" and ".
					"a.`status`=\"1\" and b.`status`=\"1\" and a.kategori=\"$kategori\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				while($fdata=mysql_fetch_assoc($data)){
					$id_bagian=$fdata["id"];
					$id_pert=$fdata["idp"];
					$jenis=$fdata["jenis"];
					
					$radio_name="standart_$jenis"."pert_$id_bagian"."_"."$id_pert";
					$radio_name2="standart2_$jenis"."pert_$id_bagian"."_"."$id_pert";
					
					$post_bp=$_POST[$radio_name];
					$post_bp2=$_POST[$radio_name2];
					
					$sqld2="select * from $kuis_table where tahun_ajar=\"$tahun_ajar\" and id_dosen=\"$iddosen\" and ".
							"bagian=\"$id_bagian\" and id_pertanyaan=\"$id_pert\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2==0){
						$vdata="tahun_ajar, bagian, id_pertanyaan, id_dosen, isi_standart, ";
						$vdata.="isi_standart2, tanggal_insert";
						
						$vvalue="\"$tahun_ajar\",\"$id_bagian\",\"$id_pert\", \"$iddosen\", ";
						$vvalue.="\"$post_bp\", \"$post_bp2\", \"$ndatetime\"";
						
						$inp="insert into $kuis_table ($vdata) values ($vvalue)";
						@mysql_query($inp);
					}
					elseif($ndata2==1){
						$vdata="isi_standart=\"$post_bp\", isi_standart2=\"$post_bp2\", tanggal_insert=\"$ndatetime\"";
						
						$vvalue="tahun_ajar=\"$tahun_ajar\" and bagian=\"$id_bagian\" ";
						$vvalue.="and id_pertanyaan=\"$id_pert\" and id_dosen=\"$iddosen\"";
						
						$inp="update $kuis_table set $vdata where $vvalue";
						@mysql_query($inp);
					}
				}
				
				$link_back="?pages=$pages&act=pilih&gbase=$tahun_ajar";
				$cnpage="<h4 class=\"alert_warning\">Data Berhasil Diproses</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}
		break;
	}
}
?>
