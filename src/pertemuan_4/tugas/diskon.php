<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dikonnn</title>
</head>

<body>
    <p><b>Hitung Diskon</b></p>

    <form action="diskon.php" method="POST">
        <table>
            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td>
                    <input type="number" name="harga" placeholder="Masukkan Harga Satuan">
                </td>
            </tr>
            <tr>
                <td>Jumlah Barang</td>
                <td>:</td>
                <td>
                    <input type="number" name="jumlah" placeholder="Masukkan Jumlah Barang">
                </td>
            </tr>
            <tr>
                <td>Member?</td>
                <td>:</td>
                <td>
                    <input type="checkbox" name="member" value="member_true">Ya
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Submit</button>
                    <button type="reset">Batal</button>
                </td>
            </tr>
        </table>
    </form>

    <br>

    <?php

    function formatCurrency($amount) {
        return "Rp " . number_format($amount, 0, ',', '.');
    }

    if (isset($_POST['harga']) && isset($_POST['jumlah'])) {
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $member = isset($_POST['member']) ? true : false;

        $totalPembelian = $harga * $jumlah;
        $diskon = 0;

        if ($member) {
            if ($totalPembelian >= 100000) {
                $diskon = 0.2 * $totalPembelian;
            } else {
                $diskon = 0.1 * $totalPembelian;
            }
        } else {
            if ($totalPembelian >= 100000) {
                $diskon = 0.1 * $totalPembelian;
            }
        }

        $totalBayar = $totalPembelian - $diskon;
        $isMember = $member ? "<b>Kamu Member!</b>" : "Bukan Member";

        echo "<b>Total Pembayaran adalah</b>" . "<br>";
        echo "<table>";
        echo "    <tr>";
        echo "        <td>Harga Satuan</td>";
        echo "        <td>:</td>";
        echo "        <td>" . formatCurrency($harga) . "</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Jumlah Barang</td>";
        echo "        <td>:</td>";
        echo "        <td>$jumlah</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Member</td>";
        echo "        <td>:</td>";
        echo "        <td>$isMember</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Total Pembelian</td>";
        echo "        <td>:</td>";
        echo "        <td>" . formatCurrency($totalPembelian) . "</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Diskon</td>";
        echo "        <td>:</td>";
        echo "        <td>-" . formatCurrency($diskon) . "</td>";
        echo "    </tr>";
        echo "    <tr>";
        echo "        <td>Total Bayar</td>";
        echo "        <td>:</td>";
        echo "        <td>" . formatCurrency($totalBayar) . "</td>";
        echo "    </tr>";
        echo "</table>";
    }
    ?>
</body>

</html>