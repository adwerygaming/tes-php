<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch Nilai</title>
</head>

<body>
    <h2>Penilaian Mahasiswa</h2>
    <form action="SwitchNilai_3654.php" method="POST">
        <label for="">M-M-Masukkan Nilai Huruf (A-E)</label>
        <input type="text" name="nilai" required>
        <button type="submit">Periksa Nilai</button>
    </form>

    <?php 
    $nilai = $_POST['nilai'] ?? null;
    if (isset($nilai)) {
        $nilai = strtoupper($nilai);
        switch ($nilai) {
            case 'A':
                $predikat = "Sangat Baik";
                $keterangan = "Lulus";
                break;
            case 'B':
                $predikat = "Baik";
                $keterangan = "Lulus";
                break;
            case 'C':
                $predikat = "Cukup";
                $keterangan = "Lulus";
                break;
            case 'D':
                $predikat = "Kurang";
                $keterangan = "Perlu perbaikan";
                break;
            case 'E':
                $predikat = "Sangat Kurang";
                $keterangan = "Tidak Lulus";
                break;
            default:
                $predikat = "Nilai tidak valid";
                $keterangan = "Periksa kembali nilai yang dimasukkan";
                break;
        }

        echo "<h3>Hasil Penilaian</h3>";
        echo "<p>Nilai Huruf: $nilai</p>";
        echo "<p>Predikat: $predikat</p>";
        echo "<p>Keterangan: $keterangan</p>";
    }
    ?>
</body>

</html>