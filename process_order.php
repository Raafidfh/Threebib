<?php
// koneksi ke database
require 'function.php';

// Ambil data dari form
$produk_id = $_POST['id'];
$table = $_POST['table'];
$nama_pemesan = $_POST['nama'];
$alamat = $_POST['alamat'];
$metode_pembayaran = $_POST['metode_pembayaran'];

// Ambil informasi produk berdasarkan ID
$product = query("SELECT * FROM $table WHERE id = '$produk_id'");
if (empty($product)) {
    die("Produk tidak ditemukan.");
}

$produk = $product[0]; // Ambil produk pertama

// Persiapkan data untuk dimasukkan ke dalam tabel transaksi
$nama_barang = $produk['nama'];
$harga_barang = $produk['harga'];

// Generate nomor VA (Virtual Account) secara acak
$no_va = "085156279510";

// Query untuk memasukkan data ke tabel transaksi
$sql = "INSERT INTO transaksi (nama, harga, pemesan, alamat) VALUES ('$nama_barang', '$harga_barang', '$nama_pemesan', '$alamat')";
$result = mysqli_query($conn, $sql); // Pastikan $conn didefinisikan dalam function.php

// Tampilkan detail pemesanan dalam format HTML
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bayar.css" />
    <title>Detail Pemesanan</title>
    <script>
    function showConfirmation() {
        const confirmationPopup = document.getElementById('confirmation-popup');
        confirmationPopup.style.display = 'block';
    }

    function redirectToIndex() {
        window.location.href = 'index.php';
    }
    </script>
    <style>
    /* Gaya untuk popup konfirmasi */
    #confirmation-popup {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Pemesanan</h1>
        <?php if ($result): ?>
        <p><strong>Nama Barang:</strong> <?= htmlspecialchars($nama_barang); ?></p>
        <p><strong>Harga Barang:</strong> Rp <?= number_format($harga_barang, 0, ',', '.'); ?></p>
        <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($nama_pemesan); ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($alamat); ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($metode_pembayaran); ?></p>
        <p><strong>Nomor VA dana:</strong> <?= $no_va; ?></p>
        <button onclick="showConfirmation()">Konfirmasi</button>
        <?php else: ?>
        <p>Error: <?= mysqli_error($conn); ?></p>
        <?php endif; ?>
    </div>

    <!-- Popup Konfirmasi -->
    <div id="confirmation-popup">
        <div class="popup-content">
            <h2>Terimakasih Atas Pemesanannya</h2>
            <h2>Pesanan Anda akan kami proses!</h2>
            <button onclick="redirectToIndex()">OK</button>
        </div>
    </div>
</body>

</html>