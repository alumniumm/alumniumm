<?php
session_start();
$ss_user=$_SESSION["ss_user"];
$ss_pwd=$_SESSION["ss_pwd"];
$ss_nama=$_SESSION["ss_nama"];
$ss_level=$_SESSION["ss_level"];
$ss_kode=$_SESSION["ss_kode"];
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SIM - Badan Kendali Mutu Akademik | UMM</title>

<?php
if(empty($ss_user) or empty($ss_pwd)){
	echo"<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	include"setting/kon.php";
	include"setting/function.php";
	include"setting/function_table.php";
	include"setting/variable.php";
	@include"$incmodul";
?>

<link rel="stylesheet" type="text/css" href="style/layout.css">
<link rel="stylesheet" type="text/css" href="style/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="style/print.css">

<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="jquery/jquery.equalHeight.js"></script>
<script type="text/javascript" src="jquery/combobox.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.column').equalHeight();
		
		$('.tanggal').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:'yy-mm-dd'
		});
		
		$(".combobox").combobox();
	});
</script>

</head>
<body>
	<header id="header">
		<hgroup>
			<h1>SIM - Badan Kendali Mutu Akademik</h1>
			<h2>Universitas Muhammadiyah Malang</h2>
		</hgroup>
	</header>
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo"$ss_nama"; ?> | <a href="logout.php" title="Logout">Logout</a></p>
		</div>
	</section>
	
	<aside id="sidebar" class="column">
		
		<?php echo"$imenu"; ?>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 <br />SIM - Badan Kendali Mutu Akademik</strong></p>
			<p>Developed by Infokom UMM</p>
			<!--<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>-->
		</footer>
	</aside>
	
	<section id="main" class="column">
		<article class="module width_full">
			<header><h3><?php echo"$title_page"; ?></h3></header>
			<div class="module_content"><?php echo"$cnpage"; ?></div>
		</article>
		
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
	
</body>
</html>

<?php
}
?>

