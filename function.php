<?php

$conn = mysqli_connect("localhost", "root", "", "barang");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows [] = $row;
    }
    return $rows;
};

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username yang dipilih sudah terdaftar');
            </script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // Tambahkan user baru ke database tanpa enkripsi password
    $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);

    // Cek apakah data berhasil dimasukkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Registrasi berhasil!');
                window.location.href = 'login.php';
            </script>";
        exit;
    } else {
        echo "<script>
                alert('Registrasi gagal!');
            </script>";
    }
}

function tambah($data, $table) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $harga = htmlspecialchars($data["harga"]);
    $detail = htmlspecialchars($data["detail"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO $table (nama, jenis, kategori, harga, detail, gambar) VALUES ('$nama', '$jenis', '$kategori', '$harga', '$detail', '$gambar')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn); 
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];    
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang Anda upload bukan gambar!');</script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran terlalu besar!');</script>";
        return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function ubah($tabel, $data) {
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $harga = htmlspecialchars($data["harga"]);
    $detail = htmlspecialchars($data["detail"]);
    
    // Ambil gambar lama jika tidak ada gambar baru
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    
    // Cek apakah user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama; // Jika tidak ada gambar baru, gunakan gambar lama
    } else {
        $gambar = upload(); // Fungsi untuk upload gambar
    }

    $query = "UPDATE $tabel SET
                nama = '$nama',
                jenis = '$jenis',
                kategori = '$kategori',
                harga = '$harga',
                detail = '$detail',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($tabel, $id) {
    global $conn;
    
    // Mengambil detail item sebelum penghapusan
    $result = mysqli_query($conn, "SELECT nama, jenis, kategori, harga, detail, gambar FROM $tabel WHERE id = $id");
    $item = mysqli_fetch_assoc($result);
    
    // Menghapus data dari tabel
    mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");

    return mysqli_affected_rows($conn);
}


?>