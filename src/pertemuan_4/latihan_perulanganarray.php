<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Perulanggan Array</title>
</head>
<body>
    <h3>Latihan Array</h3>
    <?php 
    $produk = array(
        "Laptop",
        "Smartphone",
        "Tablet",
        "Keyboard",
        "Mouse Wireless",
        "Monitor LED"
    );  

    $buku = array(
        "judul" => "Belajar PHP untuk Pemula",
        "penulis" => "Justin Pratama",
        "tahun" => 2026,
    );

    echo "<h4>Daftar Kategori Buku</h4>";
    for ($i=0; $i < sizeof($produk); $i++) { 
        echo "Nama buku " . $i+1 . ": " . $produk[$i] . "<br>";
    };

    echo "<br><br><b>Contoh Buku</b><br>";
    foreach ($produk as $kunci => $nilai) {
        echo "$kunci : $nilai <br>";
    }
    
    ?>
</body>
</html>