<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php
    require_once("database.php");
    require_once("auth.php");
    // ambil data user di database.php
    logged_user ();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profil | Temanku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profil.css">
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
                <div class="table">
                    <div class="info">
                        <p>Nama Pengguna</p>
                        <p>Nama Lengkap</p>
                        <p>Alamat</p>
                        <p>Email</p>
                        <p>No Telepon</p>
                    </div>
                    <div class="tentang">
                        <p>@<?php echo $username; ?></p>
                        <p><?php echo $fullname; ?></p>
                        <p><?php echo $address; ?></p>
                        <p><?php echo $email; ?></p>
                        <p><?php echo $phone; ?></p>
                    </div>
                </div>
                <a class="button" href="editprofil.php">Edit Profil</a>
            </div>
<?php
            // ambil status dr user urutkan berdasarkan tanggal terbaru / id teratas
            $sql = "SELECT * FROM status WHERE email = :email ORDER by ID_STATUS desc";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $userlogin);
            $stmt->execute();
            foreach ($stmt as $col) {
                ?>
                <!-- STATUS -->
                <div class="status">
                    <div class="profilstatus">
                        <img src="img/a.png" alt="">
                        <h3><?php echo $fullname; ?></h3>
                        <p>@<?php echo $username,","; ?></p>
                        <p class="tanggalstatus"><?php echo $col['TANGGAL_STATUS']; ?></p>
                    </div>
                    <div class="isistatus">
                        <p><?php echo $col['ISI_STATUS']; ?></p>
                    </div>
                </div>
    <?php        }
?>

        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
