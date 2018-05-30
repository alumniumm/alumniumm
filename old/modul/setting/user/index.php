<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	
	$link_back="?pages=$pages";
	$nama_table="db_user";
	
	$title_page="Data User";
	
	switch($act){
		default:
			$link_page="$link_back&gname=$gname&gp=$gp";
			$posisi=cariPosisi($batas, $hal);
			
			$wgp=($gp!="")? "and level_user=\"$gp\"" : "";
			
			$sqld="SELECT * FROM $nama_table where user like \"%$gname%\" and hapus=\"0\" $wgp order by user asc";
			$data=mysql_query($sqld." limit $posisi,$batas");
			$ndata=mysql_num_rows($data);
			if($ndata>0){ $no=$posisi+1;
				while($fdata=mysql_fetch_assoc($data)){
					extract($fdata);
					$nama_status=($status==1)? "Aktif" : "Tidak Aktif";
					$nama_level=SelLevel($level_user, "", "1");
					
					if($level_user==3){
						$spek=NamaProdi($pkode);
						$nama_prodi=$spek["nama_depart"];
						$nama_level="$nama_level ($nama_prodi)";
					}elseif($level_user==4){
						$spek=SelLaboratorium($pkode, "pkode", "", "1");
						$nama_level="$nama_level ($spek)";
					}else{
						$nama_level="$nama_level";
					}
					
					$edit="<a href=\"$link_back&act=input&tab=edit&gid=$id\" class=\"blink\">Edit</a>";
					$hapus="<a href=\"$link_back&act=hapus&gid=$id\" class=\"blink\" onclick=\"return confirm('Apakah Anda Yakin Manghapus Data ini?')\">Hapus</a>";
					
					$td_table.="<tr>
						<td>$no</td>
						<td>$user</td>
						<td>$nama_user</td>
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
						<td>Username</td>
						<td>:</td>
						<td><input type=\"text\" name=\"gname\" value=\"$gname\" size=\"50\" /></td>
					</tr>
					<tr>
						<td>Level User</td>
						<td>:</td>
						<td>".SelLevel($gp, "gp")."</td>
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
	    				<th>Username</th> 
	    				<th>Nama User</th> 
	    				<th>Level User</th> 
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
					
					$edit="<input type=\"hidden\" name=\"pid\" value=\"$id\" />";
					$edit.="<input type=\"hidden\" name=\"edit\" value=\"edit\" />";
				}
			}
			
			if($tab=="tambah"){
				$title_page.=" &raquo; Tambah Data";
				$ndata=1;
				
				$edit="<input type=\"hidden\" name=\"edit\" value=\"tambah\" />";
			}
			
			if($ndata>0){
				
				if($ss_level==1){
					$istatus="<tr>
						<td>Status</td>
						<td>:</td>
						<td>".SelStatus($status, "status", "required")."</td>
					</tr>";
					
					$ilevel="<tr>
						<td>Level User</td>
						<td>:</td>
						<td>
							".SelLevel($level_user, "level_user", "", "required")." 
							<span class=\"subsel\"></span>
						</td>
					</tr>";
				}
				
				include"js_user.php";
				$cnpage.="<form name=\"form1\" action=\"$link_back&act=proses\" method=\"post\">
					<table class='pad5'>
						<tr>
							<td>Nama User</td>
							<td>:</td>
							<td><input type=\"text\" name=\"nama_user\" value=\"$nama_user\" size=\"50\" required/></td>
						</tr>
						<tr>
							<td>Username</td>
							<td>:</td>
							<td><input type=\"text\" name=\"user\" value=\"$user\" required/></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td><input type=\"password\" name=\"password1\" value=\"$paswd\" required/></td>
						</tr>
						<tr>
							<td>Ulangi Password</td>
							<td>:</td>
							<td><input type=\"password\" name=\"password2\" value=\"$paswd\" required/></td>
						</tr>
						$ilevel
						$istatus
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
			
			if(empty($nama_user)){
				$error.="<h4 class=\"alert_warning\">Nama user masih kosong</h4>";
			}
			
			if(empty($user)){
				$error.="<h4 class=\"alert_warning\">Username masih kosong</h4>";
			}
			
			if(empty($password1)){
				$error.="<h4 class=\"alert_warning\">Password masih kosong</h4>";
			}
			
			if($password1!=$password2){
				$error.="<h4 class=\"alert_warning\">Password tidak sama</h4>";
			}
			
			if(empty($error)){
				if($edit=="edit"){
					$sqld="select * from $nama_table where id=\"$pid\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata>0){
						$fdata=mysql_fetch_assoc($data);
						$fuser=$fdata["user"];
						$fpassword=$fdata["paswd"];
						
						$ppwd=($fpassword!="$password1")? "paswd=password(\"$password1\")," : "";
						if($ss_level==1){
							$plevel="level_user=\"$level_user\", pkode=\"$pkode\", status=\"$status\",";
						}
						
						if($user==$fuser){
							$vdata="$ppwd $plevel nama_user=\"$nama_user\", tgl_update=\"$ndatetime\"";
							$vvalue="id=\"$pid\"";
							
							$inp="update $nama_table set $vdata where $vvalue";
							$upd=mysql_query($inp);
							if($upd==1){
								$cnpage="<h4 class=\"alert_success\">Data Berhasil Dirubah</h4>";
							}else{
								$cnpage="<h4 class=\"alert_error\">Data Gagal Dirubah</h4>";
							}
						}else{
							$sqld="select * from $nama_table where user=\"$user\"";
							$data=mysql_query($sqld);
							$ndata=mysql_num_rows($data);
							if($ndata==0){
								$vdata="$ppwd $plevel user=\"$user\", nama_user=\"$nama_user\", ".
										"tgl_update=\"$ndatetime\"";
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
					$sqld="select * from $nama_table where user=\"$user\" and hapus=\"0\"";
					$data=mysql_query($sqld);
					$ndata=mysql_num_rows($data);
					if($ndata==0){
						$vdata="user, paswd, nama_user, level_user, pkode, status, tgl_insert, tgl_update, hapus";
						$vvalue="\"$user\", password(\"$password1\"), \"$nama_user\", \"$level_user\", \"$pkode\", ";
						$vvalue.="\"$status\", \"$ndatetime\", \"$ndatetime\", \"0\"";
						
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
