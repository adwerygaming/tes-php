<?php
include "cek_login.php";

// Ambil semua data berita, diurutkan dari yang terbaru
$sql = "SELECT * FROM news ORDER BY created_at DESC, id DESC";
$hasil = mysqli_query($config, $sql);

// Jumlah baris data yang didapat
$jumlah = mysqli_num_rows($hasil);

// Alamat folder gambar untuk tag <img> di halaman ini
$folder_url = "../images/berita/";

// Alamat folder gambar di komputer (untuk mengecek file benar-benar ada)
$folder = __DIR__ . "/../images/berita/";

// Judul halaman
$judul = "Data Berita";

// Panggil bagian atas halaman
include "header.php";
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h4 mb-1">Daftar Berita</h1>
        <p class="text-muted mb-0">Total: <?= $jumlah ?> berita</p>
    </div>
    <a href="berita_tambah.php" class="btn btn-primary">Tambah Berita</a>
</div>

<?php $pesan = $_GET["pesan"] ?? ""; ?>

<?php if ($pesan == "tambah") : ?>
    <div class="alert alert-success">Berita berhasil ditambahkan.</div>
<?php elseif ($pesan == "edit") : ?>
    <div class="alert alert-success">Berita berhasil diperbarui.</div>
<?php elseif ($pesan == "hapus") : ?>
    <div class="alert alert-success">Berita berhasil dihapus.</div>
<?php elseif ($pesan == "draft") : ?>
    <div class="alert alert-success">Berita berhasil diubah menjadi draft dan tidak tampil di halaman depan.</div>
<?php elseif ($pesan == "terbit") : ?>
    <div class="alert alert-success">Berita berhasil diterbitkan dan tampil di halaman depan.</div>
<?php elseif ($pesan == "tidakada") : ?>
    <div class="alert alert-warning">Data berita tidak ditemukan.</div>
<?php elseif ($pesan == "gagal") : ?>
    <div class="alert alert-danger">Data gagal diproses. Silakan coba lagi.</div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle bg-white mb-0">
        <thead class="table-light">
            <tr>
                <th class="text-center" style="width: 60px;">No</th>
                <th style="width: 110px;">Tanggal</th>
                <th class="text-center" style="width: 110px;">Gambar</th>
                <th>Judul</th>
                <th style="width: 140px;">Penulis</th>
                <th class="text-center" style="width: 120px;">Status</th>
                <th class="text-center" style="width: 250px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($data = mysqli_fetch_assoc($hasil)) : ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td class="text-nowrap"><?= date("d-m-Y", strtotime($data["created_at"])) ?></td>
                    <td class="text-center">
                        <?php if ($data["image"] != "" && file_exists($folder . $data["image"])) : ?>
                            <img src="<?= $folder_url . htmlspecialchars($data["image"]) ?>"
                                alt="Thumbnail berita" class="gambar-tabel rounded"
                                width="80" height="60" loading="lazy">
                        <?php else : ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="fw-semibold"><?= htmlspecialchars($data["title"]) ?></div>
                        <?php
                        // Ringkasan isi berita agar tabel tidak terlalu panjang
                        $ringkasan = strip_tags($data["isi"]);
                        if (mb_strlen($ringkasan) > 90) {
                            $ringkasan = mb_substr($ringkasan, 0, 90) . "...";
                        }
                        ?>
                        <div class="text-muted small"><?= htmlspecialchars($ringkasan) ?></div>
                    </td>
                    <td><?= htmlspecialchars($data["username"]) ?></td>
                    <?php
                    // Status berita: draft (belum tampil) atau publish (tampil di halaman depan)
                    $status = $data["status"] ?? "terbit";
                    ?>
                    <td class="text-center text-nowrap">
                        <?php if ($status == "draft") : ?>
                            <span class="badge bg-secondary">Draft</span>
                        <?php else : ?>
                            <span class="badge bg-success">Terbit</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <a href="berita_edit.php?id=<?= urlencode($data["id"]) ?>"
                                class="btn btn-sm btn-warning">Edit</a>

                            <?php if ($status == "draft") : ?>
                                <a href="berita_status.php?id=<?= urlencode($data["id"]) ?>&amp;status=publish"
                                    class="btn btn-sm btn-success">Terbitkan</a>
                            <?php else : ?>
                                <a href="berita_status.php?id=<?= urlencode($data["id"]) ?>&amp;status=draft"
                                    class="btn btn-sm btn-secondary">Jadikan Draft</a>
                            <?php endif; ?>

                            <a href="berita_hapus.php?id=<?= urlencode($data["id"]) ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endwhile; ?>

            <?php if ($jumlah == 0) : ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada data berita.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>