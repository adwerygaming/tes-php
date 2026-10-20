<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku</title>
</head>
<body>
    <?php 

    $kategoriBuku = array(
        "Novel",
        "Pemrograman Web",
        "Database",
        "Desain Grafis",
        "Internet",
        "Office Application"
        );

    echo "<strong>Daftar Kategori Buku:</strong>" . "<br>";
    for ($i=0; $i < sizeof($kategoriBuku); $i++) { 
        echo "Nama Buku $i: " . $kategoriBuku[$i] . "<br>";
    }

    ?>
</body>
</html>