<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsi 1</title>
</head>
<body>
    <?php 
    
    function cetak_ganjil() {
        for ($i=0; $i < 100; $i++) { 
            if ($i % 2 === 1) {
                echo "$i <br>";
            }
        }
    }

    cetak_ganjil();

    ?>
</body>
</html>