<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$table = isset($_GET['table']) ? $_GET['table'] : ''; // Default kosong jika tidak ada
$valid_tables = ['tshirt', 'hoodie', 'shoes', 'pants', 'transaksi']; // Tambahkan 'transaksi'

if (!in_array($table, $valid_tables)) {
    $table = ''; // Set ke kosong jika tabel tidak valid
}

$data = $table ? query("SELECT * FROM $table") : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9460afeec.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
</head>

<body>
    <header>
        <nav>
            <div class="nav-list">
                <div class="title">
                    <h1>ThreeBib</h1>
                </div>
                <ul>
                    <li><a class="<?= !$table ? 'active' : ''; ?>" href="admin.php">Home</a></li>
                    <li><a class="<?= $table === 'tshirt' ? 'active' : ''; ?>"href="admin.php?table=tshirt">T-Shirt</a></li>
                    <li><a class="<?= $table === 'hoodie' ? 'active' : ''; ?>" href="admin.php?table=hoodie">Hoodie</a></li>
                    <li><a class="<?= $table === 'shoes' ? 'active' : ''; ?>" href="admin.php?table=shoes">Shoes</a></li>
                    <li><a class="<?= $table === 'pants' ? 'active' : ''; ?>" href="admin.php?table=pants">Pants</a></li>
                    <li><a class="<?= $table === 'transaksi' ? 'active' : ''; ?>"href="admin.php?table=transaksi">Transaksi</a></li>
                </ul>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <?php if (!$table) : ?>
        <article class="welcome">
            <div class="container">
                <div class="desc">
                    <h1>Selamat Datang, Admin</h1>
                    <p>Pilih salah satu kategori dari menu di bawah untuk melihat data.</p>
                </div>
                <div class="option">
                    <ul>
                        <li>
                            <a href="admin.php?table=tshirt" class="btn"><i class="fa-solid fa-shirt"
                                    style="color: #ffffff;"></i> T-Shirt</a>
                        </li>
                        <li>
                            <a href="admin.php?table=hoodie" class="btn"><i class="fa-solid fa-seedling"
                                    style="color: #ffffff;"></i> Hoodie</a>
                        </li>
                        <li>
                            <a href="admin.php?table=pants" class="btn"><i class="fa-solid fa-box"
                                    style="color: #ffffff;"></i> Pants</a>
                        </li>
                        <li>
                            <a href="admin.php?table=shoes" class="btn"><i class="fa-solid fa-table-cells-large"
                                    style="color: #ffffff;"></i> Shoes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </article>

        <?php else : ?>
        <article class="table">
            <div class="container">
                <div class="tablename">
                    <h1>Data <?= ucfirst($table); ?></h1>
                </div>
                <?php if ($table === 'transaksi') : ?>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Pemesan</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['harga']; ?></td>
                                <td><?= $row['pemesan']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else : ?>
                <div class="insert">
                    <a href="tambah.php?table=<?= $table; ?>">Tambah Data <?= ucfirst($table); ?></a>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>jumlah</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jenis']; ?></td>
                                <td><?= $row['kategori']; ?></td>
                                <td><?= $row['harga']; ?></td>
                                <td><?= $row['detail']; ?></td>
                                <td><img src="img/<?= $row['gambar']; ?>" width="50"></td>
                                <td class="aksi">
                                    <a href="ubah.php?id=<?= $row['id']; ?>&tabel=<?= $table; ?>">Ubah</a> |
                                    <a href="hapus.php?id=<?= $row['id']; ?>&tabel=<?= $table; ?>"
                                        onclick="return confirm('Yakin?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </article>
        <?php endif; ?>
    </main>
</body>

</html>