<?php
require 'function.php';

$id = $_GET["id"];
$tabel = $_GET["tabel"]; // Ambil nama tabel dari parameter URL

$barang = query("SELECT * FROM $tabel WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (ubah($tabel, $_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'admin.php?table=$tabel'; // Mengarahkan ke halaman admin dengan tabel yang dipilih
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah');
                document.location.href = 'admin.php?table=$tabel'; // Mengarahkan ke halaman admin dengan tabel yang dipilih
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
    <title>Ubah Data <?= ucfirst($tabel); ?></title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <div class="container">
        <h1>Ubah Data <?= ucfirst($tabel); ?></h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $barang['id']; ?>">
            <input type="hidden" name="tabel" value="<?= htmlspecialchars($tabel); ?>">

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="<?= $barang['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="jenis">Jenis:</label>
                <input type="text" name="jenis" id="jenis" value="<?= $barang['jenis']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" name="kategori" id="kategori" value="<?= $barang['kategori']; ?>" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" value="<?= $barang['harga']; ?>" required>
            </div>

            <div class="form-group">
                <label for="detail">Detail:</label>
                <textarea name="detail" id="detail" required><?= $barang['detail']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
                <input type="hidden" name="gambarLama" value="<?= $barang['gambar']; ?>">
                <p>Gambar saat ini: <img src="img/<?= $barang['gambar']; ?>" width="250" alt="Gambar"></p>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Ubah Data</button>
                <a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" class="btn-back">
                    <button type="button">Kembali</button>
                </a>
            </div>
        </form>
    </div>
</body>

</html>