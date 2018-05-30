<?php
session_start();
include"setting/kon.php";

$username=$_POST["username"];
$password=$_POST["password"];

if($username==""){
	echo"<script language=\"JavaScript\">
		alert('Maaf Nama User Masih Kosong !');
		document.location='index.php';
	</script>";
	
}elseif($password==""){
	echo"<script language=\"JavaScript\">
		alert('Maaf Nama User dan Password Anda Salah !');
		document.location='index.php';
	</script>";
	
}else{
	include "setting/PostCek.php";
	$pwd=drudb($password);
	
	#cek login langsung data sendiri
	$sqld="select a.* from db_user as a left join db_user_level as b on a.level_user = b.id ".
			"where a.`user`=\"$username\" and a.paswd=$pwd and a.hapus=\"0\" ";
	$vcek=@mysql_query($sqld);
	$scek=@mysql_num_rows($vcek);
	if($scek>0){
		$fcek=@mysql_fetch_assoc($vcek);
		@extract($fcek);
		
		if($status!="1"){
			echo"<script language=\"JavaScript\">
				alert('Maaf, User Anda Masih Belum Aktif\\nHubungi Administrator!');
				document.location='index.php';
			</script>";
		}else{
			$_SESSION["ss_user"]="$user";
			$_SESSION["ss_pwd"]="$paswd";
			$_SESSION["ss_nama"]="$nama_user";
			$_SESSION["ss_level"]="$level_user";
			$_SESSION["ss_kode"]="$pkode";
			
			@header("Location:home.php?pages=home");
		}
	}else{
		
		#cek login mahasiswa
		$pswd=md5("$password");
		include"setting/kon_hotspot.php";
		$sqld="select * from radcheck where username=\"$username\" and `value`=\"$pswd\" ".
				"and attribute=\"MD5-Password\"";
		$data=@mysql($pot_db1, $sqld);
		$ndata=@mysql_num_rows($data);
		if($ndata>0){
			
			include"setting/kon_baa.php";
			$sqld2="select * from master_siswa where kode_siswa=\"$username\"";
			$data2=@mysql($neomaa, $sqld2);
			$ndata2=@mysql_num_rows($data2);
			if($ndata2>0){
				$fdata2=@mysql_fetch_assoc($data2);
				$nama_siswa=$fdata2["nama_siswa"];
				$ref_programstudi=$fdata2["ref_program_studi"];
				
				$_SESSION["ss_user"]="$username";
				$_SESSION["ss_pwd"]="$ref_programstudi";
				$_SESSION["ss_nama"]="$nama_siswa";
				$_SESSION["ss_level"]="2";
				
				@header("Location:home.php?pages=home");
			}else{
				echo"<script language=\"JavaScript\">
					alert('Data Tidak Ditemukan!');
					document.location='index.php';
				</script>";
			}
		}else{
			echo"<script language=\"JavaScript\">
				alert('Maaf, User Tidak Ditemukan!');
				document.location='index.php';
			</script>";
		}
	}
} 
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SIM - Badan Kendali Mutu Akademik | UMM</title>
</head><body>
</body></html>

