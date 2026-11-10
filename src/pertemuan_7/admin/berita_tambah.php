<?php
include "cek_login.php";

// Judul halaman
$judul = "Tambah Berita";
include "header.php";

// Pesan dari halaman sebelumnya (dikirim lewat alamat URL)
$pesan = $_GET["pesan"] ?? "";
?>

<div class="row justify-content-center">
    <div class="col-12 col-md-9 col-lg-7">
        <h1 class="h4 mb-3">Tambah Berita</h1>

        <?php if ($pesan == "kosong") : ?>
            <div class="alert alert-danger">Semua kolom wajib diisi, termasuk gambar.</div>
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

        <form action="berita_tambah_action.php" method="post" enctype="multipart/form-data" class="box">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" id="judul" name="judul"
                    maxlength="150" required>
                <div class="form-text">Maksimal 150 karakter.</div>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea class="form-control" id="isi" name="isi" rows="8" required></textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Berita</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    value="<?= date("Y-m-d") ?>" required>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Berita</label>
                <input type="file" class="form-control" id="gambar" name="gambar"
                    accept=".jpg,.jpeg,.png,.gif,.webp" required>
                <div class="form-text">Format JPG, JPEG, PNG, GIF, atau WEBP. Maksimal 2 MB.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" class="form-control"
                    value="<?= htmlspecialchars($user_login) ?>" readonly>
                <div class="form-text">Penulis diisi otomatis sesuai user yang sedang login.</div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="berita.php" class="btn btn-secondary">Batal</a>

        </form>

    </div>
</div>

<?php include "footer.php"; ?>