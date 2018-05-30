<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_perpustakaan_"."$table"."_"."$gp";
	$nama_table_saran="$nama_table"."_saran";
	
	$nama_table2="db_bagian";
	$nama_table3="db_pertanyaan";
	
	$title_page="Laporan Evaluasi Perpustakaan";
	$kategori="3";
	
	$tb_cetak="
		<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\" class='nodis'/>
		<input type=\"button\" name=\"button\" value=\"Evaluasi\" onclick=\"window.location.href='?pages=$pages&act=detail&gbase=$gbase&gp=$gp'\" class='nodis'/>
		<input type=\"button\" name=\"button\" value=\"Saran\" onclick=\"window.location.href='?pages=$pages&act=saran&gbase=$gbase&gp=$gp'\" class='nodis'/>
		<input type=\"button\" name=\"button\" value=\"Repondent\" onclick=\"window.location.href='modul/laporan_dosen/perpustakaan/respondent.php?gbase=$gbase&gp=$gp&gid=$no_dosen&gdid=$prodi'\" class='nodis'/>
		<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
	";
	
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
				<input type=\"hidden\" name=\"act\" value=\"detail\" />
				
				<table class='pad5'>
					<tr>
						<td>Tahun Akademik</td>
						<td>:</td>
						<td>".SelTahunMasuk($gbase, "gbase", "required")."</td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>:</td>
						<td>".SelSemester($gp, "gp", "", "required")."</td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"proses\" value=\"Proses\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='?pages=$pages'\"/>
			</form>
			<div class=\"clear\"></div>";
		break;
		
		case"detail":
		$thAkademik = $_GET['gbase'];
		$Semester = $_GET['gp'];
		if($Semester==1){$smst="Ganjil";}
		if($Semester==2){$smst="Genap";}
		
		$cek = CekTablePerpus($thAkademik,$Semester);
		if($cek > 0){
		$q="SELECT DISTINCT a.id_perpus, b.nama_perpus 
		FROM $nama_table a
		LEFT JOIN db_lokasi_perpus b
		ON a.id_perpus = b.id
		WHERE a.jenis_perpus = 1 ";
		$hasil = mysql_query($q);
		$hit = mysql_num_rows($hasil);
		if($hit){
			WHILE($data = mysql_fetch_array($hasil)){
			$idp = $data[id_perpus];
			$button ="<a href=\"?pages=kd-perpustakaan&act=detail1&gbase=$thAkademik&gp=$Semester&j=1&idp=$idp&proses=Proses\" class=\"blink\">Detail</a>";
			$SubTb.="<tr>
			<td>$data[nama_perpus]</td>
			<td>$button</td>
			</tr>";
			}
			
		}else{$SubTb.="<tr>
		<td colspan='2'>Data belum ada</td>
		</tr>";}
			
		$q1="SELECT DISTINCT a.id_perpus
		FROM $nama_table a
		WHERE a.jenis_perpus = 2 ";
		$hasil1 = mysql_query($q1);
		$hit1 = mysql_num_rows($hasil1);	
		if($hit1){
			WHILE($data1 = mysql_fetch_array($hasil1)){
			$IDfakultas = $data1['id_perpus'];
			$button2 ="<a href=\"?pages=kd-perpustakaan&act=detail1&gbase=$thAkademik&gp=$Semester&j=2&idp=$IDfakultas&proses=Proses\" class=\"blink\">Detail</a>";	
				include"setting/kon_baa.php";
				$qr2="SELECT * FROM in_fakultas  where kode=\"$IDfakultas\" ";
				$hasil2 = mysql($neomaaref, $qr2);
				WHILE($data2 = mysql_fetch_array($hasil2)){
				$SubTb2.="<tr>
				<td>$data2[namaFakultas]</td>
				<td>$button2</td>
				</tr>";
				}
			
			}
			
			}else{$SubTb2.="<tr>
			<td colspan='2'>Data belum ada</td>
			</tr>";}
				
		include"setting/kon.php";
		$q3="SELECT DISTINCT a.id_perpus
		FROM $nama_table a
		WHERE a.jenis_perpus = 3 ";
		$hasil3 = mysql_query($q3);
		$hit3 = mysql_num_rows($hasil3);	
		if($hit3){
			WHILE($data3 = mysql_fetch_array($hasil3)){
				$IDjurusan = $data3['id_perpus'];
				include"setting/kon_baa.php";
				$qr4="SELECT * FROM in_programstudi  where kode=\"$IDjurusan\" ";
				$hasil4 = mysql($neomaaref, $qr4);
				WHILE($data4 = mysql_fetch_array($hasil4)){
			
			$button3 ="<a href=\"?pages=kd-perpustakaan&act=detail1&gbase=$thAkademik&gp=$Semester&j=3&idp=$IDjurusan&proses=Proses\" class=\"blink\">Detail</a>";	
				$SubTb3.="<tr>
				<td>$data4[nama_depart]</td>
				<td>$button3</td>
				</tr>";
				}
			
			}
			
			}else{$SubTb3.="<tr>
			<td colspan='2'>Data belum ada</td>
			</tr>";}	
			
		}
		
		$cnpage.="
		<table class='pad5'>
		<tr>
		<td>Tahun Akademik</td><td>:</td><td>$thAkademik</td>
		</tr>
		<tr>
		<td>Semester</td><td>:</td><td>$smst</td>
		</tr>
		</table>
		
		<table class=\"tablesorter\">
		<thead>
		<tr>
		<th>Perpustakaan Universitas</th>
		<th>Aksi</th>
		</tr>
		</thead>
		
		<tbody>
		$SubTb
		</tbody>
		
		<thead>
		<tr>
		<th>Perpustakaan Fakultas</th>
		<th>Aksi</th>
		</tr>
		</thead>
		
		<tbody>
		$SubTb2
		</tbody>
		
		<thead>
		<tr>
		<th>Perpustakaan Program Studi</th>
		<th>Aksi</th>
		</tr>
		</thead>
		
		<tbody>
		$SubTb3
		</tbody>
		
		</table>";
		break;
		
		case"detail1":
			$JPerpus = $_GET['j'];
			$IDperpus = $_GET['idp'];
			if($JPerpus==3){
			include"setting/kon_baa.php";
	
			$sqld="SELECT a.nama_depart FROM in_programstudi AS a where a.kode=\"$IDperpus\"";
			$data=mysql($neomaaref, $sqld);
			//$data=mysql_query($sqld);
			$fdata=mysql_fetch_assoc($data);
			$name=$fdata['nama_depart'];
			$NamaPerpus = "Perpustakaan Program Studi $name";
			}
			if($JPerpus==2){
			
			include"setting/kon_baa.php";
			$sqld="SELECT namaFakultas FROM in_fakultas  where kode=\"$IDperpus\" ";
			$data=mysql($neomaaref, $sqld);
			//$data=mysql_query($sqld);
			$fdata=mysql_fetch_assoc($data);
			$name=$fdata['namaFakultas'];
			$NamaPerpus = "Perpustakaan $name";
			
			}
			if($JPerpus==1){
			include"setting/kon.php";
			$qr="SELECT nama_perpus,alamat FROM db_lokasi_perpus WHERE id = \"$IDperpus\" ";
			$data=mysql_query($qr);
			$fdata=mysql_fetch_assoc($data);
			$NamaPerpus = $fdata['nama_perpus'];
			}
			
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
			
			include"setting/kon.php";
			$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" ".
					"order by urutan asc";
			$data2=mysql_query($sqld2);
			$ndata2=mysql_num_rows($data2);
			if($ndata2>0){ $no2=1;
				while($fdata2=mysql_fetch_assoc($data2)){
					$id_bagian=$fdata2["id"];
					$nama_bagian=$fdata2["bagian"];
					
					$sqld3="select * from $nama_table3 where hapus=\"0\" and status=\"1\" ".
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
									"tahun_ajar=\"$gbase\" and semester=\"$gp\"  and jenis_perpus=\"$JPerpus\" and id_perpus=\"$IDperpus\" ";
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
							
							$jml1=$jml1 + $nilai_max;
							$rata=$nilai_max/$jml_data;
							$avtd=@round($rata,2);
							$numtd=@number_format($avtd, 2, ".", ",");
							$isi_rata=Nilai($avtd, $kategori);
							
							$td_table.="<tr>
								<td>$no</td>
								<td>$pertanyaan</td>
								<td align='center'>$numtd</td>
								<td>$isi_rata</td>
							</tr>";
							
							$no++;
						}
						
						$avbag=@round($jml1/$ndata3,2);
						$numav=@number_format($avbag, 2, ".", ",");
						$tot_rata=Nilai($avbag, $kategori);
						
						$jml2=$jml2 + $avbag;
						
						$cnpage_table.="<h2 class='subhead'>$nama_bagian</h2><hr />
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
					
					$rep_nama=str_replace("Perpustakaan", "", $nama_bagian);
					$varticks.="['$rep_nama', $numav],";
					
					$tr_rata.="<tr>
						<td>$no2</td>
						<td>$nama_bagian</td>
						<td align='center'>$numav</td>
						<td>$tot_rata</td>
					</tr>";
					
					$no2++;
				}
				
				$varticks=substr($varticks,0,-1);
				$avtot=@round($jml2/$ndata2,2);
				$numavtot=@number_format($avtot, 2, ".", ",");
				$avtot_rata=Nilai($numavtot, $kategori);
				$ketnilai=Nilai($numavtot, $kategori, "1");
				$ttd=Kepala();
				$header=PHeader();
				$nama_semester=SelSemester($gp, "gp", "1");
				
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
							
					        legend: {
					            show: true,
					            placement: 'outsideGrid'
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
				
				
				$cnpage.="$tb_cetak
				
				$header
				<center class='upercase'>
					<b>EVALUASI KINERJA PELAYANAN PERPUSTAKAAN</b><br />
					<b>$NamaPerpus</b><br />
					<b>TAHUN AKADEMIK $gbase</b>
					<b>SEMESTER $nama_semester</b>
				</center>
				
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
				
				$cnpage.="<div id=\"chart2\" style=\"width:750px; height:200px;\"></div>";
				
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
			}
		break;
		
		case"saran":
			$title_page.=" &raquo; Saran";
			
			$td_saran="";
			$sqld2="select * from $nama_table_saran where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
					"group by saran order by id asc";
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
				
				$nama_semester=SelSemester($gp, "gp", "1");
				
				$cnpage.="$tb_cetak
				<div class=\"clear\"></div>
				<br />
				
				<center class='upercase'>
					<b>SARAN KINERJA PELAYANAN PERPUSTAKAAN</b><br />
					<b>UNIVERSITAS MUHAMMADIYAH MALANG</b><br />
					<b>TAHUN AKADEMIK $gbase</b>
					<b>SEMESTER $nama_semester</b>
				</center>
				
				<div class=\"clear\"></div><br />";
				
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
		break;
		
	}
	
}
?>