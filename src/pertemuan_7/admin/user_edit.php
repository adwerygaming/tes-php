<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>Halaman Ubah Data</title>
</head>

<body>
    <?php
    include "config.php";

    $user = $_GET['username'];
    $sql = "SELECT*FROM user WHERE username='$user'";

    $hasil = mysqli_query($config, $sql);
    $data = mysqli_fetch_assoc($hasil);

    ?>
    <h3>Ubah Data Username</h3>
    <form action="user_edit_action.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input type="text" value="<?php echo $data['username'] ?>" disabled>
                    <input type="text" name="username" value="<?php echo $data['username'] ?>" hidden>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" value="<?php echo $data['passwd'] ?>"></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="full_name" value="<?php echo $data['full_name'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="email" name="email" value="<?php echo $data['email'] ?>"></td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="submit" name="ubah" value="Simpan">
                    <input type="reset" value="Batal">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>