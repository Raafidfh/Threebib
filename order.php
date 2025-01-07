<?php
// koneksi ke database
require 'function.php';

// Ambil ID produk dan tabel dari query string
$id = isset($_GET['id']) ? $_GET['id'] : null;
$table = isset($_GET['table']) ? $_GET['table'] : 'tshirt';

if ($id) {
    // Ambil data produk berdasarkan ID dan tabel
    $data = query("SELECT * FROM $table WHERE id = '$id'");
    if (empty($data)) {
        die("Produk tidak ditemukan.");
    }
    $produk = $data[0]; // Ambil produk pertama
} else {
    die("ID produk tidak valid.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/order.css" />
    <title>Order - <?= htmlspecialchars($produk['nama']); ?></title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="index.php">ThreeBib</a>
                </div>
                <div class="nav-buttons">
                    <a href="produk.php?table=<?= htmlspecialchars($table); ?>" class="back">Kembali</a>
                    <a href="logout.php" class="logout">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Detail Produk</h1>
            <div class="produk-detail-container">
                <div class="produk-detail">
                    <img src="img/<?= htmlspecialchars($produk['gambar']); ?>"
                        alt="<?= htmlspecialchars($produk['nama']); ?>">
                </div>
                <div class="produk-info">
                    <h2><?= htmlspecialchars($produk['nama']); ?></h2>
                    <p>Jenis: <?= htmlspecialchars($produk['jenis']); ?></p>
                    <p>Harga: Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                    <p>Detail: <?= htmlspecialchars($produk['detail']); ?></p>
                </div>
            </div>

            <h2>Form Pemesanan</h2>
            <form action="process_order.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($produk['id']); ?>">
                <input type="hidden" name="table" value="<?= htmlspecialchars($table); ?>">
                <div>
                    <label for="nama">Nama Pembeli:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div>
                    <label for="alamat">Alamat:</label>
                    <textarea id="alamat" name="alamat" required></textarea>
                </div>
                <div>
                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="BCA">Bank BCA</option>
                        <option value="Mandiri">Bank Mandiri</option>
                        <option value="BNI">Bank BNI</option>
                        <option value="BRI">Bank BRI</option>
                        <option value="Permata">Bank Permata</option>
                        <option value="CIMB">CIMB Niaga</option>
                    </select>
                </div>
                <button type="submit">Bayar</button>
            </form>
        </div>
    </main>


    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php"><strong>ThreeBib</strong></a>
                </div>
                <div class="footer-info">
                    <p>&copy; 2024 ThreeBib. All rights reserved.</p>
                    <p>Designed by Kelompok3</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>