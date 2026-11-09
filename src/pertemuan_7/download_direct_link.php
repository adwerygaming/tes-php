<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direct Link Download</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 text-center">
                        <h4 class="fw-bold mb-3">Download Area (Direct Link)</h4>
                        <p class="text-muted small mb-4">Unduh dokumen menggunakan
                            autan langsung ke direktori file.</p>

                        <div class="d-grid gap-2">
                            <!-- Link langsung mengarah ke folder/file fisik -->
                            <!-- Atribut 'download' memaksa file diunduh daripada dibuka di browser -->
                            <a href="files/dokumen.pdf" download class="btn btn-primary
                            btn-lg rounded-3 fs-6">
                                Unduh Dokumen (PDF)
                            </a>

                            <a href="files/gambar.jpg" download="nama-baru-gambar.jpg"
                                class="btn btn-outline-secondary btn-lg rounded-3 fs-6">
                                Unduh Gambar (JPG)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>