<?php
#$pot_host="10.14.14.253";
$pot_host="10.10.1.81";
$pot_user="radius";
$pot_pass="radiususer";

$pot_db1="radius";

$pot_result=@mysql_connect("$pot_host", "$pot_user", "$pot_pass");
if($pot_result=0){
	echo"database disconnected";
	exit;
}
?>
