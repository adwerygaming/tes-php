<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>While dan Do While</title>
</head>
<body>
    <p>Pereulangan while <br></p>
    
    <?php
        $i = 1;

        while ($i <= 10) {
            echo "Ini perulangan ke-$i <br/>";
            $i++;
        }
    ?>

    <hr/>

    <p>Perulangan Do While <br/></p>
    
    <?php 
        $j = 5;
        do {
            echo "<br/>Perulangan ini kondisinya tidak terpenuhi";
            $j++;
        } while ($j <= 3);
    ?>
</body>
</html>