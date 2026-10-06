<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About me</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <header class="header">
        <h1>About Me</h1>
    </header>

    <div class="bento">
        <div>
            <?php
            $nama = "Devan Aditiya";
            $nim = "25.12.3654";
            $prodi = "Sistem Informasi";
            $college = "Universitas AMIKOM Yogyakarta";

            echo "<h3>Profil</h3>";
            echo "<p>Nama: $nama</p>";
            echo "<p>NIM: $nim</p>";
            echo "<p>Berkuliah di: $college</p>";
            echo "<p>Prodi: $prodi</p>";
            
            $foods = array("Nasi Goreng", "Mie Goreng", "Sate Ayam", "Bakso", "Rendang");

            for ($i = 0; $i < count($foods); $i++) {
                echo "<p>Makanan favorit ke-" . ($i + 1) . ": " . $foods[$i] . "</p>";
            }

            // for ($i = 1; $i <= 65535; $i++) {
            //     echo "<p>Halo ke-$i</p>";
            // }
            
            ?>

        </div>

        <div class="links">
            <p>Links</p>
            <a href="https://github.com/adwerygaming" target="_blank">GitHub</a>
            <a href="https://masdepan.my.id" target="_blank">Website</a>
        </div>
    </div>
</body>

</html>