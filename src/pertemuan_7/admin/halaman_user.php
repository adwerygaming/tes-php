<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-
scale=1.0">
    <title>Data User</title>
    <style>
        table {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <?php
        include "cek_login.php";
        include "header.php";
    ?>

    <div class="container">
        <h3>Data User</h3>
        <p><a class="btn btn-primary" href="user_tambah.php">Tambah User</a></p>
        <table>
            <tr>
                <th> NO </th>
                <th> Username </th>
                <th> Password </th>
                <th> Nama Lengkap </th>
                <th> Email </th>
                <th> Kelola </th>
            </tr>
            <?php
            include "config.php";
            $sql = "SELECT username, passwd, full_name, email FROM user ORDER BY username ASC";
            $hasil = mysqli_query($config, $sql);

            $no = 1;
            while ($data = mysqli_fetch_array($hasil)) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['passwd']; ?></td>
                    <td><?php echo $data['full_name']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td>
                        <a class="btn btn-warning" href="user_edit.php?username=<?php echo $data['username']; ?>">Edit</a> |
                        <a class="btn btn-danger" href="user_hapus.php?username=<?php echo $data['username']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            echo "</table>";
            ?>
    </div>

</body>

</html>