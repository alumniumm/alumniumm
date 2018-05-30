<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
$title_page="Rekapitulasi Kinerja Perwalian Mahasiswa";

$cnpage.="<link class=\"include\" rel=\"stylesheet\" type=\"text/css\" href=\"style/jquery.jqplot.min.css\" />
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/jquery.jqplot.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shCore.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shBrushJScript.min.js\"></script>
			<script type=\"text/javascript\" src=\"jquery/scripts/shBrushXml.min.js\"></script>";
			
   $cnpage.="<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.barRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.pieRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.categoryAxisRenderer.min.js\"></script>
			<script class=\"include\" type=\"text/javascript\" src=\"jquery/plugins/jqplot.pointLabels.min.js\"></script>";

$ttd=Kepala();

include"setting/kon.php";
$que = "SELECT ket_nilai, batas_awal, batas_akhir FROM db_nilai where kategori = '2'";
$has = mysql_query($que);
$ht = mysql_num_rows($has);
if($ht){
while($dat = mysql_fetch_array($has)){
$skor = "$dat[batas_awal] - $dat[batas_akhir]";
$n++;
$tb .="
<tr>
<td align='center'>$n</td>
<td>$skor</td>
<td>$dat[ket_nilai]</td>
</tr>
";
}
}	


switch($act){
default:
$nama_table="db_tahun_akademik";
	

$sqlta="SELECT tahun_ajar FROM $nama_table where status=\"0\" order by tahun_ajar desc ";
$hs = mysql_query($sqlta);
$count = mysql_num_rows($hs);
if($count){
while($data = mysql_fetch_array($hs)){
$option .="<option value=\"$data[tahun_ajar]\">$data[tahun_ajar]</option>"; 
 }
}

$cnpage.="<form name=\"form1\" action=\"?pages=$pages&act=proses\" method=\"post\">

<table class='pad5'>
<tr>
<td>Tahun Akademik :</td> 
<td>
<select name=\"tahun\">
<option value=\"\">-Pilih-</option>
$option
</select>
</td>
</tr>
</table><br />
<input type=\"submit\" name=\"proses\" value=\"Proses\" />

</form>";

break;

case"proses":

$jj="<a href=\"?pages=$pages&act=view_jurusan&th=$tahunAkademik&fa=$kodeFakultas&Nf=$namaFakultas\" class=\"blink\">Laporan Fakultas</a>";

$ta = $_GET['th'];
if($ta){$tahunAkademik = $ta;}else{
$tahunAkademik = $_POST['tahun'];
}
$title_page="Rekapitulasi Kinerja Pelayanan Perwalian Mahasiswa Tahun Akademik $tahunAkademik";
$tablelastName=str_replace("/", "_", $tahunAkademik);
$tableN="zdb_perwalian_$tablelastName";

include"setting/kon_baa.php";	
$qfakultas ="SELECT * FROM in_fakultas ";
$hqfakultas = mysql($neomaaref, $qfakultas);
$tung = mysql_num_rows($hqfakultas);
if($tung){
	while($do = mysql_fetch_array($hqfakultas)){
	$kodeFakultas = $do['kode'];
	$namaFakultas = $do['namaFakultas'];
	$hasil = HitKuesioner($kodeFakultas,$tableN);
	$hasil_new = round($hasil,2);
	
	
		
	if($hasil > 0){	
	$nilaiKat =  Nilai($hasil_new,2);
	}else{$nilaiKat=" ";}
	$jj="<a href=\"?pages=$pages&act=view_jurusan&th=$tahunAkademik&fa=$kodeFakultas&Nf=$namaFakultas\" class=\"blink\">Lihat Jurusan</a>";
	
	$jd="<a href=\"?pages=$pages&act=Dosen&th=$tahunAkademik&FaKode=$kodeFakultas&Nfak=$namaFakultas\" class=\"blink\">Lihat Dosen</a>";
	
	$no++;
	$jmlNilai_fakultas[] = $hasil_new;
	$FakultasName[] = $namaFakultas;
	
	$tabfak .= "<tr>
	<td>$no</td>
	<td>$do[namaFakultas]</td>
	<td align='center'>$hasil_new</td>
	<td align='center'>$nilaiKat</td>
	<td>$jj  $jd</td>
	</tr>";
	
	}
}
   
$cnpage .="<input type='button' value='Laporan Fakultas' onclick=\"location.href='?pages=$pages&act=proses&th=$tahunAkademik' \">
   
<input type='button' value='Laporan Jurusan' onclick=\"location.href='?pages=$pages&act=lapJur&th=$tahunAkademik' \">
<input type='button' value='Laporan Dosen' onclick=\"location.href='?pages=$pages&act=lapDos&th=$tahunAkademik' \">
<div class=\"clear\"></div>";
   
   
	$cnpage.="<br>
	<table class='tablesorter'>
	<thead>
	<tr>
	<th width='30'>No.</th>
	<th>Fakultas</th>
	<th width='150'>Nilai</th>
	<th width='150'>Kategori</th>
	<th width='200'>Aksi</th>
	</tr>
	</thead>
	<tbody>
	$tabfak
	</tbody>
	</table>";
	
	$jum = count($FakultasName);		
	for($o=0;$o<=$jum;$o++){
	$labels .= "{label:'$FakultasName[$o]'},";
	if($o != 0){
	$slab .="s$o,";
	}
	$xy = $o+1;
	//$chart="";
	$sat .="var s$xy = [$jmlNilai_fakultas[$o]]; ";
	}

	$labelS = substr($slab,0,-1);
	$var = substr($sat,0,-1);
	$lb = substr($labels,0,-1);
			
	$cnpage.="<script class=\"code\" type=\"text/javascript\">
					$(document).ready(function(){
					
					
					$var
				  
						
						var ticks = [$jum];
					
					
						plot2 = $.jqplot('chart2', [$labelS], {
						    seriesDefaults: {
						        renderer:$.jqplot.BarRenderer,
						        pointLabels: { show: true }
						    },
						    
							series:[
							$lb
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
				
				
				
$cnpagetable="
<table  width='50%' border='1' bordercolor='#000000'>
	<thead>
	<tr>
	<th width='5' align='center'>No.</th>
	<th width='30'>Rentang Skor</th>
	<th width='15'>Nilai</th>
	</tr>
	</thead>
	<tbody>
	$tb
	</tbody>
</table>
";
				
				
				$cnpage.="<br><div id=\"chart2\" style=\"width:750px; height:200px;\"></div><br><br><br><br>$cnpagetable";
				

	
break;

case"lapJur":
$TahunAkademik = $_GET['th'];
$tablelastName=str_replace("/", "_", $TahunAkademik);
$TABN="zdb_perwalian_$tablelastName";

$title_page="Rekapitulasi Kinerja Perwalian Mahasiswa PerJurusan";

$cnpage="<table class='pad5'>
		<tr>
		<td>Tahun Akademik</td>
		<td width='10'>:</td>
		<td>2013/2014</td>
		</tr>
		</table>
		<hr/>
		<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=proses&th=$TahunAkademik'\"/>
		<br><br>
		
		<div class=\"clear\"></div>";

include"setting/kon_baa.php";
$qy="SELECT kode,namaFakultas FROM in_fakultas WHERE kode != '9' order by kode asc ";
$hsh = mysql($neomaaref, $qy);
$htung = mysql_num_rows($hsh);
if($htung){
		
	while($dr = mysql_fetch_array($hsh)){
	$kodeFakul = $dr[kode];
	$namaFakul = $dr[namaFakultas];
	
	$qyJur = "SELECT a.kode,a.nama_depart 
	FROM in_programstudi a 
	WHERE a.kodeFakultas = '$kodeFakul' ";
	
	$hsJur = mysql($neomaaref, $qyJur);
	$hitJ = mysql_num_rows($hsJur);
	
		if($hitJ){
			$Djur="";
			$DosR=""; $DosR2="";
			while($ddJur = mysql_fetch_array($hsJur)){
			$nama_depart = $ddJur[nama_depart];
			$kodeJurusan = $ddJur[kode];
						
					
			
$DosR="<a href=\"?pages=$pages&act=view_dosen&jur=$kodeJurusan&th=$TahunAkademik&fa=$kodeFakul&Nf=$namaFakul&jN=$nama_depart\" class=\"blink\">Lihat Nilai Dosen</a>";
								
$DosR2="<a href=\"?pages=$pages&act=DosenValue&FaKode=$kodeFakul&Njur=$nama_depart&jur=$kodeJurusan&th=$TahunAkademik\" class=\"blink\">Skor Kinerja Dosen</a>";			
		
					
			$na++;
			$Djur .="
			<tr>
			<td>$na</td>
			<td  width='65%'>$nama_depart</td>
			<td>$DosR $DosR2</td>
			</tr>
			";
			}
		}
		$cnpage .="
		<h2>$namaFakul</h2>
		<table class='tablesorter' cellspacing='0'>
		<thead>
		<tr>
		<th width='5%'>No</th>
		<th>Jurusan</th>
		<th width='30%'>Aksi</th>
		</tr>
		</thead>
		<tbody>
		$Djur
		</tbody>
		</table><br> 
		";
		
	}
}
break;

case"lapDos":
$title_page="Rekapitulasi Kinerja Perwalian Mahasiswa PerDosen";
$TahunAkademik = $_GET['th'];
$tablelastName=str_replace("/", "_", $TahunAkademik);
$TabName="zdb_perwalian_$tablelastName";

include"setting/kon.php";
$qq= "SELECT DISTINCT a.no_dosen,a.prodi
FROM $TabName a
ORDER BY a.prodi ASC";

$hasq = mysql_query($qq);
$jqq = mysql_num_rows($hasq);
if($jqq){
	$subT="";
	while($rD = mysql_fetch_array($hasq)){
	$kod_dosen = $rD[no_dosen];
	$KodeProdi = $rD[prodi];
	
	include"setting/kon_baa.php";
	$qReplase="SELECT b.namaDosen,b.gelarLengkap FROM master_dosen b WHERE b.no_dosen='$kod_dosen' ";
	$hqR = mysql($neomaa, $qReplase);
	$dqRep = mysql_fetch_array($hqR);
	
	$DosName = $dqRep[namaDosen];
	$GeLAR = $dqRep[gelarLengkap];
	
	include"setting/kon_baa.php";
	$qRepFa = "SELECT c.nama_depart, c.kodeFakultas FROM in_programstudi c WHERE c.kode='$KodeProdi' ";
	$hqRfa = mysql($neomaaref, $qRepFa);
	$dqRFa = mysql_fetch_array($hqRfa);
	$kodeFakultas = $dqRFa[kodeFakultas];
	
	
	$DosB="<a href=\"?pages=$pages&act=dosen_val&jur=$KodeProdi&th=$TahunAkademik&fa=$kodeFakultas&Dn=$kod_dosen&nm=$DosName $GeLAR\" class=\"blink\">Hasil Kuesioner</a>";
	
	$DosB2="<a href=\"?pages=$pages&act=responden&Dosen=$kod_dosen&th=$TahunAkademik&Jur=$KodeProdi&Name=$DosName $GeLAR\" class=\"blink\">Responden</a>";
	
	$nu++;
	$subT .="<tr>
	<td align='center'>$nu</td>
	<td>$dqRep[namaDosen]</td>
	<td>$dqRFa[nama_depart]</td>
	<td>$DosB $DosB2</td>
	</tr>";
	}
}

$cnpage .="
<table class='pad5'>
	<tr>
		<td>Tahun Akademik</td>
		<td width='10'>:</td>
		<td>$TahunAkademik</td>
	</tr>
</table>
<hr/>
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=proses&th=$TahunAkademik'\"/>
<br>

<div class=\"clear\"></div>

<br><table class='tablesorter'>
<thead>
<tr>
<th width='5%'>No</th>
<th>Nama Dosen</th>
<th>Program Studi</th>
<th width='30%'>Aksi</th>
</tr>
</thead>
<tbody>
$subT
</tbody>
</table>";

break;

case"view_jurusan":
$kodefa = $_GET['fa'];
$thAkademik = $_GET['th'];
$NFakultas = $_GET['Nf'];
$Fak = strtoupper($NFakultas);

include"setting/kon_baa.php";	
$qstudi ="SELECT * FROM in_programstudi WHERE kodeFakultas = '$kodefa' ";
$ha = mysql($neomaaref, $qstudi);
$hit = mysql_num_rows($ha);
if($hit){
	while($da1 = mysql_fetch_array($ha)){
	$no++;
	$depart = $da1['nama_depart'];
	$Iddepart = $da1['kode'];
	$linkD="<a href=\"?pages=$pages&act=view_dosen&jur=$Iddepart&th=$thAkademik&fa=$kodefa&Nf=$NFakultas&jN=$depart\">$depart</a>";
	$kodeJurusan = $da1['kode'];
	$tablelastName=str_replace("/", "_", $thAkademik);
	$tableN="zdb_perwalian_$tablelastName";
	$Tot = HitKuesioner2($kodeJurusan,$tableN);
	$hasil_new = round($Tot,2);
	
	$label[]=$depart;
	$hasilcc[] = $hasil_new;
	
	$nilaiKat = Nilai($hasil_new,2);
		
	$tabjur .= "<tr>
	<td>$no</td>
	<td>$depart</td>
	<td align='center'>$hasil_new</td>
	<td align='center'>$nilaiKat</td>
	</tr>";
	}
}
$jmllabel = count($label);
$hasiln = count($hasilcc);

$rataFakultas=$hasiln+1;
$rataFakultas2=$hasiln+1;

for ($i=0;$i<$jmllabel;$i++)
{
$labels .="{label:'$label[$i]'},";
}


for ($v=0;$v<=$jmllabel;$v++)
{
//$chart="";
if($v != 0){
$chart .="s$v,";
//$chart=substr($chart,0,-1);
}

}

for ($x=0;$x<$hasiln;$x++)
{
$xy = $x+1;
//$chart="";
$sat .="var s$xy = [$hasilcc[$x]]; ";
//$chart=substr($chart,0,-1);

}

$labels=substr($labels,0,-1);
$chart=substr($chart,0,-1);
$sat=substr($sat,0,-1);


$TotHasil = array_sum($hasilcc);
$Rat = $TotHasil/$hit;
$TotRat = round($Rat,2);
$ValKategori = Nilai($TotRat,2);

$sRataFakultasChart1 = "var s$rataFakultas=[$TotRat];";
$sRataFakultasChart2 = ",s$rataFakultas";
$LabelChart=",{label:'Rata-rata Fakultas'}";


	$cnpage.="<script class=\"code\" type=\"text/javascript\">
					$(document).ready(function(){
					
										
					$sat $sRataFakultasChart1
				  
						
						var ticks = [13];
					
					
						plot2 = $.jqplot('chart2', [$chart $sRataFakultasChart2], {
						    seriesDefaults: {
						        renderer:$.jqplot.BarRenderer,
						        pointLabels: { show: true }
						    },
						    
							series:[
								$labels,{label:'Rata-rata Fakultas'} 
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
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=proses&th=$thAkademik'\" class='nodis'/>
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PERWALIAN MAHASISWA</b><br />
					<b>$Fak</b><br>
					<b>TAHUN AKADEMIK $thAkademik</b>
				</center>
				
				<table class='footer'>
					<tr>
						<td>FAKULTAS</td>
						<td>:</td>
						<td>$Fak</td>
					</tr>
				</table>
				
				<div class=\"clear\"></div>";
				
				$cnpage.="
				<table class='tablesorter'>
				<thead>
				<tr>
				<th width='5'>No.</th>
				<th width='200'>Jurusan</th>
				<th width='100'>Nilai</th>
				<th width='100'>Kategori</th>
				</tr>
				</thead>
				<tbody>
				$tabjur
				<tr>
				<td colspan='2' align='center'><b>Rata-rata Fakultas</b></td><td align='center'><b>$TotRat</b></td><td align='center'><b>$ValKategori</b></td>
				</tr>
				</tbody>
				</table>
				<br />";
				
				
				$cnpagetable="
				<table  width='50%' border='1' bordercolor='#000000'>
					<thead>
					<tr>
					<th width='5' align='center'>No.</th>
					<th width='30'>Rentang Skor</th>
					<th width='15'>Nilai</th>
					</tr>
					</thead>
					<tbody>
					$tb
					</tbody>
				</table>
				";
				
				
				$cnpage.="<div id=\"chart2\" style=\"width:750px; height:200px;\"></div><br>$cnpagetable";
				
				$cnpage.="<br />
				<table class='pad5 footer' >
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>Malang, ".TglFormat5($ndate)."</td>
					</tr>
					<tr>
						<td width='70%'></td>
						<td>Kepala BKMA,</td>
					</tr>
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td><br><br>".$ttd["pr1"]."</td>
					</tr>
				</table>";		
			
break;

case"view_dosen":
$IDjur = $_GET['jur'];
$thAkademik = $_GET['th'];
$IDfakultas = $_GET['fa'];
$Nfak = $_GET['Nf'];
$fakultas = strtoupper($Nfak);
$jN = $_GET['jN'];
$Jur = strtoupper($jN);

include"setting/kon.php";	
$tableLast=str_replace("/", "_", $thAkademik);
$NamaTable="zdb_perwalian_$tableLast";

$qcektable ="SHOW TABLES FROM db_bkma WHERE Tables_in_db_bkma = '$NamaTable'";
$hacektable = mysql_query($qcektable);
$hitcektable = mysql_num_rows($hacektable);
if($hitcektable){
include"setting/kon.php";	
$qdosen = "SELECT DISTINCT a.no_dosen,a.prodi
FROM $NamaTable a
WHERE a.prodi = '$IDjur'";
$ha = mysql_query($qdosen);
$count = mysql_num_rows($ha);
if($count){
while($dd = mysql_fetch_array($ha)){

include"setting/kon_baa.php";

$NoDosen=$dd[no_dosen];
$qDoReples="SELECT b.namaDosen,b.gelarLengkap FROM master_dosen b WHERE b.no_dosen='$NoDosen' ";
$hqDoRep = mysql($neomaa, $qDoReples);
while($ddReples = mysql_fetch_array($hqDoRep)){

$nu++;
$Dosen = $ddReples[namaDosen];
$nama = "$Dosen $dd[gelarLengkap]";
$Dlink="<a href=\"?pages=$pages&act=dosen_val&jur=$IDjur&th=$thAkademik&fa=$IDfakultas&Dn=$NoDosen&nm=$nama\">
$Dosen $dd[gelarLengkap]</a>";
$nilai = HitKuesionerDosen2($NoDosen,$IDjur,$NamaTable);
//$nilai = HitKuesioner2($IDjur,$NamaTable);
$valnilai = round($nilai,2);
//$kat = KategoriPenilaian($nilai,1);
$kat = Nilai($valnilai,2);

$nil[] = $valnilai;
$nameDosen[] = $Dosen;

$tdosen .="
<tr>
<td>$nu</td>
<td>$Dosen $ddReples[gelarLengkap]</td>
<td align='center'>$valnilai</td>
<td align='center'>$kat</td>
</tr>
";
}}

}else{$tdosen='<tr><td colspan="5">Data Belum Ada</td></tr>';}
}else{$tdosen='<tr><td colspan="5">Data Belum Ada</td></tr>';}

$jml_ndname = count($nameDosen);
$jml_nil = count($nil);

$chartDosen = $jml_nil+1;

for($o=0;$o<$jml_ndname;$o++){

	$labels .= "{label:'$nameDosen[$o]'},";
	$xy = $o+1;
	$slab .="s$xy,";
	$sat .="var s$xy = [$nil[$o]]; ";

}

$labelS = substr($slab,0,-1);
$var = substr($sat,0,-1);
$lb = substr($labels,0,-1);
//$NameDS = substr($labels,0,-1);
if($nil){
$totnilaiRata = array_sum($nil);
$RataNilaiDosen = $totnilaiRata/$count;
$katDosen = Nilai($RataNilaiDosen,2);
}
$sRataFakultasChart1 = "var s$chartDosen=[$RataNilaiDosen];";
$sRataFakultasChart2 = ",s$chartDosen";
$LabelChart=",{label:'Rata-rata Fakultas'}";

$cnpage.="<script class=\"code\" type=\"text/javascript\">
					$(document).ready(function(){
														
					$var $sRataFakultasChart1
									  					
						var ticks = [$jml_nil];
					
					
						plot2 = $.jqplot('chart2', [$labelS $sRataFakultasChart2], {
						    seriesDefaults: {
						        renderer:$.jqplot.BarRenderer,
						        pointLabels: { show: true }
						    },
						    
							series:[
								$lb  ,{label:'Rata-rata Jurusan'}
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
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=ks-perwalian&act=lapJur&th=$thAkademik'\" class='nodis'/>

				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PERWALIAN MAHASISWA</b><br />
					<b>$fakultas</b><br>
					<b>TAHUN AKADEMIK $thAkademik</b>
				</center>
				
				<table class='footer'>
					<tr>
						<td>FAKULTAS</td>
						<td>:</td>
						<td>$fakultas</td>
					</tr>
					<tr>
						<td>JURUSAN</td>
						<td>:</td>
						<td>$Jur</td>
					</tr>
				</table>
				
				<div class=\"clear\"></div>";
				
				$cnpage.="
				<table class='tablesorter'>
				<thead>
				<tr>
				<th width='5'>No.</th>
				<th width='200'>Nama Dosen</th>
				<th width='50'>Nilai</th>
				<th width='80'>Kategori</th>
				</tr>
				</thead>
				<tbody>
				$tdosen
				<tr>
				<td colspan='2' align='center'><b>RATA-RATA JURUSAN</b></td>
				<td align='center'><b>$RataNilaiDosen<b></td>
				<td align='center'><b>$katDosen</b></td>
				</tr>
				</tbody>
				</table>
				<br />";
				
				$cnpagetable="
				<table  width='50%' border='1' bordercolor='#000000'>
					<thead>
					<tr>
					<th width='5' align='center'>No.</th>
					<th width='30'>Rentang Skor</th>
					<th width='15'>Nilai</th>
					</tr>
					</thead>
					<tbody>
					$tb
					</tbody>
				</table>
				";
				
				$cnpage.="<div id=\"chart2\" style=\"width:750px; height:200px;\"></div><br>$cnpagetable";
								
				$cnpage.="<br />
				<table class='pad5 footer' >
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>Malang, ".TglFormat5($ndate)."</td>
					</tr>
					<tr>
						<td width='70%'></td>
						<td>Kepala BKMA,</td>
					</tr>
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td><br><br>".$ttd["pr1"]."</td>
					</tr>
				</table>";			
break;

case"dosen_val":
$IDjur = $_GET['jur'];
$thAkademik = $_GET['th'];
$IDfakultas = $_GET['fa'];
$IDdosen = $_GET['Dn'];
$namaDosen = $_GET['nm'];

include"setting/kon_baa.php";	
$q = "SELECT a.nama_depart, b.namaFakultas 
FROM in_programstudi a
INNER JOIN in_fakultas b
ON a.kodeFakultas = b.kode
WHERE a.kode = '$IDjur' ";
$hs = mysql($neomaaref, $q);
$dat = mysql_fetch_array($hs);
$namaFakultas = $dat['namaFakultas'];
$namaJurusan = $dat['nama_depart'];

$tableLast=str_replace("/", "_", $thAkademik);
$NamaTable="zdb_perwalian_$tableLast";

include"hasilquis.php";

$b = array_sum($totrata);
$rataRekap1 = $b/$hit;
$rataRekap = round($rataRekap1,2);
$raRekap = Nilai($rataRekap,2);

$TotRata = count($totrata);
$Rekap = count($rekap);
$nilai = count($NilaiRata);

for($o=0;$o<=$Rekap;$o++){
$labels .= "{label:'$rekap[$o]'},";
	if($o != 0){
	$slab .="s$o,";
	}
	$xy = $o+1;
	//$chart="";
	$sat .="var s$xy = [$NilaiRata[$o]]; ";

}

$labelS = substr($slab,0,-1);
$var = substr($sat,0,-1);
$lb = substr($labels,0,-1);

$cnpage.="<script class=\"code\" type=\"text/javascript\">
					$(document).ready(function(){
														
					$var
									  					
						var ticks = [$TotRata];
					
					
						plot2 = $.jqplot('chart2', [$labelS], {
						    seriesDefaults: {
						        renderer:$.jqplot.BarRenderer,
						        pointLabels: { show: true }
						    },
						    
							series:[
								$lb
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

$cnpagerekap.="<h3>REKAPITULASI EVALUASI KINERJA PELAYANAN PERWALIAN MAHAASISWA</h3><table class=\"tablesorter\">
				<thead>
				<tr>
				<th width='5'>No.</th>
				<th>KOMPONEN EVALUASI</th>
				<th width='50'>SKOR</th>
				<th width='100'>KATEGORI</th>
				</tr>
				</thead>
				<tbody>
				$eval
				<tr>
				<td colspan='2' align='center'><b>RATA-RATA</b></td><td align='center'><b>$rataRekap</b></td><td><b>$raRekap</b></td>
				</tr>
				</tbody>
				</table>";

$cnpage.="
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=lapDos&th=$thAkademik'\" class='nodis'/>


				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
	
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PERWALIAN MAHASISWA</b><br />
					<b>UNIVERSITAS MUHAMMADIYAH MALANG</b><br>
					<b>TAHUN AKADEMIK $thAkademik</b>
				</center>
				
				<table class='footer'>
					<tr>
						<td>FAKULTAS</td>
						<td>:</td>
						<td>$namaFakultas</td>
					</tr>
					<tr>
						<td>JURUSAN</td>
						<td>:</td>
						<td>$namaJurusan</td>
					</tr>
					<tr>
						<td>DOSEN WALI</td>
						<td>:</td>
						<td>$namaDosen</td>
					</tr>
				</table>
				$lop
				<div class=\"clear\"></div><br><br>$cnpagerekap";
				
				
				
											
				$cnpage.="<br><br><div id=\"chart2\" style=\"width:750px; height:200px;\"></div>";
				
				$cnpage.="<br />
				<table class='pad5 footer' >
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>Malang, ".TglFormat5($ndate)."</td>
					</tr>
					<tr>
						<td width='70%'></td>
						<td>Kepala BKMA,</td>
					</tr>
					<tr>
						<td width='70%'>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td><br><br>".$ttd["pr1"]."</td>
					</tr>
				</table>";		
break;

case"Dosen":
$Fakultas = $_GET['Nfak'];
$TahunA = $_GET['th'];
$headFk = strtoupper($Fakultas);
$Fakcode = $_GET['FaKode'];
$tableLast=str_replace("/", "_", $TahunA);
$TabName="zdb_perwalian_$tableLast";

include"setting/kon_baa.php";	
$q="SELECT kode,nama_depart FROM in_programstudi where kodeFakultas = '$Fakcode'";
$hhs = mysql($neomaaref, $q);
$totdt = mysql_num_rows($hhs);
if($totdt){
	$tab_Ds ="";
	$DJur2="";
	$DJur=" ";
	include"setting/kon.php";	
	while ($rr = mysql_fetch_array($hhs)){
	$kode = $rr['kode'];
	$DJur="";
	$tJur="SELECT DISTINCT a.no_dosen 
	FROM $TabName a
	WHERE a.prodi = '$kode' ";
	$hasJ = mysql_query($tJur);
	$ada = mysql_num_rows($hasJ);
	if($ada){
	
	/*
	$posisi2 =  ($ada/2) + 1;
	if($posisi2 < 2){$posisi = 1;}else{$posisi = ceil($posisi2);}
	*/
	 
	while($daJ = mysql_fetch_array($hasJ)){
	include"setting/kon_baa.php";	
	$NODosen = $daJ[no_dosen];
	$qrJurnew="SELECT b.namaDosen, b.gelarLengkap  FROM master_dosen b WHERE b.no_dosen ='$NODosen' ";
	$hsJur = mysql($neomaa, $qrJurnew);
	$cckqry = mysql_num_rows($hsJur);
	
	if($cckqry){
	while($daJReplase = mysql_fetch_array($hsJur)){
	$NDj++;
	$NamaDep = $rr['nama_depart'];
	$kodeDosen = $daJReplase['no_dosen'];
	$Ni2 = HitKuesionerDosen2($kodeDosen,$kode,$TabName);
	$Ni = round($Ni2,2);
	$katNil = Nilai($Ni,2);
	
	$DlinkD="<a href=\"?pages=ks-perwalian&act=DosenValue&FaKode=$Fakcode&Nfak=$Fakultas&jur=$kode&th=$TahunA\">$NamaDep</a>";
	
	$DJur .="
	<tr>
	<td align='center'>$NDj</td>
	<td>$daJReplase[namaDosen]</td>
	<td>$NamaDep</td>
	<td align='center'>$Ni</td>
	<td align='center'>$katNil</td>
	</tr>
	";
	}
	
	}}
	
	}else{$DJur2 ="<tr><td colspan='5'>Data Belum Ada</td></tr>";}
	
	if($DJur){$DJur2="";}
	
	$tab_Ds .="<h4>$rr[nama_depart]</h4>
	<table class='tablesorter'>
	<thead>
	<tr>
	<th>No</th>
	<th>Nama Dosen</th>
	<th>Jurusan</th>
	<th>Nilai</th>
	<th>Kategori</th>
	</tr>
	</thead>
	
	<tbody>
	$DJur
	$DJur2
	</tbody>

	</table><br>
	";
	
	
	
	}
}

$cnpage.="
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=ks-perwalian&act=proses&th=$TahunA '\" class='nodis'/>
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PERWALIAN MAHASISWA</b><br />
					<b>$headFk</b><br>
					<b>TAHUN AKADEMIK $TahunA</b>
				</center>
			
				
				<div class=\"clear\"></div><br><br>$tab_Ds";
break;

case"DosenValue":
$th = $_GET['th'];
$IDjur = $_GET['jur'];
$Njur = $_GET['Njur'];
$FaKode = $_GET['FaKode'];
$tableLast=str_replace("/", "_", $th);
$Tb = "zdb_perwalian_$tableLast";


$qry="SELECT DISTINCT a.no_dosen
FROM $Tb a 
WHERE a.prodi = '$IDjur' ";
$hh = mysql_query($qry);
$hit = mysql_num_rows($hh);
if($hit){

$qbag = "SELECT id,bagian FROM db_bagian WHERE kategori = '2' and hapus = '0' ORDER BY urutan asc";
$ha = mysql_query($qbag);
$hitN = mysql_num_rows($ha);
if($hitN){
	while($fet = mysql_fetch_array($ha)){
	$subT .="<th bgcolor='#CCCCCC'>$fet[bagian]</th>";
	$bg = $fet[id];
	$jmbg[] =$bg; 
	//$subtd="";

	}
}


$ttab="";
while($do = mysql_fetch_array($hh)){
$nomer++;
$no_dosen = $do[no_dosen];
include"setting/kon_baa.php";
$qReples="SELECT b.namaDosen, b.gelarLengkap FROM master_dosen b WHERE b.no_dosen = '$no_dosen' ";
$hreply = mysql($neomaa, $qReples);
while($doReples = mysql_fetch_array($hreply)){

$gelar = $doReples[gelarLengkap]; 

include"setting/kon.php";
$qrdbag = "SELECT DISTINCT a.no_dosen, a.bagian 
FROM $Tb a 
WHERE a.no_dosen = '$no_dosen' and a.prodi = '$IDjur' ";
$hqr = mysql_query($qrdbag);
$dht = mysql_num_rows($hqr);
if($dht){
	$subtd="";
	$subtd2="";
	$bb="";
	while($rr = mysql_fetch_array($hqr)){
	$IDbagian = $rr[bagian];
	$niD = HitRataDosen($IDbagian,$no_dosen,$Tb);
	$totBag[] = $niD;
	$Tsub .= count($totBag);
	$subtd .="<td align='center'>$niD</td>";
	
	$nID2 = HitRataDosenJur($IDbagian,$IDjur,$Tb);
	$subtd2 .="<td align='center' bgcolor='#CCCCCC'><b>$nID2</b></td>";
	}
	 
}

$rataDosen = HitKuesionerDosen2($no_dosen,$IDjur,$Tb);
$rtDS[] = $rataDosen;
$katratDosen = Nilai($rataDosen,2);
//echo count($totBag);
//echo $subtd ="<td>$niD</td>";
$ttab .="<tr>
<td colspan='3'>$nomer</td>
<td>$doReples[namaDosen] $gelar</td>
<td>$Njur</td>
$subtd
<td align='center'>$rataDosen</td>
<td align='center'>$katratDosen</td>
</tr>
";
		}
	}
}else{$ttab .="<tr>
<td colspan='8'>DATA BELUM ADA</td>
</tr>
";}
if($rtDS){
$jum_Rata =  array_sum($rtDS);
$tot_Rata = count($rtDS);
$RataJurusan = $jum_Rata/$tot_Rata;
$katratJurusan = Nilai($RataJurusan,2);
}
//echo count($jmbg);
$TabHead = "<table width='952' border='1' >
<thead>
<tr>
<th colspan='3' rowspan='2' bgcolor='#CCCCCC'>No</th>
<th width='208' rowspan='2' bgcolor='#CCCCCC'>Nama Dosen </th>
<th width='171' rowspan='2' bgcolor='#CCCCCC'>Program Studi </th>

<th height='24' colspan='$hitN' bgcolor='#CCCCCC'>Skor Kinerja </th>

<th width='105' rowspan='2' bgcolor='#CCCCCC'>Rata-rata</th>
<th width='108' rowspan='2' bgcolor='#CCCCCC'>Kategori</th>
</tr>
<tr>
$subT
</tr>
</thead>
<tbody>

$ttab

<tr>
<td colspan='5' bgcolor='#CCCCCC' align='center'><b>RATA-RATA JURUSAN</b></td>

$subtd2

<td bgcolor='#CCCCCC' align='center'><b>$RataJurusan</b></td>
<td bgcolor='#CCCCCC' align='center'><b>$katratJurusan</b></td>
</tr>

</tbody>
</table>";



$cnpage.="
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=ks-perwalian&act=lapJur&th=$th'\" class='nodis'/>

			
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PEMBIMBINGAN PERWALIAN MAHASISWA TAHUN AKADEMIK $th</b><br />
					<b>UNIVERSITAS MUHAMMADIYAH MALANG</b>
				</center>
			
				
				<div class=\"clear\"><br>$TabHead</div>";
break;

case"responden":

$IDJur = $_GET[Jur];
$Name = $_GET[Name];
$thAkademik=$_GET[th];
$Dosen = $_GET[Dosen];
$tableLast=str_replace("/", "_", $thAkademik);
$Tb = "zdb_perwalian_$tableLast";

include"setting/kon_baa.php";
$qir="SELECT  a.nama_depart, b.namaFakultas 
FROM in_programstudi a
LEFT JOIN in_fakultas b
ON a.kodeFakultas = b.kode
WHERE a.kode = '$IDJur'";
$hd = mysql($neomaaref, $qir);
$dhd = mysql_fetch_array($hd);

include"hasilresponden.php";

$cnpage.="
<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='?pages=$pages&act=proses&th=$thAkademik'\" class='nodis'/>
				<input type=\"button\" name=\"button\" value=\"Cetak\" onclick=\"window.print();\" class='nodis'/>
				
				".PHeader()."
				
				<center class='upercase'>
					<b>REKAPITULASI KINERJA PELAYANAN PERWALIAN MAHASISWA</b><br />
					<b>UNIVERSITAS MUHAMMADIYAH MALANG</b><br>
					<b>TAHUN AKADEMIK $thAkademik</b>
				</center>
				
				<table class='footer'>
					<tr>
						<td>FAKULTAS</td>
						<td>:</td>
						<td>$dhd[namaFakultas]</td>
					</tr>
					<tr>
						<td>JURUSAN</td>
						<td>:</td>
						<td>$dhd[nama_depart]</td>
					</tr>
					<tr>
						<td>DOSEN</td>
						<td>:</td>
						<td>$Name</td>
					</tr>
				</table>
				
				<div class=\"clear\"></div><br><br>$lop";
break;
}}
?>
