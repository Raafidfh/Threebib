// Fungsi untuk membuka popup
function openPopup(nama, jenis, harga, gambar, detail, id, table) {
  document.getElementById("popup-title").innerText = nama;
  document.getElementById("popup-jenis").innerText = jenis;
  document.getElementById("popup-harga").innerText = harga;
  document.getElementById("popup-detail").innerText = detail;
  document.getElementById("popup-img").src = gambar;

  // Set URL untuk tombol pesan dengan ID dan tabel produk
  document.getElementById(
    "order-button"
  ).href = `order.php?id=${encodeURIComponent(id)}&table=${encodeURIComponent(
    table
  )}`;

  document.getElementById("popup-overlay").style.display = "block";
  document.getElementById("popup").style.display = "block";
  document.getElementById("close-popup").onclick = function () {
    closePopup();
  };

  // Menutup popup saat overlay diklik
  document.getElementById("popup-overlay").onclick = function () {
    closePopup();
  };
}

// Fungsi untuk menutup popup
function closePopup() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("popup-overlay").style.display = "none";
}
