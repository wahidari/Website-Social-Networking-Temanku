<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 3:14
# @Copyright: (c) wahidari 2017
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Masuk | Temanku</title>

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
</head>
<body>
    <div class="background">
        <div class="menu">
            <!-- BRAND LOGO -->
            <p class="logo">TEMANKU</p>

        </div>
        <div class="login">
            <div class="headform">
                <h3 class="center">Masuk</h3>
            </div>
            <form method="POST" action="validasi/validasi_login.php">
                <!-- username -->
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your email.." value="<?= @$_GET['email'] ?>" >
                <p class="error"><?= @$_GET['emailError'] ?></p>
                <!-- password -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password.." value="<?= @$_GET['password'] ?>" >
                <p class="error"><?= @$_GET['passwordError'] ?></p>

                <p class="<?php if (empty(@$_GET['class'])) {echo "error";} else { echo $_GET['class'];} ?>"><?= @$_GET['message'] ?></p>
                <!-- button -->
                <input type="submit" value="Masuk" name="masuk">
                <p>Belum Punya Akun ? Silahkan <a href="register.php">Daftar</a></p>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
