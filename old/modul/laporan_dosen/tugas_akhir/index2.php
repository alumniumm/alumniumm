<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_ta";
	$nama_table_saran="$nama_table"."_saran";
	
	$nama_table2="master_dosen";
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	$nama_table5="master_siswa_wisuda";
	
	$title_page="Laporan Evaluasi Pembimbingan Tugas Akhir";
	$kategori="4";
	
	echo"<style>
		@media print{
			body{
			body{
				margin:5px;
				width:80% !important;
				font-size:9px;
			}
			
			table.tablesorter{
				font-size:8px !important;
			}
			
			table.tablesorter td, table.tablesorter th{
				padding:2px !important;
				margin:0 !important;
			} 
			
			h2.head{
				font-size: 12px !important;
    			line-height: 20px;
				margin: 8px 0 !important;
			}
			
			h2.subhead {
			    font-size: 11px !important;
			}
			
			table.footer td{
				font-size:9px;
			}
		}
			
			#chart2{
				margin:60em 0 0 0;
			}
		}
		
		@page{
			margin:5px;
			size:Legal portrait !important;
		}
		
		table.jqplot-table-legend{
			float:right;
			margin-left:10px;
		}
		
		table.jqplot-table-legend .jqplot-table-legend-swatch{
			width:10px;
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
						<td>Tahun Wisuda</td>
						<td>:</td>
						<td>".SelTahun($gbase, "gbase", "required")."</td>
						
						<td rowspan='2' width='100' align='center'><b>Sampai</b></td>
						
						<td>Tahun Wisuda</td>
						<td>:</td>
						<td>".SelTahun($gtahun, "gtahun", "required")."</td>
						
						<td rowspan='2' width='10' align='center'></td>
						<td>Tanggal Cetak</td>
					</tr>
					<tr>
						<td>Periode</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gp\" value=\"$gp\" required/></td>
						
						<td>Periode</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gtanggal\" value=\"$gtanggal\" required/></td>
						
						<td><input type=\"text\" name=\"gcetak\" value=\"$ndate\" class=\"tanggal\" required/></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\">&nbsp;</div>
			Keterangan:<br />
			Jika melihat laporan di tahun dan periode yang sama, tahun dan periode disamakan
			";
		break;
		
		case"data":
			$title_page.=" &raquo; Data";
			$link_page="?pages=$pages&act=$act&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gcetak=$gcetak";
			$posisi=cariPosisi($batas, $hal);
			
			$error="";
			$error.=(empty($gbase))? "<h4 class=\"alert_warning\">Tahun Wisuda Awal Belum Disi</h4>" : "";
			$error.=(empty($gp))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
			$error.=(empty($gtahun))? "<h4 class=\"alert_warning\">Tahun Wisuda Akhir Belum Disi</h4>" : "";
			$error.=(empty($gtanggal))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
			$error.=(empty($gcetak))? "<h4 class=\"alert_warning\">Tanggal Cetak Belum Disi</h4>" : "";
			
			if(empty($error)){
				$cnpage="<div style=\"font-size:18px;text-align:center;\">
					Tahun Wisuda $gbase Periode $gp <b>sampai</b> Tahun Wisuda $gtahun Periode $gtanggal
					<br />Tanggal Cetak ".TglFormat5($gcetak)."
				</div>
				<hr/><br />";
				
				$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
				<div class=\"clear\"></div>
				<br />";
				
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table5 where CONCAT(tahun,periode)>=\"$gbase$gp\" and CONCAT(tahun,periode)<=\"$gtahun$gtanggal\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					while($fdata=mysql_fetch_assoc($data)){
						$f2_kode_siswa=$fdata["kode_siswa"];
						$gf2_kode_siswa.="'$f2_kode_siswa',";
					}
				}
				
				$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
				if($gf2_kode_siswa!=""){
					include"setting/kon.php";
					$sqld="select * from $nama_table where nim in ($gf2_kode_siswa) and no_dosen>\"0\" ".
							"group by no_dosen order by no_dosen asc, prodi asc";
					$data=mysql_query($sqld." limit $posisi,$batas");
					$ndata=mysql_num_rows($data);
					if($ndata>0){ $no=$posisi+1;
						while($fdata=mysql_fetch_assoc($data)){
							extract($fdata);
							$nama_dosen=NamaDosen($no_dosen);
							$xprodi=NamaProdi($prodi);
							$nama_prodi=$xprodi["nama_depart"];
							
							$link_detail="?pages=$pages&act=detail&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$no_dosen&gdid=$prodi&gcetak=$gcetak";
							$detail="<a href=\"$link_detail\" class=\"blink\">Kuesioner</a>";
							
							$respon="<a href=\"modul/laporan_dosen/tugas_akhir/respondent.php?gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$no_dosen&gdid=$prodi&gcetak=$gcetak\" class=\"blink\">Respondent</a>";
							
							$saran="<a href=\"?pages=$pages&act=saran&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gid=$no_dosen&gdid=$prodi&gcetak=$gcetak\" class=\"blink\">Saran</a>";
										
							$td_table.="<tr>
								<td>$no</td>
								<td>$nama_dosen </td>
								<td>$nama_prodi</td>
								<td>$detail $saran $respon</td>
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
			    				<th>Nama Dosen</th>
			    				<th>Program Studi</th>
			    				<th width='250'>Aksi</th>
							</tr> 
						</thead> 
						<tbody>
							$td_table
						</tbody>
					</table>
					<div class=\"clear\"></div>
					$thal";
					
				}else{
					$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					$cnpage.="<br />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
					<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
				}
			}else{
				$cnpage="$error";
				$cnpage.="<br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
		
		case"detail":
			$title_page.=" &raquo; Hasil Evaluasi";
			
			$cnpage.="<link class=\"include\" rel=\"stylesheet\" type=\"text/css\" href=\"style/jquery.jqplot.min.css\" />
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/jquery.jqplot.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shCore.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shBrushJScript.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shBrushXml.min.js\"></script>";
			
			$cnpage.="<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.barRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.pieRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.categoryAxisRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.pointLabels.min.js\"></script>";
			
			include"setting/kon_baa.php";
			$sqld="select * from $nama_table5 where CONCAT(tahun,periode)>=\"$gbase$gp\" and CONCAT(tahun,periode)<=\"$gtahun$gtanggal\"";
			$data=mysql($neomaa, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				while($fdata=mysql_fetch_assoc($data)){
					$f2_kode_siswa=$fdata["kode_siswa"];
					$gf2_kode_siswa.="'$f2_kode_siswa',";
				}
			}
			
			$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
			if($gf2_kode_siswa!=""){
				$sqld="select * from $nama_table2 where no_dosen=\"$gid\" limit 1";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
					$xprodi=NamaProdi($gdid);
					$nama_prodi=$xprodi["nama_depart"];
					$nama_fak=$xprodi["namaFakultas"];
					
					include"setting/kon.php";
					$sqld2="select * from $nama_table3 where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" ".
							"order by urutan asc";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){ $no2=1;
						while($fdata2=mysql_fetch_assoc($data2)){
							$id_bagian=$fdata2["id"];
							$nama_bagian=$fdata2["bagian"];
							
							$sqld3="select * from $nama_table4 where hapus=\"0\" and status=\"1\" ".
									"and bagian=\"$id_bagian\" order by urutan asc";
							$data3=mysql_query($sqld3);
							$ndata3=mysql_num_rows($data3);
							if($ndata3>0){ $no=1; $jml1="";
								while($fdata3=mysql_fetch_assoc($data3)){
									$idp=$fdata3["id"];
									$pertanyaan=$fdata3["pertanyaan"];
									
									$sqld4="select count(nim) as jml_data, sum(isi_kurang_s) as isi_kurang_s, ".
											"sum(isi_kurang) as isi_kurang, sum(isi_baik) as isi_baik, ".
											"sum(isi_baik_s) as isi_baik_s from $nama_table where ".
											"id_pertanyaan=\"$idp\" and bagian=\"$id_bagian\" and ".
											"nim in ($gf2_kode_siswa) and no_dosen=\"$gid\"";
									$data4=mysql_query($sqld4);
									$ndata4=mysql_num_rows($data4);
									$fdata4=mysql_fetch_assoc($data4);
									
									$jml_data=$fdata4["jml_data"];
									$isi_kurang_s=$fdata4["isi_kurang_s"];
									$isi_kurang=$fdata4["isi_kurang"];
									$isi_baik=$fdata4["isi_baik"];
									$isi_baik_s=$fdata4["isi_baik_s"];
									
									$fisi_kurang_s=$isi_kurang_s * 1;
									$fisi_kurang=$isi_kurang * 2;
									$fisi_baik=$isi_baik * 4;
									$fisi_baik_s=$isi_baik_s * 5;

									$nilai_max=$fisi_kurang_s + $fisi_kurang + $fisi_baik + $fisi_baik_s;
									
									$rata=$nilai_max/$jml_data;
									$jml1=$jml1 + $rata;
									$avtd=@round($rata,2);
									$numtd=@number_format($avtd, 2, ".", ",");
									$isi_rata=Nilai($avtd, $kategori);
									
									$td_table.="<tr>
										<td>$no</td>
										<td>$pertanyaan</td>
										<td align='center'>$numtd $nilai_max/$jml_data</td>
										<td>$isi_rata</td>
									</tr>";
									
									$no++;
								}
								
								$avbag=@round($jml1/$ndata3,2);
								$numav=@number_format($avbag, 2, ".", ",");
								$tot_rata=Nilai($avbag, $kategori);
								
								$jml2=$jml2 + $avbag;
								
								$cnpage_table.="<br /><span><b>$nama_bagian</b></span><hr />
								<table class=\"tablesorter\" cellspacing=\"0\">
									<thead>
										<tr>
											<th width='10'>No</th>
											<th>Pertanyaan</th>
											<th width='50'>Nilai</th>
											<th width='100'>Kategori</th>
										</tr>
									</thead>
									<tbody>
										$td_table
										<tr>
											<th colspan='2'>Rata - Rata</th>
											<th align='center'>$numav</th>
											<th style='text-align:left !important;'>$tot_rata</th>
										</tr>
									</tbody>
								</table>";
							
								$td_table="";
							}
							
							$varticks.="['$nama_bagian', $numav],";
							
							$tr_rata.="<tr>
								<td>$no2</td>
								<td>$nama_bagian</td>
								<td align='center'>$numav</td>
								<td>$tot_rata</td>
							</tr>";
							
							$no2++;
						}
					}
					
					$varticks=substr($varticks,0,-1);
					$avtot=@round($jml2/$ndata2,2);
					$numavtot=@number_format($avtot, 2, ".", ",");
					$avtot_rata=Nilai($numavtot, $kategori);
					$ketnilai=Nilai($numavtot, $kategori, "1");
					$ttd=Kepala();
					$header=PHeader();
					
					$cnpage.="<script class=\"code\" type=\"text/javascript\">
						$(document).ready(function(){
							var line1 = [$varticks];

						    $('#chart2').jqplot([line1], {
								seriesDefaults:{
								    renderer:$.jqplot.BarRenderer,
									pointLabels: { show: true },
								    rendererOptions: {
								        varyBarColor: true
								    }
								},
								
								axes: {
								    xaxis: {
								        renderer: $.jqplot.CategoryAxisRenderer
								    },
									
									yaxis: {
								        pad: 1.05,
								        tickOptions: {formatString: '%3.1f'}
								    }
								}
						    });
						});
					</script>";
					
					if($gtahun=="$gbase" and $gtanggal=="$gp"){
						$ttahun="TAHUN $gbase PERIODE $gp";
					}else{
						$ttahun="TAHUN $gbase PERIODE $gp - TAHUN $gtahun PERIODE $gtanggal";
					}
					
						
					$cnpage.="
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=data&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gcetak=$gcetak'\" class='nodis'/>
					<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
					
					$header
					<center class='upercase'>
						<b>HASIL EVALUASI PELAYANAN PEMBIMBINGAN TUGAS AKHIR</b><br />
						<b>$ttahun</b>
					</center>
					
					<table class='footer'>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>$nama_dosen</td>
						</tr>
						<tr>
							<td>Fakultas</td>
							<td>:</td>
							<td>$nama_fak</td>
						</tr>
						<tr>
							<td>Jurusan</td>
							<td>:</td>
							<td>$nama_prodi</td>
						</tr>
					</table>
					
					<div class=\"clear\"></div>
					$cnpage_table<br />";
					
					$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\">
						<thead>
							<tr>
								<th width='10'>No</th>
								<th>Komponen</th>
								<th colspan='2'>Penilaian</th>
							</tr>
							<tr>
								<th colspan='2'></th>
								<th width='50'>Nilai</th>
								<th width='100'>Kategori</th>
							</tr>
						</thead>
						<tbody>
							$tr_rata
							<tr>
								<th colspan='2'>Rata - Rata Total</th>
								<th align='center'>$numavtot</th>
								<th style='text-align:left !important;'>$avtot_rata</th>
							</tr>
						</tbody>
					</table><br />";
					
					$cnpage.="<div id=\"chart2\" style=\"width:750px; height:150px;\"></div>";
					
					$cnpage.="<br />
					<table class='pad5 footer'>
						<tr>
							<td width='200'></td>
							<td width='50%' rowspan='4'>&nbsp;</td>
							<td>Malang, ".TglFormat5($gcetak)."</td>
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
				}
			}
		break;
		
		case"saran":
			$title_page.=" &raquo; Saran";
			
			$cnpage.="
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=data&gbase=$gbase&gp=$gp&gtahun=$gtahun&gtanggal=$gtanggal&gcetak=$gcetak'\" class='nodis'/>
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
			";
			
			$error="";
			$error.=(empty($gbase))? "<h4 class=\"alert_warning\">Tahun Wisuda Awal Belum Disi</h4>" : "";
			$error.=(empty($gp))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
			$error.=(empty($gtahun))? "<h4 class=\"alert_warning\">Tahun Wisuda Akhir Belum Disi</h4>" : "";
			$error.=(empty($gtanggal))? "<h4 class=\"alert_warning\">Periode Awal Belum Disi</h4>" : "";
			
			if(empty($error)){
				include"setting/kon_baa.php";
				$sqld="select * from $nama_table5 where CONCAT(tahun,periode)>=\"$gbase$gp\" and CONCAT(tahun,periode)<=\"$gtahun$gtanggal\"";
				$data=mysql($neomaa, $sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					while($fdata=mysql_fetch_assoc($data)){
						$f2_kode_siswa=$fdata["kode_siswa"];
						$gf2_kode_siswa.="'$f2_kode_siswa',";
					}
				}
				
				$gf2_kode_siswa=substr($gf2_kode_siswa,0,-1);
				if($gf2_kode_siswa!=""){
				
					$sqld="select * from $nama_table2 where no_dosen=\"$gid\" limit 1";
					$data=mysql($neomaa, $sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						extract($fdata);
						$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
						$xprodi=NamaProdi($gdid);
						$nama_prodi=$xprodi["nama_depart"];
						$nama_fak=$xprodi["namaFakultas"];
					
						$td_saran="";
						include"setting/kon.php";
						$sqld2="select * from $nama_table_saran where nim in ($gf2_kode_siswa) ".
								"and no_dosen=\"$gid\" and saran!=\"\" group by saran order by id asc";
						$data2=@mysql_query($sqld2);
						$ndata2=@mysql_num_rows($data2);
						if($ndata2>0){ $no=1;
							while($fdata2=mysql_fetch_assoc($data2)){
								@extract($fdata2);
								
								$td_saran.="<tr>
									<td>$no</td>
									<td>$saran</td>
								</tr>";
								
								$no++;
							}
							
							if($gtahun=="$gbase" and $gtanggal=="$gp"){
								$ttahun="TAHUN $gbase PERIODE $gp";
							}else{
								$ttahun="TAHUN $gbase PERIODE $gp - TAHUN $gtahun PERIODE $gtanggal";
							}
							
							$cnpage.="$tb_cetak
							<div class=\"clear\"></div>
							<br />
							
							<center class='upercase'>
								<b>SARAN KINERJA EVALUASI PEMBIMBINGAN TUGAS AKHIR</b><br />
								<b>UNIVERSITAS MUHAMMADIYAH MALANG</b><br />
								<b>$ttahun</b>
							</center>
							
							<div class=\"clear\"></div><br />";
							
							$cnpage.="<table class='footer'>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td>$nama_dosen</td>
								</tr>
								<tr>
									<td>Fakultas</td>
									<td>:</td>
									<td>$nama_fak</td>
								</tr>
								<tr>
									<td>Jurusan</td>
									<td>:</td>
									<td>$nama_prodi</td>
								</tr>
							</table><br />";
							
							$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\">
								<thead>
									<tr>
										<th width='20'>No</th>
										<th>Saran</th>
									</tr>
								</thead>
								<tbody>
									$td_saran
								</tbody>
							</table><br />";
						}
					}
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
				$cnpage.="<br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" />
				<meta http-equiv=\"refresh\" content=\"2;url=?pages=$pages\">";
			}
		break;
	}
	
}
?>

