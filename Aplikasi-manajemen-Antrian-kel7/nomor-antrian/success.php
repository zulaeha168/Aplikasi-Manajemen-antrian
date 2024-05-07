<?php
// Panggil file koneksi ke database
require_once "../config/database.php";

// Query untuk mengambil data terbaru dari tabel antrian
$query = "SELECT no_antrian, loket, pelayanan FROM tbl_antrian ORDER BY id DESC LIMIT 1";
$result = mysqli_query($mysqli, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Periksa apakah ada data yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil baris data terbaru
        $row = mysqli_fetch_assoc($result);
        // Ambil nilai nomor antrian, loket, dan pelayanan
        $nomorAntrian = $row['no_antrian'];
        $loket = $row['loket'];
        $pelayanan = $row['pelayanan'];
    } else {
        // Jika tidak ada data yang ditemukan, berikan nilai default
        $nomorAntrian = "Tidak Ada";
        $loket = "Tidak Ada";
        $pelayanan = "Tidak Ada";
    }
} else {
    // Jika terjadi kesalahan saat menjalankan query, berikan pesan kesalahan
    $nomorAntrian = "Error";
    $loket = "Error";
    $pelayanan = "Error";
}

// Tutup koneksi database
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SUCCESS</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
<style>
  /* Custom CSS */
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    padding-top: 50px;
  }
  .container {
    max-width: 600px;
    margin: 0 auto;
  }
  .card {
    margin-bottom: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .card-body {
    padding: 30px;
  }
  .card-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
  }
  .card-text {
    font-size: 18px;
    color: #666;
    margin-bottom: 10px;
  }
  #nomor_antrian {
    font-size: 36px;
    font-weight: bold;
    color: #007bff;
  }
  #info_loket,
  #info_pelayanan {
    font-size: 24px;
    font-weight: bold;
    color: #28a745;
  }
  .btn-print {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .btn-print:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Nomor Antrian</h5>
      <p class="card-text">Nomor Antrian Anda adalah: <span id="nomor_antrian"><?php echo $nomorAntrian; ?></span></p>
      <p class="card-text">Loket: <span id="info_loket"><?php echo $loket; ?></span></p>
      <p class="card-text">Pelayanan: <span id="info_pelayanan"><?php echo $pelayanan; ?></span></p>
      <button class="btn-print" onclick="window.print()">Cetak</button>
    </div>
  </div>
</div>
</body>
</html>
