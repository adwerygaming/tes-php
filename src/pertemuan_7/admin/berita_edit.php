<?php
include "cek_login.php";

// Alamat folder gambar untuk tag <img> di halaman ini
$folder_url = "../images/berita/";

// Alamat folder gambar di komputer (untuk mengecek file benar-benar ada)
$folder = __DIR__ . "/../images/berita/";

// Ambil id berita dari alamat URL
$id = $_GET["id"] ?? "";

// Cari data berita yang akan diubah
$sql = "SELECT * FROM news WHERE id = ?";
$stmt = mysqli_prepare($config, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);

// Kalau data tidak ada, kembali ke daftar berita
if (!$data) {
    header("Location: berita.php?pesan=tidakada");
    exit;
}

// Info gambar lama yang akan ditampilkan di halaman ini
// Nama file (sudah termasuk ekstensinya) diambil dari database
$nama_gambar     = $data["image"];

// Ukuran file dan resolusi tidak disimpan di database,
// jadi dibaca langsung dari file gambar di folder images/berita
$ukuran_gambar   = "-";
$resolusi_gambar = "-";

if ($nama_gambar != "" && file_exists($folder . $nama_gambar)) {
    // Ukuran file dalam KB, contoh: 123,45 KB
    $ukuran_gambar = number_format(filesize($folder . $nama_gambar) / 1024, 2, ",", ".") . " KB";

    // Resolusi gambar dalam piksel, contoh: 800 x 450 piksel
    $info_gambar = @getimagesize($folder . $nama_gambar);
    if ($info_gambar) {
        $resolusi_gambar = $info_gambar[0] . " x " . $info_gambar[1] . " piksel";
    }
}

// Judul halaman
$judul = "Edit Berita";
include "header.php";

// Pesan dari halaman sebelumnya (dikirim lewat alamat URL)
$pesan = $_GET["pesan"] ?? "";
?>

<div class="row justify-content-center">
    <div class="col-12 col-md-9 col-lg-7">

        <h1 class="h4 mb-3">Edit Berita</h1>

        <?php if ($pesan == "kosong") : ?>
            <div class="alert alert-danger">Semua kolom wajib diisi.</div>
        <?php elseif ($pesan == "format") : ?>
            <div class="alert alert-warning">Gambar harus berformat JPG, JPEG, PNG, GIF, atau WEBP.</div>
        <?php elseif ($pesan == "ukuran") : ?>
            <div class="alert alert-warning">Ukuran gambar maksimal 2 MB.</div>
        <?php elseif ($pesan == "gagalunggah") : ?>
            <div class="alert alert-danger">Gambar gagal disimpan ke folder images/berita. Pastikan folder tersebut ada
                dan bisa ditulis oleh server.</div>
        <?php elseif ($pesan == "gagal") : ?>
            <div class="alert alert-danger">Data gagal disimpan. Silakan coba lagi.</div>
        <?php endif; ?>

        <form action="berita_edit_action.php" method="post" enctype="multipart/form-data" class="box">

            <input type="hidden" name="id" value="<?= htmlspecialchars($data["id"]) ?>">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" id="judul" name="judul"
                    value="<?= htmlspecialchars($data["title"]) ?>"
                    maxlength="150" required>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea class="form-control" id="isi" name="isi" rows="8" required><?= htmlspecialchars($data["isi"]) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Berita</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    value="<?= htmlspecialchars($data["created_at"]) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label>
                <div>
                    <?php if ($data["image"] != "" && file_exists($folder . $data["image"])) : ?>
                        <img src="<?= $folder_url . htmlspecialchars($data["image"]) ?>"
                            alt="Gambar berita" class="gambar-preview rounded">
                    <?php elseif ($data["image"] != "") : ?>
                        <span class="text-muted">File gambar "<?= htmlspecialchars($data["image"]) ?>" tidak
                            ditemukan di folder images/berita.</span>
                    <?php else : ?>
                        <span class="text-muted">Belum ada gambar.</span>
                    <?php endif; ?>
                </div>

                <?php if ($nama_gambar != "") : ?>
                    <table class="table table-sm table-bordered info-gambar mt-3 mb-0">
                        <tbody>
                            <tr>
                                <th>Nama File</th>
                                <td class="email"><?= htmlspecialchars($nama_gambar) ?></td>
                            </tr>
                            <tr>
                                <th>Ukuran File</th>
                                <td><?= htmlspecialchars($ukuran_gambar) ?></td>
                            </tr>
                            <tr>
                                <th>Resolusi</th>
                                <td><?= htmlspecialchars($resolusi_gambar) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-text">Nama file diambil dari database. Ukuran file dan resolusi dibaca langsung dari
                        file gambar.</div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Baru</label>
                <input type="file" class="form-control" id="gambar" name="gambar"
                    accept=".jpg,.jpeg,.png,.gif,.webp">
                <div class="form-text">Kosongkan jika gambar tidak ingin diubah. Maksimal 2 MB.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" class="form-control"
                    value="<?= htmlspecialchars($data["username"]) ?>" readonly>
                <div class="form-text">Penulis tidak bisa diubah.</div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="berita.php" class="btn btn-secondary">Batal</a>

        </form>

    </div>
</div>

<?php include "footer.php"; ?>