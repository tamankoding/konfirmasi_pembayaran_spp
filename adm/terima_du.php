<?php
include "functions.php";

$id = $_GET['id'];

if (terima_du($id) > 0) {
    echo "
			<script>
				document.location.href = 'media.php?p=dubelum';
			</script>
		";
} else {
    echo "
			<script>
				document.location.href = 'media.php?p=dubelum';
			</script>
		";
}
