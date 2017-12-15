<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php
    require_once("database.php"); // koneksi DB
    require_once("auth.php"); // Session
    // ambil data user di database.php
    logged_user ();
    // jalankan ketika tombol buat status di klik
    if (isset($_POST['buatstatus']) && $_POST['buatstatus'] == "Buat Status") {
        if(!empty($_POST['isistatus'])) {
            $sql = "INSERT INTO status
            (`EMAIL`, `ISI_STATUS`, `TANGGAL_STATUS`) VALUES
            (:email, :isistatus, CURRENT_TIMESTAMP)" ;
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $userlogin);
            $stmt->bindValue(':isistatus', htmlspecialchars($_POST['isistatus']));
            $stmt->execute();
        }
        else {
            $emptystatus = "Status Masih Kosong";
        }
    }
 ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Beranda | Temanku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
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
            <!-- FORM BUAT STATUS -->
            <div class="buatstatus">
                <form method="POST">
                     <textarea name="isistatus" placeholder="Buat Status.."></textarea>
                     <input type="submit" value="Buat Status" name="buatstatus">
                     <p class="emptystatus"><?= @$emptystatus; ?></p>
                </form>
            </div>
<?php
            // ambil status dr user yang login dan status dari masing2 teman dari user yang login
            $sql = "SELECT * FROM status RIGHT JOIN pengguna
            ON status.EMAIL = pengguna.EMAIL
            WHERE status.EMAIL =:email
            OR status.EMAIL IN (SELECT berteman.PEN_EMAIL FROM berteman WHERE berteman.EMAIL =:email)
            OR status.EMAIL IN (SELECT berteman.EMAIL FROM berteman WHERE berteman.PEN_EMAIL =:email)
            ORDER by status.ID_STATUS DESC";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $userlogin);
            $stmt->execute();
            foreach ($stmt as $col) {
                ?>
                <!-- STATUS -->
                <div class="status">
                    <div class="profilstatus">
                        <img src="img/a.png" alt="">
                        <h3><?php echo $col['FULLNAME']; ?></h3>
                        <p>@<?php echo $col['USERNAME'],","; ?></p>
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
