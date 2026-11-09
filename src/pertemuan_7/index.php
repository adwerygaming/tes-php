<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Upload File Sederhana</title>
</head>

<body>
    <h2>Form Upload File</h2>

    <!-- Atribut enctype="multipart/form-data" wajib ada untuk
         pengiriman berkas biner -->
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="berkas">Pilih File (Gambar/PDF, Max 2MB):</label><br><br>
        <input type="file" name="berkas" id="berkas" required><br><br>

        <button type="submit" name="submit">Upload Sekarang</button>
    </form>

</body>

</html>