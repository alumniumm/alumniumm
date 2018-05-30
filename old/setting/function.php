<?php
function Menu($level, $pages, $vmode){
	include"kon.php";
	$list=array();
	
	$sqld="select * from db_user_level where id=\"$level\" and hapus=\"0\" and status=\"1\"";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$fdata=mysql_fetch_assoc($data);
		$hak_akses=$fdata["hak_akses"];
	}else{
		$hak_akses="1,8,";
	}
	
	$hak_akses=substr($hak_akses,0,-1);
	
	$sqld2="select * from db_menu where submenu=\"0\" and id in ($hak_akses) and hapus=\"0\" and status=\"1\" ".
			"order by urutan";
	$data2=mysql_query($sqld2);
	$ndata2=mysql_num_rows($data2);
	if($ndata2>0){
		while($fdata2=mysql_fetch_assoc($data2)){
			$id_menu=$fdata2["id"];
			$nama_menu=$fdata2["nama_menu"];
			
			$sqld3="select * from db_menu where submenu=\"$id_menu\" and id in ($hak_akses) and hapus=\"0\" and ".
					"status=\"1\" order by urutan";
			$data3=mysql_query($sqld3);
			$ndata3=mysql_num_rows($data3);
			if($ndata3>0){
				
				$mn.="<h3>$nama_menu</h3>";
				$mn.="<ul class=\"toggle\">";
				
				while($fdata3=mysql_fetch_assoc($data3)){
					$id_menu2=$fdata3["id"];
					$nama_menu2=$fdata3["nama_menu"];
					$page2=$fdata3["page"];
					$modul2=$fdata3["modul"];
					
					if($page2=="$pages"){
						$active="active";
						$page_modul="$modul2/index.php";
					}else{
						$active="";
					}
					
					$mn.="<li class=\"icn_settings $active\"><a href=\"?pages=$page2\">$nama_menu2</a></li>";
				}
				
				$mn.="<ul>";
			}
		}
	}
	
	$list["modul"]=($vmode==1)? "1" : "$page_modul";
	$list["menu"]="$mn";
	
	return $list;
}

function cariPosisi($batas, $hal){
	if(empty($hal)){$posisi=0; $hal=1;}
	else{$posisi = ($hal-1) * $batas;}
	return $posisi;
}

function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = @ceil($jmldata/$batas);
	return $jmlhalaman;
}

function navPage($h_aktif, $jmlhal, $link){
	$link_hal="";
	$h_aktif=($h_aktif<=0)? "1" : "$h_aktif";
	
	if($jmlhal>1){
		if($h_aktif > 1){
			$p=$h_aktif-1;
			$link_hal.="<a href='$link&hal=1'>Pertama</a>";
			$link_hal.="<a href='$link&hal=$p'>Sebelumnya</a>";
		}
		
		$link_hal .=($h_aktif > 3 ? " " :" ");
		
		for($i=$h_aktif-2;$i<$h_aktif;$i++){
			if ($i < 1) continue;
			$link_hal.="<a href='$link&hal=$i'>$i</a>";
		}
		
		$link_hal.="<span class=\"active\">$i</span>";
		
		for($i=$h_aktif+1;$i<($h_aktif+3);$i++){
			if ($i > $jmlhal) break;
			$link_hal.="<a href='$link&hal=$i'>$i</a>";
		}
		
		$link_hal.=($h_aktif+3<$jmlhal ? " " : " ");
		
		if($h_aktif<$jmlhal){
			$n=$h_aktif+1;
			$link_hal.="<a href='$link&hal=$n'>Selanjutnya</a>";
			$link_hal.="<a href='$link&hal=$jmlhal'>Terakhir</a>";
		}
	}

	return $link_hal;
}

function TglFormat1($tanggal){
	$list=date("d-m-Y", strtotime($tanggal));
	return $list;
}

function TglFormat2($tanggal){
	$list=date("d/m/Y H:i:s A", strtotime($tanggal));
	return $list;
}

function TglFormat3($tanggal){
	$list=date("d-m-Y H:i:s", strtotime($tanggal));
	return $list;
}

