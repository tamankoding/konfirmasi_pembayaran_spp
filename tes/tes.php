<!DOCTYPE html>
<html>

<head>
    <title>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP - WWW.MALASNGODING.COM</title>
</head>

<body>

    <center>

        <h2>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP<br /><a href="https://www.malasngoding.com">WWW.MALASNGODING.COM</a></h2>


        <?php
        include 'koneksi.php';
        ?>

        <br /><br /><br />

        <form method="get">
            <label>PILIH TANGGAL</label>
            <input type="date" name="tanggal">
            <input type="submit" value="FILTER">
        </form>

        <br /> <br />

        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Tanggal</th>
            </tr>
            <?php
            $no = 1;

            if (isset($_GET['tanggal'])) {
                $tgl = $_GET['tanggal'];
                $sql = mysqli_query($mysqli, "SELECT * FROM spp_santri where tanggal_tf='$tgl'");
            } else {
                $sql = mysqli_query($mysqli, "SELECT * FROM spp_santri");
            }

            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['sekolah']; ?></td>
                    <td><?php echo $data['tanggal_tf']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

    </center>
</body>

</html>