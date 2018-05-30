<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_prodi_"."$table";
	
	$nama_table2="in_programstudi";
	$nama_table3="in_fakultas";
	$nama_table4="db_bagian";
	$nama_table5="db_pertanyaan";
	
	$title_page="Laporan Evaluasi Kinerja Program Studi";
	$kategori="5";
	$idkat="1";
	
	echo"<style>
		@media print{
			body{
				margin:5px;
				width:80% !important;
				font-size:10px;
			}
			
			table.tablesorter{
				font-size:10px !important;
			}
			
			table.tablesorter td, table.tablesorter th{
				padding:2px !important;
				margin:0 !important;
			} 
			
			h2.head{
				font-size: 25px !important;
    			line-height: 20px;
				margin: 8px 0 !important;
			}
			
			h2.subhead {
			    font-size: 11px !important;
			}
			
			table.footer td{
				font-size:10px;
			}
		}
		
		@page{
			margin:5px;
			size:Legal portrait !important;
		}
		
		.upercase{
			text-transform: uppercase;
		}
		
	</style>";
	
	
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
			$link_back="?pages=$pages&act=$act&gbase=$gbase";
			
			$cnpage="<table class='pad5'>
				<tr>
					<td>Tahun Akademik</td>
					<td width='10'>:</td>
					<td>$gbase</td>
				</tr>
			</table>
			<hr/><br />
			<div class=\"clear\"></div>
			<br />";
			
			include"setting/kon_baa.php";
			$sqld="select a.*, b.namaFakultas from $nama_table2 as a left join $nama_table3 as b on ".
					"b.kode=a.kodeFakultas order by namaFakultas asc, nama_depart asc";
			$data=mysql($neomaaref, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){$no=1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$cekstatus=CekKuisProdi($gbase, $kode, $idkat);
					
					if($cekstatus>0){
						$ket_status="Sudah";
						$bg_tr="bgcolor='#f2f4f7'";
						$detail="<a href=\"?pages=$pages&act=detail&gbase=$gbase&gid=$kode\" class=\"blink\">Hasil</a>";
					}else{
						$ket_status="Belum";
						$bg_tr="";
						$detail="";
					}
					
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
		    				<th>Aksi</th>
						</tr> 
					</thead> 
					<tbody>
						$td_table
					</tbody>
				</table><br /><br />";
				
				$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>";
				
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
				$cnpage.="<br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"detail":
			$title_page.=" &raquo; Hasil Evaluasi";
			
			$ttd=Kepala();
			$header=PHeader();
			
			$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=data&gbase=$gbase'\" class='nodis'/> ";
			$cnpage.="<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();'\" class='nodis'/>";
			
			$cnpage.="$header<br />
			<center class='upercase'>
				<b>REKAPITULASI KINERJA PROGRAM STUDI</b><br />
				<b>UNIVERSITAS MUHAMMADIYAH MALANG</b><br />
				<b>TAHUN AKADEMIK $gbase</b>
			</center><br />";
			
			include"setting/kon_baa.php";
			$sqld="select * from $nama_table2 as a left join $nama_table3 as b on b.kode=a.kodeFakultas ".
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
				
				include"setting/kon.php";
				$tr_table=""; $no2=1;
				
				$sqld2="select * from $nama_table4 where hapus=\"0\" and status=\"1\" and kategori=\"$kategori\" ".
						"order by urutan asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					while($fdata2=mysql_fetch_assoc($data2)){
						$id_bagian=$fdata2["id"];
						$nama_bagian=$fdata2["bagian"];
						
						$td_table="";
						$sqld3="select * from $nama_table5 where hapus=\"0\" and status=\"1\" ".
								"and bagian=\"$id_bagian\" order by urutan asc";
						$data3=mysql_query($sqld3);
						$ndata3=mysql_num_rows($data3);
						if($ndata3>0){ $no=1;
							while($fdata3=mysql_fetch_assoc($data3)){
								extract($fdata3);
								
								$ket_sk=KetJenisInputan($jenis, $keterangan, $standart, $standart2);
								$ck_ket=$ket_sk["ket"];
								
								$hsl=CekKuisProdiHasil($gbase, $gid, "$id_bagian#$id", $jenis, $id_pertanyaan, $keterangan, $simbol, $standart, $standart2, $idkat);
								$ck=$hsl["hsl"];
								$kat=$hsl["kat"];
								
								if($no==1){
									$td_table.="<tr>
										<td rowspan='$ndata3'>$nama_bagian</td>
										<td>$pertanyaan</td>
										<td>$ck_ket</td>
										<td>$ck</td>
										<td>$kat</td>
									</tr>";
								}else{
									$td_table.="<tr>
										<td>$pertanyaan</td>
										<td>$ck_ket</td>
										<td>$ck</td>
										<td>$kat</td>
									</tr>";
								}
								
								
								if($kat=="M"){
									$no2=$no2 + 1;
								}
								
								$no++; $no3++;
							}
							
						}
						
						$tr_table.="$td_table";
					}
					
					$phasil=($no2/$no3) * 100;
					$phasil=round($phasil,2);
					$ket_hasil=Nilai($phasil, $kategori);
					
					#display nilai
					$dis_nilai="";
					$sqld="select * from db_nilai where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$dis_nilai.="<table class='pad5'>";
						
						while($fdata=mysql_fetch_assoc($data)){
							extract($fdata);
							
							$batas_awal=@number_format($batas_awal, 2, ",", ".");
							$batas_akhir=@number_format($batas_akhir, 2, ",", ".");
							
							$dis_nilai.="<tr>
								<td>$ket_nilai</td>
								<td>:</td>
								<td>$batas_awal% - $batas_akhir%</td>
							</tr>";
						}
						
						$dis_nilai.="</table>";
					}
					
					$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\"> 
						<thead> 
							<tr>
			    				<th width='180'>Kegiatan Kinerja</th>
			    				<th width='200'>Parameter Kinerja</th>
			    				<th>Standart Kinerja</th>
			    				<th>Capaian Kinerja</th>
			    				<th>Kategori</th>
							</tr> 
						</thead> 
						<tbody>
							$tr_table
						</tbody>
					</table><br />";
					
					
				}
				
				$cnpage.="Catatan:<br />
				<table class='pad5'>
					<tr>
						<td>1.</td>
						<td>M=Sesuai Kinerja, BM=Belum Sesuai Kinerja</td>
					</tr>
					<tr>
						<td>2.</td>
						<td>
							Persentase parameter yg sesuai kinerja => 
							((jumlah yg sesuai kinerja)/(total parameter)) X 100
						</td>
					</tr>
					<tr>
						<td></td>
						<td align='right'>($no2/$no3) X 100% = $phasil%</td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Kategori Kinerja Program Studi: <strong>$ket_hasil</strong></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Kategori Kinerja Program Studi: </td>
					</tr>
					<tr>
						<td></td>
						<td align='right'>$dis_nilai</td>
					</tr>
				</table><br />";
				
				$cnpage.="<br />
				<table class='pad5 footer'>
					<tr>
						<td width='200'></td>
						<td width='50%' rowspan='4'>&nbsp;</td>
						<td>Malang, ".TglFormat5($ndate)."</td>
					</tr>
					<tr>
						<td></td>
						<td>Kepala BKMA,</td>
					</tr>
					<tr>
						<td height='50'>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td>".$ttd["kep_bkma"]."</td>
					</tr>
				</table>";
			
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
			
		break;
	}
	
}
?>