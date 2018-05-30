<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{
	$title_page="Dashboard";
	
	/*
	3. Mencetak hasil evaluasi pembelajaran dosen (format MS Excel)<br /> 
	4. Mencetak polling yang dilakukan oleh responden pada seorang dosen (format MS Excel)<br /> 
	*/
	
	switch($act){
		default:
			$cnpage="<h3>Selamat datang di Halaman Admin Aplikasi Simutu BKMA<br /> 
			Evaluasi Pembelajaran Dosen Universitas Muhammadiyah Malang.<h3>
			<h4>
			Di halaman Admin ini, Anda dapat :<br /> 
			1. Melihat grafik jumlah responden seluruh jurusan<br /> 
			2. Melihat grafik evaluasi pembelajaran dosen<br /> 
			3. Melihat data dosen yang belum dievaluasi<br><br /> 
			
			Selain itu anda juga dapat melakukan manajemen terhadap :<br /> 
			1. Data Fakultas<br />
			2. Data Jurusan<br />
			3. Data Dosen<br />
			4. Data Pertanyaan<br />
			</h4>";
		break;
	}
	
}
?>