function TglFormat4($tanggal){
	$list=date("ydmHi", strtotime($tanggal));
	return $list;
}

function TglFormat5($tanggal){
	$tgl = substr($tanggal,8,2);
	$bulan = NamaBulan(substr($tanggal,5,2));
	$tahun = substr($tanggal,0,4);
	$tgl_all ="$tgl $bulan $tahun";
	
	return $tgl_all;
}

function NamaBulan($bln){
	switch ($bln){
		case 1: return "Januari"; break;
		case 2: return "Februari"; break;
		case 3: return "Maret"; break;
		case 4: return "April"; break;
		case 5: return "Mei"; break;
		case 6: return "Juni"; break;
		case 7: return "Juli"; break;
		case 8: return "Agustus"; break;
		case 9: return "September"; break;
		case 10: return "Oktober"; break;
		case 11: return "November"; break;
		case 12: return "Desember"; break;
	}
} 

function NamaMhs($nim){
	include"kon_baa.php";
	
	$sqld="select * from master_siswa where kode_siswa=\"$nim\"";
	$data=mysql($neomaa, $sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$fdata=mysql_fetch_assoc($data);
		extract($fdata);
		$list="$nama_siswa";
	}
	
	return $list;
}

function NamaDosen($no_dosen){
	include"kon_baa.php";
	
	$sqld="select * from master_dosen where no_dosen=\"$no_dosen\"";
	$data=mysql($neomaa, $sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$fdata=mysql_fetch_assoc($data);
		extract($fdata);
		$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
		
		$list="$nama_dosen";
	}
	
	return $list;
}

function NamaProdi($id){
	include"kon_baa.php";
	
	$sqld="SELECT a.nama_depart, b.namaFakultas,b.kode FROM in_programstudi AS a INNER JOIN ".
			"in_fakultas AS b ON b.kode = a.kodeFakultas where a.kode=\"$id\"";
	$data=mysql($neomaaref, $sqld);
	$fdata=mysql_fetch_assoc($data);
	
	return $fdata;
}

function SelProdi($gid, $gname, $req=""){
	include"kon_baa.php";
	
	$list="<select name=\"$gname\" class=\"combobox\" $req>";
	$list.="<option value=\"\">- Pilih -</option>";
	
	$sqld="select * from in_programstudi order by nama_depart asc";
	$data=mysql($neomaaref, $sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($kode==$gid)? "selected=\"selected\"" : "";
			
			$list.="<option value=\"$kode\" $sel1>$nama_depart</option>";
		}
	}
	
	$list.="</select>";
	
	return $list;
}

function SelTahunMasuk($gid, $gname, $req=""){
	include"kon.php";
	
	$list="<select name=\"$gname\" $req>";
	$list.="<option value=\"\">- Pilih -</option>";
	
	$sqld="select * from db_tahun_akademik where status=\"0\" order by tahun_ajar desc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($tahun_ajar==$gid)? "selected=\"selected\"" : "";
			
			$list.="<option value=\"$tahun_ajar\" $sel1>$tahun_ajar</option>";
		}
	}
	
	$list.="</select>";
	
	return $list;
}

function SelSemester($gid, $gname, $ketd="", $req=""){
	include"kon_baa.php";
	$list="";
	
	if(empty($ketd)){
		$list.="<select name=\"$gname\" $req>";
		$list.="<option value=\"\">- Pilih -</option>";
	}else{
		if($ketd==1){
			$where="where id=\"$gid\"";
		}
	}
	
	$sqld="select * from in_semester $where order by id asc";
	$data=mysql($neomaaref, $sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($id==$gid)? "selected=\"selected\"" : "";
			
			if(empty($ketd)){
				$list.="<option value=\"$id\" $sel1>$semester</option>";
			}else{
				if($ketd==1){
					$list.="$semester";
				}
			}
		}
	}
	
	if(empty($ketd)){
		$list.="</select>";
	}
	
	return $list;
}

