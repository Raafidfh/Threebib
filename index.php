<?php
// koneksi ke database
require 'function.php';

// Nama-nama tabel dalam database
$tables = ['tshirt', 'hoodie', 'pants', 'shoes'];

$data = [];

// Mengambil data dari masing-masing tabel
foreach ($tables as $table) {
    $data = array_merge($data, query("SELECT * FROM $table"));
}

// Batasi hanya 6 produk yang ditampilkan
$data = array_slice($data, 0, 6);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9460afeec.js" crossorigin="anonymous"></script>

    <title>ThreeBib</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
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
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="produk.php?table=tshirt">T-shirt</a></li>
                        <li><a href="produk.php?table=hoodie">Hoodie</a></li>
                        <li><a href="produk.php?table=pants">Pants</a></li>
                        <li><a href="produk.php?table=shoes">Shoes</a></li>
                    </ul>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <article class="home" id="home">
            <div class="container">
                <div class="title">
                    <h1>Selamat Datang di <span>Store</span> Kami!</h1>
                    <p>Express your style, Order now!</p>
                </div>
                <div class="produk">
                    <?php foreach ($data as $item): ?>
                    <div class="card"
                        onclick="openPopup('<?= htmlspecialchars($item['nama']); ?>', '<?= htmlspecialchars($item['jenis']); ?>', 'Rp <?= number_format($item['harga'], 0, ',', '.'); ?>', 'img/<?= $item['gambar']; ?>', '<?= htmlspecialchars($item['detail']); ?>')">
                        <img src="img/<?= $item['gambar']; ?>" alt="Gambar <?= htmlspecialchars($item['nama']); ?>">
                        <div class="card-content">
                            <h2><?= htmlspecialchars($item['nama']); ?></h2>
                            <p><?= htmlspecialchars($item['jenis']); ?></p>
                            <p>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="title">
                    <br>
                    <h1>Kategori</h1>
                </div>
                <div class="option">
                    <ul>
                        <li>
                            <a href="produk.php?table=tshirt" class="btn"><i class="fa-solid fa-shirt"
                                    style="color: #ffffff;"></i> T-Shirt</a>
                        </li>
                        <li>
                            <a href="produk.php?table=hoodie" class="btn"><i class="fa-duatone fa-solid fa-user-hoodie"
                                    style="color: #ffffff;"></i> Hoodie</a>
                        </li>
                        <li>
                            <a href="produk.php?table=pants" class="btn"><i class="fa-solid fa-box"
                                    style="color: #ffffff;"></i> Pants</a>
                        </li>
                        <li>
                            <a href="produk.php?table=shoes" class="btn"><i class="fa-solid fa-footprints"
                                    style="color: #ffffff;"></i> Shoes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </article>

        <div class="popup-overlay" id="popup-overlay" style="display: none;"></div>
        <div class="popup" id="popup" style="display: none;">
            <div class="popup-content">
                <span class="close" id="close-popup">&times;</span>
                <img src="" alt="Gambar Popup" id="popup-img">
                <h2 id="popup-title"></h2>
                <p id="popup-jenis"></p>
                <p id="popup-harga"></p>
                <p id="popup-detail"></p>
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
                    <p>Designed by Kelompok3</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
    function openPopup(title, jenis, harga, imgSrc, detail) {
        document.getElementById('popup-title').innerText = title;
        document.getElementById('popup-jenis').innerText = jenis;
        document.getElementById('popup-harga').innerText = harga;
        document.getElementById('popup-img').src = imgSrc;
        document.getElementById('popup-detail').innerText = detail;

        document.getElementById('popup').style.display = 'block';
        document.getElementById('popup-overlay').style.display = 'block';
    }

    document.getElementById('close-popup').onclick = function() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup-overlay').style.display = 'none';
    };

    document.getElementById('popup-overlay').onclick = function() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup-overlay').style.display = 'none';
    };
    </script>
</body>

</html>