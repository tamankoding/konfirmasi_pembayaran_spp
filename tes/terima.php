<?php 	
	include "functions.php";

	$id = $_GET['id'];
	
	if (terima($id) > 0) {
		echo "
			<script>
				document.location.href = 'user/media.php?p=data_sholat';
			</script>
		";
	} else {
		echo "
			<script>
				document.location.href = 'user/media.php?p=data_sholat';
			</script>
		";
	}

	
	

?>