<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Angka</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <form action="latihan2.php" method="GET">
        <div class="row">
            <p>Nama Anda:</p>
            <input type="text" name="name">
        </div>

        <div class="row">
            <p>Angka 1:</p>
            <input type="number" name="number1">
        </div>

        <div class="row">
            <p>Angka 2:</p>
            <input type="number" name="number2">
        </div>

        <div class="row">
            <button type="submit" name="kirim">Kirim</button>
        </div>
    </form>

    <div class="results">
        <?php
        if (isset($_GET['kirim'])) {
            $name = $_GET['name'];
            $number1 = $_GET['number1'];
            $number2 = $_GET['number2'];

            echo '<div class="row">';
            echo "Nama anda: $name";
            echo '</div>';

            echo '<div class="row">';
            echo "Angka 1: $number1";
            echo '</div>';

            echo '<div class="row">';
            echo "Angka 2: $number2";
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>