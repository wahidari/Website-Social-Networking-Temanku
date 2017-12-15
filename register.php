<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 3:14
# @Copyright: (c) wahidari 2017
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar | Temanku</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
</head>
<body>
    <div class="background">
        <div class="menu">
            <!-- BRAND LOGO -->
            <p class="logo">TEMANKU</p>

        </div>
        <div class="register">
            <div class="headform">
                <h3 class="center">Daftar</h3>
            </div>
            <form method="POST" action="validasi/validasi_register_editprofil.php">
                <!-- Username -->
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Your username.." value="<?= @$_GET['username'] ?>">
                <p class="error"><?= @$_GET['usernameError'] ?></p>
                <!-- Fullname -->
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Your fullname.." value="<?= @$_GET['fullname'] ?>">
                <p class="error"><?= @$_GET['fullnameError'] ?></p>
                <!-- Address -->
                <label for="fullname">Address</label>
                <input type="text" id="address" name="address" placeholder="Your address.." value="<?= @$_GET['address'] ?>">
                <p class="error"><?= @$_GET['addressError'] ?></p>
                <!-- Email -->
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your email.." value="<?= @$_GET['email'] ?>">
                <p class="error"><?= @$_GET['emailError'] ?></p>
                <!-- phone -->
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Your phone.." value="<?= @$_GET['phone'] ?>">
                <p class="error"><?= @$_GET['phoneError'] ?></p>
                <!-- Password -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password.." value="<?= @$_GET['password'] ?>">
                <p class="error"><?= @$_GET['passwordError'] ?></p>
                <!-- Confirm Password -->
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Your confirm password.." value="<?= @$_GET['confirmpassword'] ?>">
                <p class="error"><?= @$_GET['confirmpasswordError'] ?></p>

                <p class="error"><?= @$_GET['message'] ?></p>
                <!-- button -->
                <input type="submit" value="Daftar" name="daftar">
                <p>Sudah Punya Akun ? Silahkan <a href="login.php">Masuk</a></p>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