function SelStatus($gid, $gname, $req=""){
	$list="";
	
	$sel1=($gid==1)? "selected=\"selected\"" : "";
	$sel2=($gid==2)? "selected=\"selected\"" : "";
	
	$list.="<select name=\"$gname\" $req>
		<option value=\"\">- Pilih -</option>
		<option value=\"1\" $sel1>Aktif</option>
		<option value=\"2\" $sel2>Tidak Aktif</option>
	</select>";
	
	return $list;
}

function Nilai($nilai, $kategori, $ketd=""){
	include"kon.php";
	
	if(empty($ketd)){
		$where="batas_awal<=\"$nilai\" and batas_akhir>=\"$nilai\" and";
		$limit="limit 1";
	}else{
		$where="";
		$limit="order by batas_akhir desc";
	}
	
	$sqld="select * from db_nilai where $where status=\"1\" and hapus=\"0\" and kategori=\"$kategori\" $limit";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			
			$batas_awal=@number_format($batas_awal, 2, ",", ".");
			$batas_akhir=@number_format($batas_akhir, 2, ",", ".");
			
			if(empty($ketd)){
				$list="$ket_nilai";
			}else{
				$list.="$batas_awal - $batas_akhir = $ket_nilai; ";
			}
		}
	}
	
	return $list;
}

function RataJurusan($prodi, $gbase, $gp, $nama_table){
	include"kon.php";
	$list=array();
	
	$sqld4="select * from db_bagian where status=\"1\" and hapus=\"0\" and kategori=\"1\" order by urutan asc";
	$data4=mysql_query($sqld4);
	$ndata4=mysql_num_rows($data4);
	if($ndata4>0){
		while($fdata4=mysql_fetch_assoc($data4)){
			$id_bagian=$fdata4["id"];
	
			$sqld3="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" and prodi=\"$prodi\" ".
					"group by no_dosen order by no_dosen asc";
			$data3=mysql_query($sqld3);
			$ndata3=mysql_num_rows($data3);
			if($ndata3>0){
				while($fdata3=mysql_fetch_assoc($data3)){
					$gid=$fdata3["no_dosen"];
					
					$sqld2="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
							"and no_dosen=\"$gid\" and bagian=\"$id_bagian\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){ $jml1="";
						while($fdata2=mysql_fetch_assoc($data2)){
							extract($fdata2);
							
							$isi_kurang_s=($isi_kurang_s==0)? "0" : "1";
							$isi_kurang=($isi_kurang==0)? "0" : "2";
							$isi_baik=($isi_baik==0)? "0" : "3";
							$isi_baik_s=($isi_baik_s==0)? "0" : "4";
							
							$nilai_max=@max($isi_kurang_s, $isi_kurang, $isi_baik, $isi_baik_s);
							$jml1=$jml1 + $nilai_max;
							
						}
					}
					
					$jml2=@round($jml1/$ndata2,2);
					$jmlrt=$jmlrt + $jml2;
					
				}
				
				$avrt=@round($jmlrt/$ndata3,2);
				$numformat=@number_format($avrt, 2, ".", ",");
				$jmlrt="";
				
				$total_av=$total_av + $avrt;
				$list1.="<td align='center'>$numformat</td>";
			}
		}
		
		$total_av=@round($total_av/$ndata4,2);
	}
	
	$list["td"]="$list1";
	$list["rata"]="$total_av";
	
	return $list;
}

