<?php
session_start();
$ss_user=$_SESSION["ss_user"];
$ss_pwd=$_SESSION["ss_pwd"];
$ss_nama=$_SESSION["ss_nama"];
$ss_level=$_SESSION["ss_level"];
$ss_kode=$_SESSION["ss_kode"];

if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
$modul="../../..";

echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"$modul/style/layout.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"$modul/style/jquery-ui-1.10.3.custom.css\">

<script type=\"text/javascript\" src=\"$modul/jquery/jquery-1.9.1.js\"></script>
<script type=\"text/javascript\" src=\"$modul/jquery/jquery-ui-1.10.3.custom.js\"></script>
<script type=\"text/javascript\" src=\"$modul/jquery/combobox.js\"></script>

<script type=\"text/javascript\">
	$(document).ready(function(){
		$(\".combobox\").combobox();
	});
</script>";

include"$modul/setting/kon.php";
include"$modul/setting/function.php";
extract($_GET);


if($pilih=="prodi") {
	echo SelProdi($gid, "pkode", "required");
}

if($pilih=="lab") {
	echo SelLaboratorium($gid, "pkode", "required");
}

}
?>
