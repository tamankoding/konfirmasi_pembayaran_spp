<?php
$koneksi = mysqli_connect("localhost", "root", "", "sekola43_spp");

function query($query)
{
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function terima($id)
{
	global $koneksi;

	mysqli_query($koneksi, "UPDATE spp_santri SET status='diterima' WHERE id = $id");

	return mysqli_affected_rows($koneksi);
}

function terima_du($id)
{
	global $koneksi;

	mysqli_query($koneksi, "UPDATE daftar_ulang SET status='diterima' WHERE id = $id");

	return mysqli_affected_rows($koneksi);
}