function RataFakultas($prodi, $gbase, $gp, $nama_table){
	include"kon_baa.php";
	$list=array();
	
	$sqlp="select * from in_programstudi where kode=\"$prodi\" limit 1";
	$pdata=mysql($neomaaref, $sqlp);
	$pndata=mysql_num_rows($pdata);
	if($pndata>0){
		$fdata=mysql_fetch_assoc($pdata);
		$kodefk=$fdata["kodeFakultas"];
		
		$sqlp2="select * from in_programstudi where kodeFakultas=\"$kodefk\"";
		$pdata2=mysql($neomaaref, $sqlp2);
		$pndata2=mysql_num_rows($pdata2);
		if($pndata2>0){
			while($fdata2=mysql_fetch_assoc($pdata2)){
				$kodeps=$fdata2["kode"];
				$inkodeps.="'$kodeps',";
			}
		}
	}
	
	$inkodeps=substr($inkodeps,0,-1);
	
	include"kon.php";
	
	$sqld="select * from db_bagian where status=\"1\" and hapus=\"0\" and kategori=\"1\" order by urutan asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			$id_bagian=$fdata["id"];
	
	
			$sqld4="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" and prodi in ($inkodeps) ".
					"group by prodi order by prodi asc";
			$data4=mysql_query($sqld4);
			$ndata4=mysql_num_rows($data4);
			if($ndata4>0){
				while($fdata4=mysql_fetch_assoc($data4)){
					$kode_prodi=$fdata4["prodi"];
					
					$sqld2="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
							"and prodi=\"$kode_prodi\" and bagian=\"$id_bagian\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){ $jml1="";
						while($fdata2=mysql_fetch_assoc($data2)){
							extract($fdata2);
							
							$isi_kurang_s=($isi_kurang_s==0)? "0" : "1";
							$isi_kurang=($isi_kurang==0)? "0" : "2";
							$isi_baik=($isi_baik==0)? "0" : "3";
							$isi_baik_s=($isi_baik_s==0)? "0" : "4";
							
							$nilai_max=@max($isi_kurang_s, $isi_kurang, $isi_baik, $isi_baik_s);
							$jml1=$jml1 + $nilai_max;
							
						}
					}
					
					$jml2=@round($jml1/$ndata2,2);
					$jmlrt=$jmlrt + $jml2;
				}
				
				$avrt=@round($jmlrt/$ndata4,2);
				$numformat=@number_format($avrt, 2, ".", ",");
				$jmlrt="";
				
				$total_av=$total_av + $avrt;
				$list1.="<td align='center'>$numformat</td>";
			}
		}
		
		$total_av=@round($total_av/$ndata,2);
	}
	
	$list["td"]="$list1";
	$list["rata"]="$total_av";
	
	return $list;
}

function RataUniversitas($prodi, $gbase, $gp, $nama_table){
	include"kon.php";
	$list=array();
	
	$sqld="select * from db_bagian where status=\"1\" and hapus=\"0\" and kategori=\"1\" order by urutan asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			$id_bagian=$fdata["id"];
	
			$sqld4="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
					"group by prodi order by prodi asc";
			$data4=mysql_query($sqld4);
			$ndata4=mysql_num_rows($data4);
			if($ndata4>0){
				while($fdata4=mysql_fetch_assoc($data4)){
					$kode_prodi=$fdata4["prodi"];
					
					$sqld2="select * from $nama_table where tahun_ajar=\"$gbase\" and semester=\"$gp\" ".
							"and prodi=\"$kode_prodi\" and bagian=\"$id_bagian\"";
					$data2=mysql_query($sqld2);
					$ndata2=mysql_num_rows($data2);
					if($ndata2>0){ $jml1="";
						while($fdata2=mysql_fetch_assoc($data2)){
							extract($fdata2);
							
							$isi_kurang_s=($isi_kurang_s==0)? "0" : "1";
							$isi_kurang=($isi_kurang==0)? "0" : "2";
							$isi_baik=($isi_baik==0)? "0" : "3";
							$isi_baik_s=($isi_baik_s==0)? "0" : "4";
							
							$nilai_max=@max($isi_kurang_s, $isi_kurang, $isi_baik, $isi_baik_s);
							$jml1=$jml1 + $nilai_max;
							
						}
					}
					
					$jml2=@round($jml1/$ndata2,2);
					$jmlrt=$jmlrt + $jml2;
				}
				
				$avrt=@round($jmlrt/$ndata4,2);
				$numformat=@number_format($avrt, 2, ".", ",");
				$jmlrt="";
				
				$total_av=$total_av + $avrt;
				$list1.="<td align='center'>$numformat</td>";
			}
		}
		
		$total_av=@round($total_av/$ndata,2);
	}
	
	$list["td"]="$list1";
	$list["rata"]="$total_av";
	
	return $list;
}

