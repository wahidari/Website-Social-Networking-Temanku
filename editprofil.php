<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php
    require_once("auth.php");
    require_once("database.php");
    // ambil data user di database.php
    logged_user ();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profil | Temanku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profil.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
</head>

<body>
    <!-- TOP MENU -->
    <div class="menu">
        <!-- BRAND LOGO -->
        <a class="logo" href="index.php">TEMANKU</a>
        <!-- RIGHT MENU -->
        <div class="menuright">
            <a href="index.php">Beranda</a>
            <a href="search.php">Cari Teman</a>
            <a href="friend.php">Daftar Teman</a>
            <a href="profil.php">Profil</a>
            <a href="logout.php">Keluar</a>
        </div>
    </div>
    <!-- MAIN CONTENT -->
    <div class="row">
        <!-- KOLOM KANAN -->
        <div class="column right">
            <div class="profil">
                <h2><?php echo $fullname; ?></h2>
                <img src="img/a.png" alt="">
                <p>@<?php echo $username; ?></p>
            </div>
        </div>
        <!-- KOLOM KIRI -->
        <div class="column left">
            <!-- LIST TEMAN -->
            <div class="profilku">
                <div class="foto">
                    <img src="img/a.png" alt="">
                </div>

                <div class="formeditprofil">
                    <form method="POST" action="validasi/validasi_register_editprofil.php">
                        <!-- Username -->
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Your new username.." value="<?php if(empty($_GET['username'])){echo $username;} else {echo $_GET['username'];}?>">
                        <p class="error"><?= @$_GET['usernameError'] ?></p>
                        <!-- Fullname -->
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Your new fullname.." value="<?php if(empty($_GET['fullname'])){echo $fullname;} else {echo $_GET['fullname'];}?>">
                        <p class="error"><?= @$_GET['fullnameError'] ?></p>
                        <!-- Address -->
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Your new address.." value="<?php if(empty($_GET['address'])){echo $address;} else {echo $_GET['address'];}?>">
                        <p class="error"><?= @$_GET['addressError'] ?></p>
                        <!-- Email -->
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>
                        <p class="error"><?= @$_GET['emailError'] ?></p>
                        <!-- phone -->
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="Your phone.." value="<?php if(empty($_GET['phone'])){echo $phone;} else {echo $_GET['phone'];}?>">
                        <p class="error"><?= @$_GET['phoneError'] ?></p>
                        <!-- Password -->
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your new password.." value="<?= @$_GET['password'] ?>">
                        <p class="error"><?= @$_GET['passwordError'] ?></p>
                        <!-- Confirm Password -->
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Your confirm password.." value="<?= @$_GET['confirmpassword'] ?>">
                        <p class="error"><?= @$_GET['confirmpasswordError'] ?></p>
                        <p class="error"><?= @$_GET['message'] ?></p>
                        <!-- button -->
                        <input type="submit" value="Edit Profil" name="editprofil">
                        <p class="note">* untuk edit profil anda harus mengganti username</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
