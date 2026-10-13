<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Login</title>
</head>

<body>
    <form action="action_login.php" method="POST">
        <h2>Masukkan user & password anda</h2>
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input type="text" name="user">
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <input type="password" name="pass">
                </td>
            </tr>

            <tr>
                <td><input type="submit" value="Login"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
</body>

</html>