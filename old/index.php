<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SIM - Badan Kendali Mutu Akademik | UMM</title>
<link rel="stylesheet" type="text/css" href="style/login-box.css">
<script type="text/javascript"> 
function validasi(form){
  if (form.username.value == ""){
	alert("Anda belum mengisikan Username.");
	form.username.focus();
	return (false);
  }
	 
  if (form.password.value == ""){
	alert("Anda belum mengisikan Password.");
	form.password.focus();
	return (false);
  }
  return (true);
}
</script>
</head>

<body>
<div id="login-box">
	<form action="cek.php" method="post" name="form" onsubmit="return validasi(this)">
		<h3 align="right">SIM - Badan Kendali Mutu Akademik</h3>
		<h3 align="right">Universitas Muhammadiyah Malang</h3>

		<div id="login-box-name" style="margin-top:20px;">Username :</div>
		<div id="login-box-field" style="margin-top:20px;">
			<input name="username" class="form-login" title="Username" size="30" required>
		</div>
		
		<div id="login-box-name">Password :</div>
		<div id="login-box-field">
			<input name="password" class="form-login" title="Password" size="30" type="password" required>
		</div>

		<input style="margin-left:90px;" type="submit" name="proses" value="Login" class="button">
	</form>
</div>
</body></html>
