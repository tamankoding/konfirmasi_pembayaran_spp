<?php
// include database connection file
include_once("../tes/koneksi.php");

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($mysqli, "SELECT * FROM spp_santri WHERE id=$id");

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_array($result);
    //delete file
    $path = '../tes/img/' . $data['image'];
    @unlink($path);
    //delete from database
    mysqli_query($mysqli, "DELETE FROM spp_santri where id='$id'");
}
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:media.php?p=belum_konfirmasi");
