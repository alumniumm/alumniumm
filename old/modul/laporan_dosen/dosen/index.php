<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$table=str_replace("/", "_", $gbase);
	$nama_table="zdb_kuis_"."$table"."_"."$gp";
	$nama_table2="master_dosen";
	$nama_table3="db_bagian";
	$nama_table4="db_pertanyaan";
	
	$title_page="Laporan Evaluasi Pembelajaran Dosen";
	$kategori="1";
	
	echo"<style>
		@media print{
			body{
				margin:5px;
				width:80% !important;
				font-size:9px;
			}
			
			table.tablesorter{
				font-size:9px !important;
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
				font-size:9px;
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
		
		case"data":
			$title_page.=" &raquo; Data";
			$link_page="?pages=$pages&act=$act&gbase=$gbase&gp=$gp";
			$posisi=cariPosisi($batas, $hal);
			$nama_semester=SelSemester($gp, "gp", "1");
			
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
			
			$cnpage.="<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages'\"/>
			<div class=\"clear\"></div>
			<br />";
			
			include"setting/kon.php";
			$sqld="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
					"group by no_dosen order by no_dosen asc, prodi asc";
			$data=@mysql_query($sqld." limit $posisi,$batas");
			$ndata=@mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_dosen=NamaDosen($no_dosen);
					$xprodi=NamaProdi($prodi);
					$nama_prodi=$xprodi["nama_depart"];
					
					$detail="<a href=\"?pages=$pages&act=detail&gbase=$gbase&gp=$gp&gid=$no_dosen&gdid=$prodi\" class=\"blink\">Kuesioner</a>";
					$respon="<a href=\"modul/laporan_dosen/dosen/respondent.php?gbase=$gbase&gp=$gp&gid=$no_dosen&gdid=$prodi\" class=\"blink\">Respondent</a>";
								
					$td_table.="<tr>
						<td>$no</td>
						<td>$nama_dosen</td>
						<td>$nama_prodi</td>
						<td>$detail $respon</td>
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
		    				<th>Nama Dosen</th>
		    				<th>Program Studi</th>
		    				<th width='200'>Aksi</th>
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
			$sqld="select * from $nama_table2 where no_dosen=\"$gid\" and ref_aktivasiDosen in ('A') limit 1";
			$data=mysql($neomaa, $sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$fdata=mysql_fetch_assoc($data);
				extract($fdata);
				$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
				$xprodi=NamaProdi($gdid);
				$nama_prodi=$xprodi["nama_depart"];
				$nama_fak=$xprodi["namaFakultas"];
				
				$nama_semester=SelSemester($gp, "gp", "1");
				
				include"setting/kon.php";
				$sqld2="select * from $nama_table3 where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" ".
						"order by urutan asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
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
										"tahun_ajar=\"$gbase\" and semester=\"$gp\" and no_dosen=\"$gid\"";
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
								$fisi_baik=$isi_baik * 3;
								$fisi_baik_s=$isi_baik_s * 4;

								$nilai_max=$fisi_kurang_s + $fisi_kurang + $fisi_baik + $fisi_baik_s;
								
								$rata=$nilai_max/$jml_data;
								$jml1=$jml1 + $rata;
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
							$arrav.="$numav, ";
							
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
						
						$varticks.="'$nama_bagian', ";
						
					}
				}
				
				$arrav=substr($arrav,0,-2);
				$varticks.="'Rata-Rata'";
				$avtot=@round($jml2/$ndata2,2);
				$numavtot=@number_format($avtot, 2, ".", ",");
				$avtot_rata=Nilai($numavtot, $kategori);
				$ketnilai=Nilai($numavtot, $kategori, "1");
				$ttd=Kepala();
				$header=PHeader();
				
				$arr_dat=array("<td align='center'>", "</td>");
				$arr_rep=array("", ", ");
				
				$rj=RataJurusan($gdid, $gbase, $gp, $nama_table);
				$rata_jurusan=$rj["td"];
				$rata_jurusan_tot=$rj["rata"];
				$rep_jurusan=str_replace($arr_dat, $arr_rep, $rata_jurusan);
				$sub_jurusan=substr($rep_jurusan,0,-2);
				
				$rf=RataFakultas($gdid, $gbase, $gp, $nama_table);
				$rata_fakultas=$rf["td"];
				$rata_fakultas_tot=$rf["rata"];
				$rep_fakultas=str_replace($arr_dat, $arr_rep, $rata_fakultas);
				$sub_fakultas=substr($rep_fakultas,0,-2);
				
				$ru=RataUniversitas($gdid, $gbase, $gp, $nama_table);
				$rata_universitas=$ru["td"];
				$rata_universitas_tot=$ru["rata"];
				$rep_universitas=str_replace($arr_dat, $arr_rep, $rata_universitas);
				$sub_universitas=substr($rep_universitas,0,-2);
				
				$cnpage.="<script class=\"code\" type=\"text/javascript\">
					$(document).ready(function(){
						var s1 = [$arrav, $numavtot];
						var s2 = [$sub_jurusan, $rata_jurusan_tot];
						var s3 = [$sub_fakultas, $rata_fakultas_tot];
						var s4 = [$sub_universitas, $rata_universitas_tot];
						var ticks = [$varticks];

						plot2 = $.jqplot('chart2', [s1, s2, s3, s4], {
						    seriesDefaults: {
						        renderer:$.jqplot.BarRenderer,
						        pointLabels: { show: true }
						    },
						    
							series:[
					            {label:'Dosen'},
					            {label:'Jurusan'},
					            {label:'Fakultas'},
					            {label:'Universitas'}
					        ],
							
					        legend: {
					            show: true,
					            placement: 'outsideGrid'
					        },
							
							axes: {
						        xaxis: {
						            renderer: $.jqplot.CategoryAxisRenderer,
						            ticks: ticks
						        },
								
								yaxis: {
						            pad: 1.05,
						            tickOptions: {formatString: '%3.1f'}
						        }
						    }
						});
					});
				</script>";
						
				$cnpage.="
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=data&gbase=$gbase&gp=$gp'\" class='nodis'/>
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				$header
				<center class='upercase'>
					<b>HASIL EVALUASI PEMBELAJARAN DOSEN</b><br />
					<b>SEMESTER $nama_semester</b>
					<b>TAHUN AKADEMIK $gbase</b>
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
				$cnpage_table";
				
				$cnpage.="<table class=\"tablesorter\" cellspacing=\"0\">
					<tr>
						<th>Rata - Rata Total</th>
						<th align='center' width='50'>$numavtot</th>
						<th style='text-align:left !important;' width='100'>$avtot_rata</th>
					</tr>
					<tr>
						<td colspan='3'>Keterangan: $ketnilai</td>
					</tr>
				</table>";
				
				$cnpage.="<div id=\"chart2\" style=\"width:850px; height:200px;\"></div>";
				
				$cnpage.="<br />
				<table class='pad5 footer'>
					<tr>
						<td>Mengetahui,</td>
						<td width='50%' rowspan='4'>&nbsp;</td>
						<td>Malang, ".TglFormat5($ndate)."</td>
					</tr>
					<tr>
						<td>Pembantu Rektor I,</td>
						<td>Kepala BKMA,</td>
					</tr>
					<tr>
						<td height='50'>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>".$ttd["pr1"]."</td>
						<td>".$ttd["kep_bkma"]."</td>
					</tr>
				</table>";
			}
		break;
		
	}
	
}
?>

