<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Table</title>
</head>
<body>
    <?php 
    $no = array(1,2,3,4,5);
    $namanya = array("Kansha", "Ganesa", "Sasa", "Zora", "Bintang");
    $jabatannya = array("Staff", "Direktur", "Manager", "Sekertaris", "Staf");
    $statusnya = array("aktif", "aktif", "tidak aktif", "aktif", "aktif");

    echo "<table border='1' width='300'>";
    echo "<tr>";
    echo "<th>Nomor</th>";
    echo "<th>Nama</th>";
    echo "<th>Jabatan</th>";
    echo "<th>Status</th>";
    echo "</tr>";

    for ($i=0; $i < count($no); $i++) { 
        echo "<tr>";
        echo "<td>{$no[$i]}</td>";
        echo "<td>{$namanya[$i]}</td>";
        echo "<td>$jabatannya[$i]</td>";
        echo "<td>$statusnya[$i]</td>";
        echo "</tr>";
        }
    echo "</table>";

    ?>
</body>
</html>