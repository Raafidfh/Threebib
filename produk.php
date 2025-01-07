<?php
// koneksi ke database
require 'function.php';

// Mendapatkan nama tabel dari query string
$table = isset($_GET['table']) ? $_GET['table'] : 'barang';

// Mengambil data dari tabel yang dipilih
$data = query("SELECT * FROM $table");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9460afeec.js" crossorigin="anonymous"></script>

    <title>ThreeBib - <?= ucfirst($table); ?></title>
    <link rel="stylesheet" type="text/css" href="css/produk.css" />
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="index.php">ThreeBib</a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="produk.php?table=tshirt"class="<?= $table === 'tshirt' ? 'active' : ''; ?>">T-shirt</a></li>
                        <li><a href="produk.php?table=hoodie" class="<?= $table === 'hoodie' ? 'active' : ''; ?>">Hoodie</a></li>
                        <li><a href="produk.php?table=pants" class="<?= $table === 'pants' ? 'active' : ''; ?>">Pants</a></li>
                        <li><a href="produk.php?table=shoes" class="<?= $table === 'shoes' ? 'active' : ''; ?>">Shoes</a></li>
                    </ul>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <article class="produk" id="<?= $table; ?>">
            <div class="container">
                <div class="title">
                <h1><?= ucfirst($table); ?></h1>
                </div>
                <div class="produk-list">
                    <?php foreach ($data as $item): ?>
                    <div class="card"
                        onclick="openPopup('<?= htmlspecialchars($item['nama']); ?>', '<?= htmlspecialchars($item['jenis']); ?>', 'Rp <?= number_format($item['harga'], 0, ',', '.'); ?>', 'img/<?= $item['gambar']; ?>', '<?= htmlspecialchars($item['detail']); ?>', '<?= $item['id']; ?>', '<?= $table; ?>')">
                        <img src="img/<?= $item['gambar']; ?>" alt="Gambar <?= htmlspecialchars($item['nama']); ?>">
                        <div class="card-content">
                            <h2><?= htmlspecialchars($item['nama']); ?></h2>
                            <p><?= htmlspecialchars($item['jenis']); ?></p>
                            <p>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </article>

        <div class="popup-overlay" id="popup-overlay"></div>
        <div class="popup" id="popup">
            <div class="popup-content">
                <span class="close" id="close-popup">&times;</span>
                <img src="" alt="Gambar Popup" id="popup-img">
                <h2 id="popup-title"></h2>
                <p id="popup-jenis"></p>
                <p id="popup-harga"></p>
                <p id="popup-detail"></p>
                <a href="order.php" id="order-button" class="order-button">Pesan</a>
            </div>
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
                    <p>Designed by kelompok3</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>