function JenisInputan($inputan, $standart="", $standart2="", $gket="", $greq="", $gname=""){
	switch($inputan){
		case"1":
			$list="<input type=\"text\" name=\"standart_1"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " ex: A" : "";
		break;
		
		case"2":
			$list="<input type=\"text\" name=\"standart_2"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? "  ex: 10" : "";
		break;
		
		case"3":
			$list="<input type=\"text\" name=\"standart_3"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " ex: 10" : "";
		break;
		
		case"4":
			$sel1=($standart==1)? "selected=\"selected\"" : "";
			$sel2=($standart==2)? "selected=\"selected\"" : "";
			
			$list="<select name=\"standart_4"."$gname\" $greq>
				<option value=\"\">- Pilih -</option>
				<option value=\"1\" $sel1>Ada</option>
				<option value=\"2\" $sel2>Belum Ada</option>
			</select>";
			
			$list.=($gket==1)? " Pilih (Ada/Belum Ada)" : "";
		break;
		
		case"5":
			$list="<input type=\"text\" name=\"standart_5"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " &gt; Nilai" : "";
		break;
		
		case"6":
			$list="<input type=\"text\" name=\"standart_6"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " &lt; Nilai" : "";
		break;
		
		case"7":
			$list="<input type=\"text\" name=\"standart_7"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " &ge; Nilai" : "";
		break;
		
		case"8":
			$list="<input type=\"text\" name=\"standart_8"."$gname\" value=\"$standart\" size=\"1\" $greq/>";
			$list.=($gket==1)? " &le; Nilai" : "";
		break;
		
		case"9":
			$list="<input type=\"text\" name=\"standart_9"."$gname\" value=\"$standart\" size=\"1\" $greq/> : ";
			$list.="<input type=\"text\" name=\"standart2_9"."$gname\" value=\"$standart2\" size=\"1\" $greq/>";
			$list.=($gket==1)? " ex: 1:2" : "";
		break;
		
		case"10":
			$sel1=($standart==1)? "selected=\"selected\"" : "";
			$sel2=($standart==2)? "selected=\"selected\"" : "";
			
			$list="<select name=\"standart_10"."$gname\" $greq>
				<option value=\"\">- Pilih -</option>
				<option value=\"1\" $sel1>Sesuai</option>
				<option value=\"2\" $sel2>Tidak Sesuai</option>
			</select>";
			
			$list.=($gket==1)? " Pilih (Sesuai/Tidak Sesuai)" : "";
		break;
		
		case"11":
			$sel1=($standart==1)? "selected=\"selected\"" : "";
			$sel2=($standart==2)? "selected=\"selected\"" : "";
			
			$list="<select name=\"standart_11"."$gname\" $greq>
				<option value=\"\">- Pilih -</option>
				<option value=\"1\" $sel1>Ya</option>
				<option value=\"2\" $sel2>Tidak</option>
			</select>";
			
			$list.=($gket==1)? " Pilih (Ya/Tidak)" : "";
		break;
		
		case"12":
			$gname="standart_12"."$gname";
			$list=SelPendidikan($standart, $gname, "", $greq);
			$list.=($gket==1)? " Pilih Pendidikan" : "";
		break;
	}
	
	return $list;
}

