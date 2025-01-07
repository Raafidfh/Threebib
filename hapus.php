<?php

require 'function.php';

$id = $_GET["id"];
$tabel = $_GET["tabel"]; // Ambil nama tabel dari parameter URL

if (hapus($tabel, $id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'admin.php?table=$tabel'; // Mengarahkan ke admin.php dengan tabel yang sesuai
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus');
            document.location.href = 'admin.php?table=$tabel'; // Mengarahkan ke admin.php dengan tabel yang sesuai
        </script>
    ";
}
?>