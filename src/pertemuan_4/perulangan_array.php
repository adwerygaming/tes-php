<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perulanganArray</title>
</head>
<body>
    <!-- 25.12.3654 -->
    
    <?php
    $negara = array("Indonesia", "Malaysia", "Singapura", "Thailand");

    // method 1
    echo "<h4>Beberapa nama negara di Asia Tenggara</h4>";
    for ($i=0; $i < sizeof($negara); $i++) { 
        echo "$negara[$i]<br>";
    }
    echo "<br>";

    // method 2
    echo "<h4>Susunan Pengurus UKM 'XX'</h4>";
    $pengurus = array(
        'Ketua' => 'Akbar',
        'Sekretaris' => 'Budi',
        'Bendahara' => 'Candra');

    foreach ($pengurus as $jabatan => $nama) {
        echo "$jabatan dijabat oleh $nama <br>";
    }
    ?>
</body>
</html>