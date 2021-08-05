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
require "functions.php";
$namasantri = $_SESSION['nama'];
$sekolah = $_SESSION['sekolah'];
$kelas = $_SESSION['kelas'];

$santri = query("SELECT * FROM spp_santri WHERE nama='$namasantri' ORDER BY id DESC");

?>


<!-- Content Header (Page header) -->
<div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Button trigger modal -->


        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                        <div class="col-sm-12">
                            <h2 class="text-center">PEMBAYARAN SPP <br><?= strtoupper($_SESSION['nama']);  ?></h2>
                        </div>

                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fa fa-plus"></i> Bayar SPP Disini
                            </button>
                        </div>
                        <div class="table-responsive">


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal Transfer</th>
                                        <th width="20%">Nominal</th>
                                        <th width="35%">Keterangan</th>
                                        <th width="10%">Status</th>
                                        <th width="5%">Bukti</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="pegawai">
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM spp_santri WHERE nama='$namasantri' ORDER BY id DESC");
                                    while ($d = mysqli_fetch_array($data)) {
                                        if (($d['status']) == 'diterima') {
                                            $bgcolor = "lightgreen";
                                            $color = "#002bad";
                                        } else {
                                            $color = "black";
                                            $bgcolor = "yellow";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo date('d F Y', strtotime($d['tanggal_tf'])); ?></td>
                                            <td><?php echo number_format($d["nominal"]); ?></td>
                                            <td><?php echo $d["keterangan"]; ?></td>
                                            <td><b style="padding: 3px 10px; color: <?= $color; ?>; border-radius: 50px; background: <?= $bgcolor; ?>"><?php echo $d["status"]; ?></b></td>
                                            <td><input type="button" name="view" value="cek" id="<?php echo $d["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                                            <td>
                                                <?php
                                                if (($d['status']) == 'menunggu') {
                                                ?> <a href="keuangan/hapus_data_spp_menunggu.php?id=<?= $d['id']; ?>" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus data ?');"><i class="fas fa-trash-alt"></i></a> <?php
                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                            echo '<p class="text-center">-</p>';
                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                            ?>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="dataModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Bukti Pembayaran</h4>
                                        </div>
                                        <div class="modal-body" id="employee_detail">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
        </div>




        <div class="row">
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gray-dark">
                            <h3 class="modal-title" id="exampleModalLongTitle">Formulir Bayar SPP</h3>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form method="post" id="myform" autocomplete="off">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4>Nominal SPP</h4>
                                                <input type="number" class="form-control" name="nominal" id="nominal" placeholder="nominal bayar" required />
                                                <small class="text-primary">contoh pengisian : 1200000 </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4>Keterangan Pembayaran</h4>
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan pembayaran untuk bulan" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4>Tanggal Transfer</h4>
                                                <input placeholder="Tanggal Transfer" class="form-control" type="text" name="tanggal_tf" onfocus="(this.type='date')" onblur="(this.type='text')" id="tanggal_tf" required />
                                            </div>
                                        </div>
                                    </div>



                                    <?php
                                    $conn = new mysqli('localhost', 'root', '', 'sekola43_spp');

                                    if (count($_POST) && (strpos($_POST['img'], 'data:image') === 0)) {
                                        $img = $_POST['img'];
                                        $nominal = $_POST['nominal'];
                                        $keterangan = $_POST['keterangan'];
                                        $tf = $_POST['tanggal_tf'];

                                        if (strpos($img, 'data:image/jpeg;base64,') === 0) {
                                            $img = str_replace('data:image/jpeg;base64,', '', $img);
                                            $ext = '.jpg';
                                        }

                                        if (strpos($img, 'data:image/png;base64,') === 0) {
                                            $img = str_replace('data:image/png;base64,', '', $img);
                                            $ext = '.png';
                                        }

                                        $img = str_replace(' ', '+', $img);
                                        $data = base64_decode($img);
                                        $file = 'img/spp-' . $namasantri . '-' . date("d-m-Y-His") . $ext;
                                        $name = 'spp-' . $namasantri . '-' . date("d-m-Y-His") . $ext;

                                        if (file_put_contents($file, $data)) {
                                            $sql = "INSERT INTO spp_santri VALUES (DEFAULT, '$namasantri', '$sekolah', '$kelas', now(), '$tf', '$nominal', '$name', '$keterangan', 'menunggu')";
                                            $query = $conn->query($sql) or die(mysqli_error($conn));
                                            if ($query) {
                                                echo "<script>
                                                swal({
                                                    title: 'Sukses!',
                                                    text: 'Data berhasil disimpan',
                                                    icon: 'success',
                                                    button: 'Ok'
                                                }).then(function() {
                                                    window.location = 'media.php?p=pembayaranspp';
                                                });
                                                </script>";

                                                // echo "
                                                //     <script>
                                                //         alert('Berhasil menambahkan data');
                                                //         document.location.href = 'media.php?p=pembayaranspp';
                                                //     </script>
                                                // ";
                                            } else {
                                                echo "gagal";
                                            }
                                        } else {
                                            echo "file tidak tersimpan";
                                        }
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Bukti Pembayaran</h4>
                                            <input type="file" name="" id="inp_file" accept="image/*" required />
                                            <input type="hidden" name="img" id="inp_img" value="">
                                            <br>
                                            <small style="font-style: italic;">Pastikan ukuran foto yang diupload tidak terlalu besar, agar diproses dengan cepat. </small>
                                        </div>
                                        <div class="col-sm-12">
                                            <input style="width: 100%;" type="submit" class="btn btn-primary btn-md" value="Konfirmasi Bayar" id="bt_save">
                                        </div>
                                    </div>



                                    <script>
                                        function fileChange(e) {
                                            document.getElementById('inp_img').value = '';

                                            var file = e.target.files[0];

                                            if (file.type == "image/jpeg" || file.type == "image/png") {
                                                var reader = new FileReader();
                                                reader.onload = function(readerEvent) {
                                                    var image = new Image()
                                                    image.onload = function(imageEvent) {
                                                        var max_size = 600;
                                                        var w = image.width;
                                                        var h = image.height;

                                                        if (w > h) {
                                                            if (w > max_size) {
                                                                h *= max_size / w;
                                                                w = max_size;
                                                            }
                                                        } else {
                                                            if (h > max_size) {
                                                                w *= max_size / h;
                                                                h = max_size
                                                            }
                                                        }

                                                        var canvas = document.createElement('canvas');
                                                        canvas.width = w;
                                                        canvas.height = h;
                                                        canvas.getContext('2d').drawImage(image, 0, 0, w, h);

                                                        if (file.type == "image/jpeg") {
                                                            var dataURL = canvas.toDataURL("image/jpeg", 1.0);
                                                        } else {
                                                            var dataURL = canvas.toDataURL("image/png");
                                                        }

                                                        document.getElementById('inp_img').value = dataURL;
                                                    }
                                                    image.src = readerEvent.target.result;
                                                }
                                                reader.readAsDataURL(file);
                                            } else {
                                                document.getElementById('inp_file').value = '';
                                                alert('Please only select images');
                                            }
                                        }

                                        document.getElementById('inp_file').addEventListener('change', fileChange, false);
                                    </script>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bukti Pembayaran</h4>
            </div>
            <div class="modal-body" id="employee_detail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<script>
    $(document).ready(function() {
        $('.view_data').click(function() {
            var id = $(this).attr("id");
            $.ajax({
                url: "keuangan/view_bukti_spp.php",
                method: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#employee_detail').html(data);
                    $('#dataModal').modal("show");
                }
            });
        });
    });
</script>