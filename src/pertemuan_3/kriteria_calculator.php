<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Kriteria NIlai Akhir</title>
</head>

<body>
    <h1>Hitung Kriteria NIlai Akhir</h1>

    <form action="kriteria_calculator.php" method="POST">
        <table>
            <tr>
                <td>Input Nama Anda</td>
                <td>:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Input Nilai 1</td>
                <td>:</td>
                <td><input type="number" name="num1"></td>
            </tr>
            <tr>
                <td>Input Nilai 2</td>
                <td>:</td>
                <td><input type="number" name="num2"></td>
            </tr>
            <tr>
                <td>Input Nilai 3</td>
                <td>:</td>
                <td><input type="number" name="num3"></td>
            </tr>

            <tr>
                <td>
                    <button type="submit">Hitung</button>
                    <button type="reset">Hapus</button>
                </td>
            </tr>
        </table>
    </form>


    <?php
    $name = $_POST['name'] ?? null;
    $num1 = $_POST['num1'] ?? null;
    $num2 = $_POST['num2'] ?? null;
    $num3 = $_POST['num3'] ?? null;

    if (isset($name) && isset($num1) && isset($num2) && isset($num3)) {
        echo "<hr>";

        $totalScore = $num1 + $num2 + $num3;
        $tc = $totalScore;
        $avgScore = round($totalScore / 3, 2);

        if ($tc >= 90) {
            $finalCriteria = "Nilai Memuaskan";
        } elseif ($tc >= 80) {
            $finalCriteria = "Nilai Bagus";
        } elseif ($tc >= 65) {
            $finalCriteria = "Nilai Cukup";
        } elseif ($tc >= 50) {
            $finalCriteria = "Nilai Kurang";
        } else {
            $finalCriteria = "Nilai Kurang Sekali";
        }

        echo "<h1>Hasil</h1>";

        echo "<table>";
        echo "    <tr>";
        echo "        <td>Nama Anda</td>";
        echo "        <td>:</td>";
        echo "        <td>$name</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Nilai 1</td>";
        echo "        <td>:</td>";
        echo "        <td>$num1</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Nilai 2</td>";
        echo "        <td>:</td>";
        echo "        <td>$num2</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Nilai 3</td>";
        echo "        <td>:</td>";
        echo "        <td>$num3</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Jumlah Nilai</td>";
        echo "        <td>:</td>";
        echo "        <td>$totalScore</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Rata - Rata Nilai</td>";
        echo "        <td>:</td>";
        echo "        <td>$avgScore</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Kreteria Nilai Anda</td>";
        echo "        <td>:</td>";
        echo "        <td>$finalCriteria</td>";
        echo "    </tr>";
        echo "</table>";
    }
    ?>
</body>

</html>