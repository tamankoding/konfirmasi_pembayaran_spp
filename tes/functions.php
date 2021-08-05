<?php 	 
	$koneksi = mysqli_connect("localhost", "root", "", "sekola43_spp");

	function query($query){
		global $koneksi;
		$result = mysqli_query($koneksi, $query);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function registrasi($data){
		global $koneksi;

		$nama = htmlspecialchars($data['nama']);
		$nis = htmlspecialchars($data['nis']);
		$username = strtolower(stripslashes($data['username']));
		$password = mysqli_real_escape_string($koneksi, $data['password']);
		$password2 = mysqli_real_escape_string($koneksi, $data['password2']);
		$email = htmlspecialchars($data['email']);
		$no_hp = htmlspecialchars($data['no_hp']);
		$kb = htmlspecialchars($data['kb']);
		$kelas = htmlspecialchars($data['kelas']);
		$sekolah = htmlspecialchars($data['sekolah']);

		//cek jika username sudah ada atau belum
		$result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			echo "
				<script>
					alert('username sudah terdaftar sebelumnya, silahkan ganti username lain');
				</script>
			";

			return false;
		}


		//cek konfirmasi password
		if ($password !== $password2) {
		 	echo "
		 		<script>
					alert('konfirmasi password tidak sesuai');
				</script>
		 	";

		 	return false;
		 }

		 //cek enkripsi password
		 $password = password_hash($password, PASSWORD_DEFAULT);

		//tambahkan user baru
		 mysqli_query($koneksi, "INSERT INTO users VALUES (DEFAULT, '$nama', '$nis', '$username', '$password', '$email', '$no_hp', $kb, $kelas, '$sekolah')"); 

		 return mysqli_affected_rows($koneksi);
	}

	function tambah($data){
		global $koneksi;
		$nama = $_SESSION['nama'];
		$nis = $_SESSION['nis'];
		$sholat = $data['sholat'];
		
		// UPLOAD GAMBAR
		$gambar = upload();
		if (!$gambar) {
			return false;
		}

		$query = "INSERT INTO absensi_baru
				  VALUES (DEFAULT, '$nama', '$nis', '$sholat', '$gambar', now())";
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
	}

	function tambah_saku($data){
		global $koneksi;
		$nama = $_SESSION['nama'];
		$nis = $_SESSION['nis'];
		$sholat = $data['sholat'];
		
		// UPLOAD GAMBAR
		$gambar = upload();
		if (!$gambar) {
			return false;
		}

		$query = "INSERT INTO absensi_baru
				  VALUES (DEFAULT, '$nama', '$nis', '$sholat', '$gambar', now())";
		mysqli_query($koneksi, $query);

		return mysqli_affected_rows($koneksi);
	}

	function upload(){
		$namaFile = $_FILES['gambar']['name']; 
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name']; 

		// cek apakah tidak ada gambar yang diupload
		if ($error === 4) {
			echo "
				<script>
					alert('gambar harus diupload');
					document.location.href = 'media.php?p=absen_sholat';
				</script>
			";

			return false;
		}

		//cek apakah file berupa gambar
		$ektensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ektensiGambar = explode('.', $namaFile);
		$ektensiGambar = strtolower(end($ektensiGambar));

		if (!in_array($ektensiGambar, $ektensiGambarValid)) {
			echo "
				<script>
					alert('yang kamu upload bukan gambar !!!');
					document.location.href = 'media.php?p=absen_sholat';
				</script>
			";

			return false;
		}

		if ($ukuranFile > 10000000) {
			echo "
				<script>
					alert('ukuran gambar terlalu besar, max 1mb !!!');
					document.location.href = 'media.php?p=absen_sholat';
				</script>
			";

			return false;
		}
	}

	function terima($id){
		global $koneksi;

		mysqli_query($koneksi, "UPDATE spp_santri SET status='diterima' WHERE id = $id");
		
		return mysqli_affected_rows($koneksi);
	}

	function tolak($id){
		global $koneksi;

		mysqli_query($koneksi, "UPDATE absensi_baru SET status='absen ditolak' WHERE id = $id");

		return mysqli_affected_rows($koneksi);
	}

?>	