<?php
include "../tes/koneksi.php";
$namasantri = $_SESSION['nama'];

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
<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Menunggu Konfirmasi SPP</h3>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="overflow: auto;">
                  <div class="table-responsive">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Cari Data">
                    <br>

                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="20%">Nama </th>
                          <th width="15%">Tanggal Transfer</th>
                          <th width="15%">Nominal</th>
                          <th width="25%">Keterangan</th>
                          <th width="15%">Aksi</th>
                          <th width="5%">Bukti</th>
                        </tr>
                      </thead>
                      <tbody id="pegawai">
                        <?php
                        $no = 1;
                        $data = mysqli_query($mysqli, "SELECT * FROM spp_santri WHERE status='menunggu' ORDER BY id DESC");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d["nama"]; ?></td>
                            <td><?php echo date('d F Y', strtotime($d['tanggal_tf'])); ?></td>
                            <td><?php echo number_format($d["nominal"]); ?></td>
                            <td><?php echo $d["keterangan"]; ?></td>
                            <td>
                              <a href="terima.php?id=<?= $d['id']; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                              <a href="hapus_data_spp_menunggu.php?id=<?= $d['id']; ?>" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus data ?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td><input type="button" name="view" value="cek" id="<?php echo $d["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


            </div>
            <!-- /.col -->
          </div>
        </div>
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

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
        url: "view_data_spp.php",
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

<script>
  $('#myButton').on('click', function() {
    var $btn = $(this).button('loading')
    // business logic...
    $btn.button('loading')
  })
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#search').keyup(function() {
      search_table($(this).val());
    });

    function search_table(value) {
      $('#pegawai tr').each(function() {
        var found = 'false';
        $(this).each(function() {
          if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
            found = 'true';
          }
        });

        if (found == 'true') {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
  });
</script>