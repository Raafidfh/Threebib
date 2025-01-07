<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$table = isset($_GET['table']) ? $_GET['table'] : ''; // Default kosong jika tidak ada tabel

if (isset($_POST["submit"])) {
    if (tambah($_POST, $table) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah');
                document.location.href = 'admin.php?table=$table';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambah');
                document.location.href = 'admin.php?table=$table';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data <?= ucfirst($table); ?></title>
    <link rel="stylesheet" type="text/css" href="css/crud.css" />

</head>

<body>
    <article class="tambah">
        <div class="container">
            <div class="title">
                <h1>Tambah Data <?= ucfirst($table); ?></h1>
            </div>
            <div class="form">
                <form action="" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label for="nama">Nama: </label>
                            <input type="text" name="nama" id="nama" required>
                        </li>
                        <li>
                            <label for="jenis">Jenis: </label>
                            <input type="text" name="jenis" id="jenis" required>
                        </li>
                        <li>
                            <label for="kategori">Kategori: </label>
                            <input type="text" name="kategori" id="kategori" required>
                        </li>
                        <li>
                            <label for="harga">Harga: </label>
                            <input type="number" name="harga" id="harga" required>
                        </li>
                        <li>
                            <label for="detail">Detail: </label>
                            <textarea name="detail" id="detail" required></textarea>
                        </li>
                        <li>
                            <label for="gambar">Gambar: </label>
                            <input type="file" name="gambar" id="gambar" required>
                        </li>
                        <li>
                            <button type="submit" name="submit">Tambah Data</button>
                            <a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" class="btn-back">
                                <button type="button">Kembali</button>
                            </a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </article>
</body>

</html>