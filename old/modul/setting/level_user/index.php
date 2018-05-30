<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	
	$link_back="?pages=$pages";
	$nama_table="db_user_level";
	$nama_table2="db_menu";
	
	$title_page="Data Level User";
	
	switch($act){
		default:
			$link_page="$link_back&gname=$gname";
			$posisi=cariPosisi($batas, $hal);
			
			$sqld="SELECT * FROM $nama_table where nama_level like \"%$gname%\" and hapus=\"0\" order by id asc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_status=($status==1)? "Aktif" : "Tidak Aktif";
					
					$edit="<a href=\"$link_back&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					
					if($id>5){
						$hapus="<a href=\"$link_back&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					}else{
						$hapus="";
					}
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$nama_level</td>
						<td>$nama_status</td>
						<td>$edit $hapus</td>
					</tr>";
					
					$no++;
				}
			}
			
			$jrow=mysql_query($sqld);
			$jnrow=mysql_num_rows($jrow);
			$jmlHal=jumlahHalaman($jnrow, $batas);	
			$LinkHal=navPage($hal, $jmlHal, $link_page);	
			if($jnrow > $batas){
				$thal="<br /><b>Jumlah Data = $jnrow</b>";
				$thal.="<div id=\"paging\">$LinkHal</div>";
			}
			
			$cnpage="<form name=\"form1\" action=\"\" method=\"get\">
				<input type=\"hidden\" name=\"pages\" value=\"$pages\" />
				
				<table class='pad5'>
					<tr>
						<td>Nama Level</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
				</table><br />
				<input type=\"submit\" name=\"cari\" value=\"Cari\" />
				<input type=\"button\" name=\"button\" value=\"Refresh\" onclick=\"window.location.href='$link_back'\"/>
			</form>
			<div class=\"clear\"></div>
			<br /><hr /><br />
			
			<a href=\"$link_back&act=input&tab=tambah\" class=\"alt_btn\">Tambah Data</a>
			<div class=\"clear\"></div><br />
			
			<table class=\"tablesorter\" cellspacing=\"0\"> 
				<thead> 
					<tr> 
	   					<th width='10'>No</th> 
	    				<th>Nama Level</th>
	    				<th>Status</th>
	    				<th width='150'>Aksi</th>
					</tr> 
				</thead> 
				<tbody>
					$td_table
				</tbody>
			</table>
			<div class=\"clear\"></div>
			$thal
			";
		break;
		
		case"input":
			if($tab=="edit"){
				$title_page.=" &raquo; Edit Data";
				
				$sqld="select * from $nama_table where id=\"$gid\" and hapus=\"0\"";
				$data=mysql_query($sqld);
				$ndata=mysql_num_rows($data);
				if($ndata>0){
					$fdata=mysql_fetch_assoc($data);
					extract($fdata);
					$hak_akses=",$hak_akses";
					$read=($id<=5)? "readonly=\"readonly\"" : "";
					
					$edit="<input type=\"hidden\" name=\"pid\" value=\"$id\" />";
					$edit.="<input type=\"hidden\" name=\"edit\" value=\"edit\" />";
				}
			}
			
			if($tab=="tambah"){
				$title_page.=" &raquo; Tambah Data";
				$ndata=1;
				$read="";
				$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
			}
			
			if($ndata>0){
				
				$list_menu="";
				$sqld2="select * from $nama_table2 where submenu=\"0\" and status=\"1\" and hapus=\"0\" ".
						"order by urutan asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					while($fdata2=mysql_fetch_assoc($data2)){
						$nama_menu2=$fdata2["nama_menu"];
						$idmenu2=$fdata2["id"];
						
						$cek2=(strstr($hak_akses, ",$idmenu2,"))? "checked=\"checked\"" : "";
						$req2=($idmenu2==1)? "required" : "";
						$input2="<input type=\"checkbox\" name=\"checkbox_$idmenu2\" value=\"1\" $cek2 $req2/>";
						
						$sqld3="select * from $nama_table2 where submenu=\"$idmenu2\" and status=\"1\" and ".
								"hapus=\"0\" order by urutan asc";
						$data3=mysql_query($sqld3);
						$ndata3=mysql_num_rows($data3);
						if($ndata3>0){
							$list_menu.="&bull; <b>$nama_menu2</b><br />";
							
							while($fdata3=mysql_fetch_assoc($data3)){
								$nama_menu3=$fdata3["nama_menu"];
								$idmenu3=$fdata3["id"];
								$cek3=(strstr($hak_akses, ",$idmenu3,"))? "checked=\"checked\"" : "";
								$input3="<input type=\"checkbox\" name=\"checkbox_$idmenu3\" value=\"1\" $cek3/>";
								$list_menu.="&nbsp;&nbsp;&nbsp; $input3 $nama_menu3<br />";
							}
						}else{
							$list_menu.="$input2 $nama_menu2<br />";
						}
						
						$list_menu.="<br />";
					}
				}
				
				$cnpage="<form name=\"form1\" action=\"$link_back&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Level</td>
							<td>:</td>
							<td>
								<input type=\"text\" name=\"nama_level\" value=\"$nama_level\" class=\"text\" $read required/>
							</td>
						</tr>
						<tr>
							<td valign='top'>Hak Akses Menu</td>
							<td valign='top'>:</td>
							<td>$list_menu</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td>".SelStatus($status, "status", "required")."</td>
						</tr>
					</table>
					</table><br />
					$edit
					<input type=\"submit\" name=\"proses\" value=\"Simpan\" />
					<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>
				</form>";
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4><br />
				<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\"/>";
			}
			
		break;
		
		case"proses":
			$title_page.=" &raquo; Proses Data";
			
			extract($_POST);
			$error="";
			
			if(empty($nama_level)){
				$error.="<h4 class=\"alert_warning\">Nama level masih kosong</h4>";
			}
			
			if(empty($checkbox_8)){
				$error.="<h4 class=\"alert_warning\">Menu dashboard belum dipilih</h4>";
			}
			
			if(empty($status)){
				$error.="<h4 class=\"alert_warning\">Status masih kosong</h4>";
			}
			
			if(empty($error)){
				$sqld2="select * from $nama_table2 where status=\"1\" and hapus=\"0\" order by id asc";
				$data2=mysql_query($sqld2);
				$ndata2=mysql_num_rows($data2);
				if($ndata2>0){
					while($fdata2=mysql_fetch_assoc($data2)){
						$idm=$fdata2["id"];
						
						if($_POST["checkbox_$idm"]==1){
							$list_menu.="$idm,";
						}
					}
					
					$subid=substr($list_menu,0,-1);
					$subid=($subid=="")? "0" : "$subid";
					$sqld3="select * from $nama_table2 where id in ($subid) and status=\"1\" and hapus=\"0\" ".
							"and submenu not in (0) group by submenu";
					$data3=mysql_query($sqld3);
					$ndata3=mysql_num_rows($data3);
					if($ndata3>0){
						while($fdata3=mysql_fetch_assoc($data3)){
							$idm3=$fdata3["submenu"];
							$list_menu.="$idm3,";
						}
					}else{
						$list_menu.="1,8";
					}
				}
				
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fnama_level=$fdata["nama_level"];
						$user_update="$ss_user,".$fdata["user_update"];
						
						if($nama_level==$fnama_level){
							$vdata="hak_akses=\"$list_menu\", status=\"$status\", tgl_update=\"$ndatetime\", ".
								"user_update=\"$user_update\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							$sqld="select * from $nama_table where nama_level=\"$nama_level\" and hapus=\"0\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="nama_level=\"$nama_level\", hak_akses=\"$list_menu\", status=\"$status\", ".
										"tgl_update=\"$ndatetime\", user_update=\"$user_update\"";
								$vvalue="id=\"$pid\"";
								
								$inp="update $nama_table set $vdata where $vvalue";
								$upd=mysql_query($inp);
								if($upd==1){
									$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
								}else{
									$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
								}
							}else{
								$cnpage="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
							}
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
					}
				}
				
				if($edit=="tambah"){
					$sqld="select * from $nama_table where nama_level=\"$nama_level\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="nama_level, hak_akses, status, hapus, tgl_insert, tgl_update, user_update";
						$vvalue="\"$nama_level\", \"$list_menu\", \"$status\", \"0\", \"$ndatetime\", ".
									"\"$ndatetime\", \"$ss_user\"";
						
						$inp="insert into $nama_table ($vdata) values ($vvalue)";
						$upd=mysql_query($inp);
						if($upd==1){
							$cnpage="<h4 class=\"alert_success\">Data Berhasil Ditambah</h4>";
						}else{
							$cnpage="<h4 class=\"alert_error\">Data Gagal Ditambah</h4>";
						}
					}else{
						$cnpage="<h4 class=\"alert_warning\">Data Sudah Ada</h4>";
					}
				}
				
			}else{
				$cnpage="$error";
			}
			
			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
		break;
		
		case"hapus":
			$title_page.=" &raquo; Hapus Data";
			
			$sqld="select * from $nama_table where id=\"$gid\" and hapus=\"0\"";
			$data=mysql_query($sqld);
			$ndata=mysql_num_rows($data);
			if($ndata>0){
				$vdata="hapus=\"1\", tgl_update=\"$ndatetime\"";
				$vvalue="id=\"$gid\"";
				
				$inp="update $nama_table set $vdata where $vvalue";
				$upd=mysql_query($inp);
				if($upd==1){
					$cnpage="<h4 class=\"alert_success\">Data Berhasil Dihapus</h4>";
				}else{
					$cnpage="<h4 class=\"alert_error\">Data Gagal Dihapus</h4>";
				}
			}else{
				$cnpage="<h4 class=\"alert_warning\">Data Tidak Ditemukan</h4>";
			}
			
			$cnpage.="<br />
			<input type=\"button\" name=\"button\" value=\"Kembali\" onclick=\"window.location.href='$link_back'\" />
			<meta http-equiv=\"refresh\" content=\"2;url=$link_back\">";
		break;
	}
	
}
?>
