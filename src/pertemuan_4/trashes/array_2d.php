<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array 2D</title>
</head>
<body>
    <?php 
    $mobil = array(
        array("Honda", 17, 10),
        array("BMW", 10, 5),
        array("Tesla", 5, 3),
        array("Audi", 7, 4),
    );

    for ($baris=0; $baris < 4; $baris++) { 
        echo "<p><b>Baris ke $baris</b></p>";
        echo "<ul>";
        for ($kolom=0; $kolom < 3; $kolom++) { 
            echo "<li>". $mobil[$baris][$kolom] . "</li>";
        };
        echo "</ul>";
    }
    ?>
</body>
</html>