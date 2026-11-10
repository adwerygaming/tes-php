<?php
// =====================================================
// Halaman web berita (header, daftar berita, detail, footer)
// dalam satu file.
// Alamat: index.php            -> daftar berita
//         index.php?id=1       -> detail berita
// =====================================================
include "admin/config.php";

// Folder tempat menyimpan gambar berita
$folder = "images/berita/";

// Id berita dari alamat URL. Kalau kosong, tampilkan daftar berita.
$id = $_GET["id"] ?? "";

if ($id != "") {
    // ---------- Bagian detail berita ----------

    // Cari berita yang akan ditampilkan.
    // Hanya berita berstatus "publish" yang boleh dibuka di halaman depan.
    $sql = "SELECT * FROM news WHERE id = ? AND status = 'publish'";
    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $hasil = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($hasil);

    // Kalau berita tidak ada, kembali ke halaman utama
    if (!$data) {
        header("Location: index.php");
        exit;
    }

    // Ambil alamat gambar dari kolom berita_gambar.
    // Isinya boleh hanya nama file, atau sudah lengkap dengan foldernya.
    $gambar = $data["image"];

    if ($gambar != "" && strpos($gambar, "images/") !== 0) {
        $gambar = $folder . $gambar;
    }

    // Pakai gambar cadangan kalau gambar berita tidak ada
    if ($gambar == "" || !file_exists($gambar)) {
        $gambar = "images/placeholder.svg";
    }

    // Ambil 3 berita lain untuk bagian "Berita Lainnya"
    // Hanya berita yang sudah terbit (publish) yang ditampilkan.
    $sql_lain = "SELECT * FROM news
                 WHERE id != ?
                   AND status = 'publish'
                 ORDER BY created_at DESC, id DESC
                 LIMIT 3";

    $stmt_lain = mysqli_prepare($config, $sql_lain);
    mysqli_stmt_bind_param($stmt_lain, "i", $id);
    mysqli_stmt_execute($stmt_lain);

    $hasil_lain = mysqli_stmt_get_result($stmt_lain);

    // Judul halaman memakai judul berita
    $judul = $data["title"];
} else {
    // ---------- Bagian daftar berita ----------

    // Tampilkan semua berita yang sudah terbit (publish), yang terbaru di atas.
    // Berita berstatus draft tidak ikut ditampilkan.
    $sql = "SELECT * FROM news
            WHERE status = 'publish'
            ORDER BY created_at DESC, id DESC";
    $hasil = mysqli_query($config, $sql);

    // Jumlah berita yang didapat
    $jumlah = mysqli_num_rows($hasil);

    // Judul halaman
    $judul = "Beranda";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($judul) ?> - Berita Jogja</title>

  <!-- File CSS ada di folder css/ -->
  <!-- Tulisan ?v=4 membuat browser mengambil file CSS terbaru (bukan versi cache lama) -->
  <link rel="stylesheet" href="css/style.css?v=4">
</head>
<body>

  <header class="situs-header">
    <div class="wadah header-dalam">

      <a href="index.php" class="merek">
        <span class="merek-ikon">BJ</span>
        <span class="merek-teks">Berita <strong>Jogja</strong></span>
      </a>

      <button type="button" class="tombol-menu" id="tombolMenu">Menu</button>

      <nav class="menu" id="menu">
        <a href="index.php">Beranda</a>
        <a href="admin/berita.php" class="tombol-admin">Login Admin</a>
      </nav>

    </div>
  </header>

  <main class="wadah isi-utama">

  <?php if ($id != "") : ?>

    <!-- ---------- Tampilan detail berita ---------- -->
    <article class="artikel">

      <a href="index.php" class="tautan-balik">&larr; Kembali ke beranda</a>

      <h1 class="judul-artikel"><?= htmlspecialchars($data["title"]) ?></h1>

      <p class="meta">
        <?= date("d-m-Y", strtotime($data["created_at"])) ?>
        &middot; Ditulis oleh <?= htmlspecialchars($data["username"]) ?>
      </p>

      <img class="gambar-artikel" src="<?= htmlspecialchars($gambar) ?>"
           alt="<?= htmlspecialchars($data["title"]) ?>">

      <div class="isi-artikel"><?= nl2br(htmlspecialchars($data["isi"])) ?></div>

    </article>

    <?php if (mysqli_num_rows($hasil_lain) > 0) : ?>

      <section class="bagian-lain">
        <h2>Berita Lainnya</h2>

        <div class="daftar-kartu">
          <?php while ($lain = mysqli_fetch_assoc($hasil_lain)) : ?>
            <?php
              // Alamat gambar berita lain, sama seperti berita utama
              $gambar_lain = $lain["image"];

              if ($gambar_lain != "" && strpos($gambar_lain, "images/") !== 0) {
                  $gambar_lain = $folder . $gambar_lain;
              }

              // Gambar cadangan untuk berita lain
              if ($gambar_lain == "" || !file_exists($gambar_lain)) {
                  $gambar_lain = "images/placeholder.svg";
              }
            ?>
            <article class="kartu">
              <a href="index.php?id=<?= urlencode($lain["id"]) ?>" class="kartu-gambar">
                <img src="<?= htmlspecialchars($gambar_lain) ?>"
                     alt="<?= htmlspecialchars($lain["title"]) ?>">
              </a>

              <div class="kartu-isi">
                <p class="meta">
                  <?= date("d-m-Y", strtotime($lain["created_at"])) ?>
                  &middot; <?= htmlspecialchars($lain["username"]) ?>
                </p>
                <h2>
                  <a href="index.php?id=<?= urlencode($lain["id"]) ?>">
                    <?= htmlspecialchars($lain["title"]) ?>
                  </a>
                </h2>
                <a href="index.php?id=<?= urlencode($lain["id"]) ?>" class="tombol-baca">
                  Baca Selengkapnya &rarr;
                </a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </section>

    <?php endif; ?>

  <?php else : ?>

    <!-- ---------- Tampilan daftar berita ---------- -->
    <section class="kepala-daftar">
      <h1>Berita Terbaru</h1>
      <p class="teks-kecil"><?= $jumlah ?> berita telah diterbitkan</p>
    </section>

    <?php if ($jumlah == 0) : ?>

      <div class="kotak-kosong">
        Belum ada berita yang diterbitkan. Silakan tambah berita dari halaman admin.
      </div>

    <?php else : ?>

      <div class="daftar-kartu">
        <?php $no = 1; ?>
        <?php while ($data = mysqli_fetch_assoc($hasil)) : ?>
          <?php
            // Ambil alamat gambar dari kolom berita_gambar.
            // Isinya boleh hanya nama file (b123456789.png) atau sudah lengkap
            // dengan foldernya (images/berita/b123456789.png).
            $gambar = $data["image"];

            if ($gambar != "" && strpos($gambar, "images/") !== 0) {
                $gambar = $folder . $gambar;
            }

            // Pakai gambar cadangan kalau gambar berita tidak ada
            if ($gambar == "" || !file_exists($gambar)) {
                $gambar = "images/placeholder.svg";
            }

            // Ringkasan isi berita 
            $ringkasan = trim(strip_tags($data["isi"]));
            if (mb_strlen($ringkasan) > 160) {
                $ringkasan = mb_substr($ringkasan, 0, 160) . "...";
            }
          ?>
          <article class="kartu <?= ($no == 1) ? "kartu-utama" : "" ?>">
            <a href="index.php?id=<?= urlencode($data["id"]) ?>" class="kartu-gambar">
              <img src="<?= htmlspecialchars($gambar) ?>"
                   alt="<?= htmlspecialchars($data["title"]) ?>">
            </a>

            <div class="kartu-isi">
              <p class="meta">
                <?= date("d-m-Y", strtotime($data["created_at"])) ?>
                &middot; <?= htmlspecialchars($data["username"]) ?>
              </p>
              <h2>
                <a href="index.php?id=<?= urlencode($data["id"]) ?>">
                  <?= htmlspecialchars($data["title"]) ?>
                </a>
              </h2>
              <p class="ringkasan"><?= htmlspecialchars($ringkasan) ?></p>
              <a href="index.php?id=<?= urlencode($data["id"]) ?>" class="tombol-baca">
                Baca Selengkapnya &rarr;
              </a>
            </div>
          </article>
          <?php $no++; ?>
        <?php endwhile; ?>
      </div>

    <?php endif; ?>

  <?php endif; ?>

  </main>

  <footer class="situs-footer">
    <div class="wadah">
      <p>&copy; <?= date("Y") ?> Berita Jogja. Hak cipta dilindungi.</p>
    </div>
  </footer>

  <!-- File JavaScript ada di folder js/ -->
  <script src="js/main.js"></script>

</body>
</html>
