<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php
  if ($_GET['p'] == 'verifikasi') {
    include 'verifikasi.php';
  } elseif ($_GET['p'] == 'home') {
    include 'home.php';
  } elseif ($_GET['p'] == 'pembayaranspp') {
    include 'keuangan/spp_pembayaran.php';
  } elseif ($_GET['p'] == 'daftarulang') {
    include 'keuangan/bayar_du.php';
  } elseif ($_GET['p'] == 'uangsaku') {
    include 'keuangan/uangsaku.php';
  } else {
    include 'home.php';
  }

  ?>
</div>