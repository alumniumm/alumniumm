<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$nama_table="in_programstudi";
	$nama_table2="in_fakultas";
	
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	$nama_table5="db_tgl_kuis";
	
	$kategori="5";
	$idkat="1";
	$title_page="Kuesioner Kinerja Program Studi";
	
	switch($act){
		default:
			if($ss_level==1){
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
			}else{
				$cnpage="<meta http-equiv=\"refresh\" content=\"0;url=?pages=$pages&act=pilih\" />";
			}
		break;
		
		case"pilih":
			$title_page.=" &raquo; Pilih Program Studi";
			
			if($ss_level==1){
				$link_back="?pages=$pages";
				$gbase="$gbase";
				$gp="$gp";
				$gname="$gname";
				$sw_kode="";
				
				$sqld="select * from $nama_table5 where tahun_ajar=\"$gbase\"";
				$meta="<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
			}else{
				$link_back="?pages=home";
				$sqld="select * from $nama_table5 where tanggal_awal<=\"$ndate\" and tanggal_akhir>=\"$ndate\" ".
						"and status=\"0\"";
				
				$gname="$ss_user";
				$sw_kode="where a.kode=\"$ss_kode\"";
				$meta="";
			}
			
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				$gbase=$fdata["tahun_ajar"];
				
				$cnpage.="<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td width='10'>:</td>
						<td>$gbase</td>
					</tr>
				</table>
				<hr/><br />";
				
				include"setting/kon_baa.php";
				#ambil data prodi
				$sqld="select a.*, b.namaFakultas from $nama_table as a left join $nama_table2 as b on ".
						"b.kode=a.kodeFakultas $sw_kode order by namaFakultas asc, nama_depart asc";
				$data=mysql($neomaaref, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){$no=1;
					while($fdata=mysql_fetch_assoc($data)){
						extract($fdata);
						$cekstatus=CekKuisProdi($gbase, $kode, $idkat);
						
						if($cekstatus>0){
							$ket_status="Sudah";
							$edit_kuis="Edit Kuesioner";
							$bg_tr="bgcolor='#f2f4f7'";
						}else{
							$ket_status="Belum";
							$edit_kuis="Isi Kuesioner";
							$bg_tr="";
						}
						
						$link_page="?pages=$pages&act=kuis&gbase=$gbase&gid=$kode";
						$detail="<a href=\"$link_page\" class=\"blink\">$edit_kuis</a>";
						
						$td_table.="<tr $bg_tr>
							<td>$no</td>
							<td>$nama_depart</td>
							<td>$namaFakultas</td>
							<td>$ket_status</td>
							<td>$detail</td>
						</tr>";
						
						$no++;
					}
					
					$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
						<thead> 
							<tr> 
			   					<th width='10'>No</th> 
			    				<th>Program Studi</th>
			    				<th>Fakultas</th>
			    				<th>Status Kuesioner</th>
			    				<th width='150'>Aksi</th>
							</tr> 
						</thead> 
						<tbody>
							$td_table
						</tbody>
					</table><br /><br />";
					
					$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>";
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
			$title_page.=" &raquo; Kuesioner";
			$error.=(empty($gbase) or strstr("/", $gbase))? "Tahun Akademik Masih Kosong<br />" : "";
			
			if(empty($error)){
				$tabel_kuis=CreateTableProdi($gbase);
	
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table as a left join $nama_table2 as b on b.kode=a.kodeFakultas ".
						"where a.kode=\"$gid\" order by namaFakultas asc, nama_depart asc";
				$data=mysql($neomaaref, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					
					$cnpage.="<table class='pad5'>
						<tr>
							<td>Tahun Akademik</td>
							<td width='10'>:</td>
							<td>$gbase</td>
						</tr>
						<tr>
							<td>Program Studi</td>
							<td>:</td>
							<td>$nama_depart</td>
						</tr>
						<tr>
							<td>Fakultas</td>
							<td>:</td>
							<td>$namaFakultas</td>
						</tr>
					</table>
					<hr/><br />";
					
					$cnpage.="<form name=\"form1\" method=\"post\" action=\"?pages=$pages&act=proses\">
							<input type=\"hidden\" name=\"tahun_ajar\" value=\"$gbase\" />
							<input type=\"hidden\" name=\"prodi\" value=\"$gid\" />";
					
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
			$kuis_table=CreateTableProdi($tahun_ajar);
			
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
					
					$sqld2="select * from $kuis_table where tahun_ajar=\"$tahun_ajar\" and prodi=\"$prodi\" and ".
							"bagian=\"$id_bagian\" and id_pertanyaan=\"$id_pert\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2==0){
						$vdata="tahun_ajar, bagian, id_pertanyaan, prodi, isi_standart, ";
						$vdata.="isi_standart2, tanggal_insert";
						
						$vvalue="\"$tahun_ajar\",\"$id_bagian\",\"$id_pert\", \"$prodi\", ";
						$vvalue.="\"$post_bp\", \"$post_bp2\", \"$ndatetime\"";
						
						$inp="insert into $kuis_table ($vdata) values ($vvalue)";
						@mysql_query($inp);
					}
					elseif($ndata2==1){
						$vdata="isi_standart=\"$post_bp\", isi_standart2=\"$post_bp2\", tanggal_insert=\"$ndatetime\"";
						
						$vvalue="tahun_ajar=\"$tahun_ajar\" and bagian=\"$id_bagian\" ";
						$vvalue.="and id_pertanyaan=\"$id_pert\" and prodi=\"$prodi\"";
						
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
