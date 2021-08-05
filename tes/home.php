<?php
if (!isset($_SESSION['login'])) {
  echo "
        <script>
          alert('harus login terlebih dahulu');
          document.location.href = 'index.php';
        </script>
      ";
  exit;
}

include "../tes/koneksi.php";
$namasantri = $_SESSION['nama'];

//cek jumlah spp berdasarkan nama
$data_spp_konfirmasi = mysqli_query($mysqli, "SELECT * FROM spp_santri WHERE nama='$namasantri'");
$konfirmasi = mysqli_num_rows($data_spp_konfirmasi);

//cek jumlah du berdasarkan nama
$data_daftarulang = mysqli_query($mysqli, "SELECT * FROM daftar_ulang WHERE nama='$namasantri'");
$daftarulang_konfirmasi = mysqli_num_rows($data_daftarulang);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-sm-12">
        <h3 style="text-align: center;">SELAMAT DATANG <br><?= strtoupper($_SESSION['nama']);  ?> </h3>
        <h5 class="text-center">Silahkan pilih menu dibawah ini </h5>
        <br>
      </div>
    </div>
    <div class="row">

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $konfirmasi; ?></h3>

            <p>Pembayaran SPP</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="media.php?p=pembayaranspp" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $daftarulang_konfirmasi; ?></h3>

            <p>Pembayaran Daftar Ulang</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="media.php?p=daftarulang" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Rp. 0</h3>

            <p>Saldo Uang Saku</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="media.php?p=uangsaku" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->