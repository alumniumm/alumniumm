<?php
if(empty($ss_user) or empty($ss_pwd)){
	$cnpage="<script language=\"JavaScript\">
		alert('Silahkan Login Kembali !');
		document.location='index.php';
	</script>";
}else{

$cnpage="<script>
	$(function(){
		$('.level').change(function(){
			var sel=$(this).val();
			$('.subsel').empty();
			
			if(sel==3){
				var lload=\"modul/setting/user/load_data.php?pilih=prodi\";
				$('.subsel').load(lload);
			}
			
			if(sel==4){
				var lload=\"modul/setting/user/load_data.php?pilih=lab\";
				$('.subsel').load(lload);
			}
		}).each(function(){
			var sel=$(this).val();
			var varcom='$pkode';
			
			if(sel==3){
				var lload=\"modul/setting/user/load_data.php?pilih=prodi&gid=\"+varcom;
				$('.subsel').load(lload);
			}
			
			if(sel==4){
				var lload=\"modul/setting/user/load_data.php?pilih=lab&gid=\"+varcom;
				$('.subsel').load(lload);
			}
		});
	});
</script>";
}

?>
