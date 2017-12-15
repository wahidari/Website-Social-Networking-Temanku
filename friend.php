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
    // ambil daftar teman di database
    // global $friend;
    function friendlist () {
        $friend=[];
        global $db, $userlogin;
        $sql = "SELECT berteman.PEN_EMAIL FROM berteman WHERE berteman.EMAIL = :email
        UNION
        SELECT berteman.EMAIL FROM berteman WHERE berteman.PEN_EMAIL = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $userlogin);
        $stmt->execute();
        foreach ($stmt as $col) {
            $friend[] = $col['PEN_EMAIL'];
        }
        return $friend;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Teman | Temanku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/friend.css">
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
<?php
    $la = friendlist();
    if (!empty($la)) {
        foreach ($la as $key) {// ambil profil lengkap teman
            $sql = "SELECT * FROM pengguna WHERE email = :emailteman";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':emailteman', $key);
            $stmt->execute();
            foreach ($stmt as $col) {?>
                <div class="listteman">
                    <div class="foto">
                        <img src="img/b.png" alt="">
                    </div>
                    <div class="tentang">
                        <h3><?php echo $col['FULLNAME']; ?></h3>
                        <p>@<?php echo $col['USERNAME']; ?></p>
                        <form action="profilteman.php" method="post">
                            <input type="hidden" name="emailteman" value="<?php echo $col['EMAIL']; ?>">
                            <input type="submit" value="Lihat Profil" name="lihatprofil">
                        </form>
                    </div>
                </div>
                <?php
            }
        }
    }
    else {
        echo "<p> Anda Belum Memiliki Teman</p><a class=\"link\" href=\"search.php\">Cari Teman</a>";
    }
?>
<a href="#"></a>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
