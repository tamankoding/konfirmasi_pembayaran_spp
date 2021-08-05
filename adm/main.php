<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php
  if ($_GET['p'] == 'verifikasi') {
    include 'verifikasi.php';
  } elseif ($_GET['p'] == 'home') {
    include 'home.php';
  } elseif ($_GET['p'] == 'spp_konfirmasi') {
    include 'konfirmasi_spp.php';
  } elseif ($_GET['p'] == 'belum_konfirmasi') {
    include 'sppbelum_konfirmasi.php';
  } elseif ($_GET['p'] == 'dumasuk') {
    include 'du_masuk.php';
  } elseif ($_GET['p'] == 'dubelum') {
    include 'du_belum.php';
  } else {
    include 'home.php';
  }

  ?>
</div>