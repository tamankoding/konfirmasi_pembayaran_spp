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

?>

<?php
include "../tes/koneksi.php";
$namasantri = $_SESSION['nama'];
$id = $_SESSION['id'];

$data_spp_konfirmasi = mysqli_query($mysqli, "SELECT DISTINCT * FROM spp_santri WHERE status='diterima'");
$data_spp_belumkonfirmasi = mysqli_query($mysqli, "SELECT * FROM spp_santri WHERE status='menunggu'");

$data_daftarulang = mysqli_query($mysqli, "SELECT DISTINCT * FROM daftar_ulang WHERE status='diterima'");
$data_daftarulang_belum = mysqli_query($mysqli, "SELECT DISTINCT * FROM daftar_ulang WHERE status='menunggu'");

// SPP
$konfirmasi = mysqli_num_rows($data_spp_konfirmasi);
$belumkonfirmasi = mysqli_num_rows($data_spp_belumkonfirmasi);

// DAFTAR ULANG
$daftarulang_konfirmasi = mysqli_num_rows($data_daftarulang);
$daftarulang_bk = mysqli_num_rows($data_daftarulang_belum);

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
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="text-center">Data SPP</h4>
                <hr>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $konfirmasi; ?></h3>

                    <p>Data Konfirmasi</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="media.php?p=spp_konfirmasi" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $belumkonfirmasi; ?></h3>

                    <p>Data Belum Konfirmasi</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="media.php?p=belum_konfirmasi" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="text-center">Data Daftar Ulang</h4>
                <hr>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $daftarulang_konfirmasi; ?></h3>

                    <p>Data Masuk</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="media.php?p=dumasuk" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-sm-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= $daftarulang_bk ?></h3>

                    <p>Data Belum Konfirmasi</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="media.php?p=dubelum" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->