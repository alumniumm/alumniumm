<?php
$ndate=date("Y-m-d"); $ntime=date("H:i:s"); $ndatetime="$ndate $ntime";
$folder="modul";
$batas=20;

$pages=$_GET["pages"]; $act=$_GET["act"]; $tab=$_GET["tab"]; $kat=$_GET["kat"];
$gname=$_GET["gname"]; $gbase=$_GET["gbase"]; $gp=$_GET["gp"]; $gdid=$_GET["gdid"];
$hal=$_GET["hal"]; $gid=$_GET["gid"]; $gtanggal=$_GET["gtanggal"];
$gtahun=$_GET["gtahun"]; $gcetak=$_GET["gcetak"];

$hal=($hal<=0)? "1" : "$hal";

$menu=Menu($ss_level, $pages, $vmode);
$imenu=$menu["menu"];
$incmodul=$menu["modul"];

if($incmodul==""){
	if($r==""){
		echo"<meta http-equiv=\"refresh\" content=\"0;url=?pages=home\" />";
	}
}else{
	$incmodul="$folder/$incmodul";
}
?>
