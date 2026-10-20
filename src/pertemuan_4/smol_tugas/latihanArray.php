<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihanArray</title>
</head>

<body>
    <!-- 25.12.3654 -->
    
    <?php
    $kategoribuku[0] = "Pemrograman Web";
    $kategoribuku[1] = "Database";
    $kategoribuku[2] = "Desain Grafis";
    $kategoribuku[3] = "Internet";
    $kategoribuku[4] = "Office Application";

    $buku = array(
        "isbn" => "979-96446-9-2",
        "judul" => "Modul Pemrograman Web Lanjut",
        "pengarang" => "Citra Kirana",
        "penerbit" => "ANDI OFFSET"
    );

    echo "<strong>Daftar Kategori Buku:</strong> <br>";
    echo "Nama Buku 1 : " . $kategoribuku[0] . "<br>";
    echo "Nama Buku 2 : " . $kategoribuku[1] . "<br>";
    echo "Nama Buku 3 : " . $kategoribuku[2] . "<br>";
    echo "Nama Buku 4 : " . $kategoribuku[3] . "<br>";
    echo "Nama Buku 5 : " . $kategoribuku[4] . "<br>";

    echo "<br>";

    echo "<strong>Contoh Buku:</strong> <br>";
    echo "ISBN          : " . $buku["isbn"] . "<br>";
    echo "Judul Buku    : " . $buku["judul"] . "<br>";
    echo "Pengarang     : " . $buku["pengarang"] . "<br>";
    echo "Penerbit      : " . $buku["penerbit"] . "<br>";
    ?>


</body>

</html>