function KetJenisInputan($inputan, $ket, $standart="", $standart2=""){
	$list=array();
	
	switch($inputan){
		case"1":
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]="=";
		break;
		
		case"2":
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]="=";
		break;
		
		case"3":
			$list["stn"]="$standart-$standart2";
			$list["ket"]="$standart-$standart2 $ket";
			$list["hasil"]="$standart $ket";
		break;
		
		case"4":
			$standart=($standart==1)? "Ada" : "Belum Ada";
			
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart";
			$list["jsimbol"]="=";
		break;
		
		case"5":
			$list["stn"]="$standart";
			$list["ket"]="&lt; $standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]="<";
		break;
		
		case"6":
			$list["stn"]="$standart";
			$list["ket"]="&gt; $standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]=">";
		break;
		
		case"7":
			$list["stn"]="$standart";
			$list["ket"]="&le; $standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]="<=";
		break;
		
		case"8":
			$list["stn"]="$standart";
			$list["ket"]="&ge; $standart $ket";
			$list["hasil"]="$standart $ket";
			$list["jsimbol"]=">=";
		break;
		
		case"9":
			$list["stn"]="$standart:$standart2";
			$list["ket"]="$ket";
			$list["hasil"]="$standart:$standart2";
		break;
		
		case"10":
			$standart=($standart==1)? "Sesuai" : "Tidak Sesuai";
			
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart";
			$list["jsimbol"]="=";
		break;
		
		case"11":
			$standart=($standart==1)? "Ya" : "Tidak";
			
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart";
			$list["jsimbol"]="=";
		break;
		
		case"12":
			$standart=SelPendidikan($standart, "", "1");
			
			$list["stn"]="$standart";
			$list["ket"]="$standart $ket";
			$list["hasil"]="$standart";
			$list["jsimbol"]=">=";
		break;
	}
	
	return $list;
}

function JenisIsian($gid, $gname, $standart, $standart2){
	include"kon.php";
	$list="";
	
	$sqld="select * from db_pertanyaan_jenis where status=\"1\" and hapus=\"0\" order by id asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$list.="<table class=\"tablesorter\">
			<thead>
				<tr>
					<th>Pilih</th>
					<th>Standart</th>
				</tr>
			</thead>
			<tbody>";
		
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			
			if($gid==$id){
				$jenis_input=JenisInputan($inputan, $standart, $standart2, "1");
				$sel1="checked=\"checked\"";
			}else{
				$jenis_input=JenisInputan($inputan, "", "", "1");
				$sel1="";
			}
			
			$list.="<tr>
				<td><input type=\"radio\" name=\"$gname\" value=\"$inputan\" $sel1 required/></td>
				<td>$jenis_input</td>
			</tr>";
		}
		
		$list.="</tbody></table>";
	}
	
	return $list;
}

function JenisPertanyaan($gid){
	include"kon.php";
	
	$sqld="select * from db_pertanyaan where status=\"1\" and hapus=\"0\" and id=\"$gid\" limit 1";
	$data=@mysql_query($sqld);
	$fdata=@mysql_fetch_assoc($data);
	
	return $fdata;
}

function SelSimbol($gid, $greq=""){
	$sel1=($gid=="*")? "selected=\"selected\"" : "";
	$sel2=($gid=="+")? "selected=\"selected\"" : "";
	$sel3=($gid=="-")? "selected=\"selected\"" : "";
	$sel4=($gid=="/")? "selected=\"selected\"" : "";
	
	$list="<select name=\"simbol\" $greq>
		<option value=\"\">- Pilih -</option>
		<option value=\"*\" $sel1>*</option>
		<option value=\"+\" $sel2>+</option>
		<option value=\"-\" $sel3>-</option>
		<option value=\"/\" $sel4>/</option>
	</select>";
	
	return $list;
}

function YPerhitungan($gid, $simbol, $kategori, $greq=""){
	include"kon.php";
	$list="";
	
	if($gid>0){
		$cek2="checked=\"checked\"";
	}else{
		$cek1="checked=\"checked\"";
	}
	
	$sqld="select * from db_bagian where kategori=\"$kategori\" and status=\"1\" ".
			"and hapus=\"0\" order by urutan asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		$op="<select name=\"selidp\">";
		$op.="<option value=\"\">- Pilih -</option>";
		
		while($fdata=mysql_fetch_assoc($data)){
			$idb=$fdata["id"];
			
			$sqld2="select * from db_pertanyaan where bagian=\"$idb\" and status=\"1\" and hapus=\"0\" ".
					"order by urutan asc";
			$data2=mysql_query($sqld2);
			$ndata2=mysql_num_rows($data2);
			if($ndata2>0){
				while($fdata2=mysql_fetch_assoc($data2)){
					$idp=$fdata2["id"];
					$pertanyaan=$fdata2["pertanyaan"];
					
					$sel1=($gid==$idp)? "selected=\"selected\"" : "";
					$op.="<option value=\"$idp\" $sel1>$pertanyaan</option>";
				}
			}
			
		}
		
		$op.="</select>";
	}
	
	$list.="<input type=\"radio\" name=\"phitung\" value=\"1\" $cek1 $greq/> Tidak<br />";
	$list.="<input type=\"radio\" name=\"phitung\" value=\"2\" $cek2 $greq/> Ya &raquo; ";
	$list.=SelSimbol($simbol)." dari $op";
	
	return $list;
}

