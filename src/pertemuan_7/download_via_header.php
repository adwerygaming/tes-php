<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure File Download</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 text-center">
                        <h4 class="fw-bold mb-3">Download Area</h4>
                        <p class="text-muted small mb-4">Unduh dokumen resmi secara aman
                            via HTTP Header.</p>

                        <div class="d-grid gap-2">
                            <!-- Link Download mengarah ke download.php bukan langsung ke file -->
                            <a href="download.php?file=dokumen.pdf"
                                class="btn btn-primary btn-lg rounded-3 fs-6">
                                <i class="bi bi-file-earmark-arrow-down">
                                </i> Unduh Dokumen (PDF)
                            </a>

                            <a href="download.php?file=gambar.jpg"
                                class="btn btn-outline-secondary btn-lg rounded-3 fs-6">
                                <i class="bi bi-image"></i> Unduh Gambar (JPG)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>