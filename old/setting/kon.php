<?php
$db_server = "localhost";
$db_user = "bkma";
$db_pwd = "bkma";
$db_data = "db_bkma";

$Skon=@mysql_connect($db_server,$db_user,$db_pwd);
if(!$Skon){
	$Sserv=$_SERVER['SERVER_NAME'];
	$Suri=$_SERVER['REQUEST_URI'];
	echo'<meta http-equiv="refresh" content="0;url=http://'.$Sserv.$Suri.'">';
}else{
	mysql_select_db($db_data) or die("Not Connect DB");
}
?>