function Kepala(){
	include"kon.php";
	
	$sqld="select * from db_kepala where status=\"1\" and hapus=\"0\" order by tgl_insert desc limit 1";
	$data=mysql_query($sqld);
	$fdata=mysql_fetch_assoc($data);
	
	return $fdata;
}

function PHeader(){
	$list="<center>
		<table class='pad5'>
			<tr>
				<td>
					<img src=\"images/hitam_putih_logo.jpg\" alt=\"hitam_putih_logo\" height=\"80\" width=\"80\"/>
				</td>
				<td width='30'>&nbsp;</td>
				<td align='center'>
					<h3 class='head'>Universitas Muhammadiyah Malang</h2>
					<h3 class='head'>Badan Kendali Mutu Akademik</h2>
					Kampus III: Jl. Raya Tlogomas No. 246 Malang Tlp. (0341) 464318 Psw. 230<br />
					Fax. 460783 Malang / e-mail: bkma@umm.ac.id
				</td>
				
			</tr>
		</table>
		<hr class='singgle' />
	</center>
	";

	return $list;
}

function SelPendidikan($gid, $gname, $ketd="", $greq=""){
	include"kon.php";
	$list="";
	
	if(empty($ketd)){
		$list.="<select name=\"$gname\" $greq>";
		$list.="<option value=\"\">- Pilih -</option>";
	}else{
		if($ketd==1){
			$where="where id=\"$gid\"";
		}
	}
	
	$sqld="select * from db_pendidikan $where order by urutan asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($id==$gid)? "selected=\"selected\"" : "";
			
			if(empty($ketd)){
				$list.="<option value=\"$id\" $sel1>$pendidikan</option>";
			}else{
				if($ketd==1){
					$list.="$pendidikan";
				}
			}
		}
	}
	
	if(empty($ketd)){
		$list.="</select>";
	}
	
	return $list;
}

function SelLevel($gid, $gname, $ketd="", $greq=""){
	include"kon.php";
	$list="";
	
	if(empty($ketd)){
		$list.="<select name=\"$gname\" class=\"level\" $greq>";
		$list.="<option value=\"\">- Pilih -</option>";
	}else{
		if($ketd==1){
			$where="where id=\"$gid\"";
		}
	}
	
	$sqld="select * from db_user_level $where order by nama_level asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($id==$gid)? "selected=\"selected\"" : "";
			
			if(empty($ketd)){
				$list.="<option value=\"$id\" $sel1>$nama_level</option>";
			}else{
				if($ketd==1){
					$list.="$nama_level";
				}
			}
		}
	}
	
	if(empty($ketd)){
		$list.="</select>";
	}
	
	return $list;
}

function SelPembimbing($gid, $gname, $ketd="", $greq=""){
	if($ketd==1){
		if($gid==1){ $list="Pembimbing 1"; }
		if($gid==2){ $list="Pembimbing 2"; }
	}else{
		$sel1=($gid=="1")? "selected=\"selected\"" : "";
		$sel2=($gid=="2")? "selected=\"selected\"" : "";
		
		$list="<select name=\"$gname\" $greq>
			<option value=\"\">- Pilih -</option>
			<option value=\"1\" $sel1>Pembimbing 1</option>
			<option value=\"2\" $sel2>Pembimbing 2</option>
		</select>";
	}
	
	return $list;
}

