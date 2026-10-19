<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsi</title>
</head>
<body>
    <?php 
    function cetak_judul() {
        echo "<h2>Pemrograman Web Lanjut</h2>";
    }
    ?>

    <?php 
    function pangkat_dua($x) {
        $hasil = $x * $x;
        return $hasil;
    }
    ?>

    <?php 
    cetak_judul();
    ?>
</body>
</html>