<?php
include "functions.php";

$id = $_GET['id'];

if (terima($id) > 0) {
    echo "
			<script>
				document.location.href = 'media.php?p=belum_konfirmasi';
			</script>
		";
} else {
    echo "
			<script>
				document.location.href = 'media.php?p=belum_konfirmasi';
			</script>
		";
}