function SelDosen($gid, $gname, $ketd="", $greq=""){
	include"kon_baa.php";
	$list="";
	
	if(empty($ketd)){
		$list.="<select name=\"$gname\" class=\"combobox\" $greq>";
		$list.="<option value=\"\">- Pilih -</option>";
	}else{
		if($ketd==1){
			$where="where no_dosen=\"$gid\"";
		}
	}
	
	$sqld="select * from master_dosen $where order by namaDosen asc";
	$data=mysql($neomaa, $sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$nama_dosen=(empty($gelarLengkap))? "$namaDosen" : "$namaDosen, $gelarLengkap";
			$sel1=($no_dosen==$gid)? "selected=\"selected\"" : "";
			
			if(empty($ketd)){
				$list.="<option value=\"$no_dosen\" $sel1>$nama_dosen</option>";
			}else{
				if($ketd==1){
					$list.="$nama_dosen";
				}
			}
		}
	}
	
	if(empty($ketd)){
		$list.="</select>";
	}
	
	return $list;
}

//NEW FUNCTION PERPUS
function Kampus($id){
	include"kon_baa.php";
	
	$sqld="SELECT kampus FROM in_programstudi where kode=\"$id\"";
	$data=mysql($neomaaref, $sqld);
	$fdata=mysql_fetch_array($data);
	$kampus = $fdata['kampus'];
	
	return $kampus;
}

function SelKampus($id,$kampus){
	if($id > 0){$clause="kampus = $id and ";}else{$clause=" ";}
	include"kon_baa.php";
	$qr="SELECT DISTINCT kampus FROM in_programstudi WHERE $clause kampus !=0 order by kampus asc ";
	$hasil = mysql($neomaaref, $qr);
	$ht = mysql_num_rows($hasil);
	if($ht){
	$list .="<select name=\"$kampus\" required>";
	if($id ==""){
	$list.="<option value=\" \">-Pilih kampus-</option>";
	}	
		while($data = mysql_fetch_array($hasil)){
		$val = $data['kampus'];
		$list.="<option value=\"$val\">Kampus $val</option>";
		}
		$list.="</select>";
	}
	return $list;
}

function CekPerpusAktif($JenisPerpus, $idPerpus){
	include"kon.php";
	$qcek2 ="SELECT * FROM db_aktifasi_perpus WHERE jenis_perpus=\"$JenisPerpus\" and kode_perpus=\"$idPerpus\" ";
	$hs2 = mysql_query($qcek2);
	$hitcek2 = mysql_num_rows($hs2);
	if($hitcek2){
		$dat = mysql_fetch_array($hs2);
		$stat = $dat['status'];
		if($stat==1){return 1;}else{return 0;}
	}else{
		return 0;
	}
}

function SelLaboratorium($gid, $gname, $req="", $gket=""){
	include"kon.php";
	
	if($gket=="1"){
		$where="where id=\"$gid\"";
	}else{
		$list="<select name=\"$gname\" class=\"combobox\" $req>";
		$list.="<option value=\"\">- Pilih -</option>";
		
		$where="where status=\"1\" and hapus=\"0\"";
	}
	
	
	$sqld="select * from db_lab $where order by nama_lab asc";
	$data=mysql_query($sqld);
	$ndata=mysql_num_rows($data);
	if($ndata>0){
		while($fdata=mysql_fetch_assoc($data)){
			extract($fdata);
			$sel1=($id==$gid)? "selected=\"selected\"" : "";
			
			if($gket==1){
				if($sel1!=""){ $list="$nama_lab"; }
			}else{
				$list.="<option value=\"$id\" $sel1>$nama_lab</option>";
			}
			
		}
	}
	
	if($gket==""){
		$list.="</select>";
	}
	
	return $list;
}

function SelTahun($gid, $gname, $req="", $gket=""){
	$fdate="1990";
	$ndate=date("Y");
	
	for($i=$ndate;$i>=$fdate;$i--){
		$sel1=($i==$gid)? "selected=\"selected\"" : "";
		
		if($gket==1){
			if($sel1!=""){ $list="$nama_lab"; }
		}else{
			$list.="<option value=\"$i\" $sel1>$i</option>";
		}
	}
	if($gket==""){
		$list="<select name=\"$gname\" $req>
			<option value=\"\">- Pilih -</option>
			$list
		</select>";
	}else{
		$list=$list;
	}
	
	return $list;
}
?>
