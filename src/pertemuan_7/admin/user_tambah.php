<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-
scale=1.0">
    <title>Halaman Tambah Data</title>
</head>

<body>
    <?php
        include "cek_login.php";
        include "header.php";
    ?>

    <div class="container">
        <h3>Menambah Data User</h3>
        <form action="user_tambah_action.php" method="POST">
            <table>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><input type="text" name="full_name"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <input type="submit" name="simpan"
                            value="simpan">
                        <input type="reset" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>