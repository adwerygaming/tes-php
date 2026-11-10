// =====================================================
// Script untuk halaman web berita (di luar folder admin)
// =====================================================

// 1. Tombol menu untuk layar kecil (HP)
var tombolMenu = document.getElementById("tombolMenu");
var menu = document.getElementById("menu");

if (tombolMenu && menu) {
  tombolMenu.addEventListener("click", function () {
    menu.classList.toggle("buka");
  });
}

// 2. Gambar yang gagal dimuat diganti dengan gambar cadangan
var semuaGambar = document.querySelectorAll("img");

for (var i = 0; i < semuaGambar.length; i++) {
  semuaGambar[i].addEventListener("error", function () {
    // Cegah perulangan kalau gambar cadangan juga gagal dimuat
    if (!this.src.endsWith("placeholder.svg")) {
      this.src = "images/placeholder.svg";
    }
  });
}

// 3. Menu otomatis tertutup setelah memilih tautan (layar kecil)
if (menu) {
  menu.addEventListener("click", function (event) {
    if (event.target.tagName === "A") {
      menu.classList.remove("buka");
    }
  });
}
