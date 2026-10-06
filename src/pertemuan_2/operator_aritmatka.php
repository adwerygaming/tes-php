<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Aritmatika</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="container">
        <h1>Operator Aritmatika</h1>
        <?php
        $x = 6;
        $y = 7;

        echo '<div class="row">';
        echo "Angka 1: $x";
        echo '</div>';

        echo '<div class="row">';
        echo "Angka 2: $y";
        echo '</div>';

        echo "<br>";

        echo '<div class="row">';
        echo "$x + $y = " . ($x + $y);
        echo '</div>';

        echo '<div class="row">';
        echo "$x - $y = " . ($x - $y);
        echo '</div>';

        echo '<div class="row">';
        echo "$x * $y = " . ($x * $y);
        echo '</div>';

        echo '<div class="row">';
        echo "$x / $y = " . ($x / $y);
        echo '</div>';

        echo '<div class="row">';
        echo "$x % $y = " . ($x % $y);
        echo '</div>';
        ?>
    </div>

    <div class="container">
        <h2>Operator Perbandingan dan Operator Logika</h2>
        <?php
        $ipk = 3.5;
        $absen = 0.9;

        if (($ipk >= 3.5) && ($absen >= 0.75)) {
            echo "Anda mendapatkan beasiswa.";
        } else {
            echo "Anda TIDAK LAYAK untuk mendapatkan beasiswa.";
        }
        ?>
    </div>

</body>

</html>