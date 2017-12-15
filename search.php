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
    // inisialisasi tombol cari sudah di klik
    global $cari;

    // ambil daftar teman di database
    // global $friend;
    function friendlist () {
        // ambil data lengkap teman yg dicari
        global $db, $userlogin, $search_email;
        $sql = "SELECT * FROM `pengguna` WHERE USERNAME = :namateman" ;
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':namateman', $_POST['namateman']);
        $stmt->execute();
        foreach ($stmt as $col) {
            $search_email    = $col['EMAIL'];
        }

        // CEK apakah user yang login dan hasil pencarian teman sudah berteman
        $friend=[];
        global $db, $userlogin;
        $sql = "SELECT berteman.PEN_EMAIL FROM berteman WHERE berteman.EMAIL = :email AND berteman.PEN_EMAIL = :search_email
        UNION
        SELECT berteman.EMAIL FROM berteman WHERE berteman.PEN_EMAIL = :email AND berteman.EMAIL = :search_email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $userlogin);
        $stmt->bindValue(':search_email', $search_email);
        $stmt->execute();
        foreach ($stmt as $col) {
            $friend[] = $col['PEN_EMAIL'];
        }
        return $friend;
    }

    // PROSES PENCARIAN NAMA TEMAN
    $success = $eror = "";
    if (isset($_POST['cari']) && $_POST['cari'] == "Cari") {
        // cek apakah inputan kosong dan inputan berupa user yang login
        if(!empty($_POST['namateman']) && $_POST['namateman'] != $username) {
            // cek apakah user yang login sudah berteman dengan hasil pencarian atau belum
            $a = friendlist();
            if(!empty($a)) {
                $success="Anda Sudah Berteman";
            }
            // jika hasil pencarian teman belum berteman maka tampilkan ($cari = true;)
            else {
                $eror = "";
                $sql = "SELECT * FROM `pengguna` WHERE USERNAME = :namateman" ;
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':namateman', $_POST['namateman']);
                $stmt->execute();
                // jika username tidak ditemukan tampilkan pesan
                if ($stmt->rowCount() < 1) {
                    $eror="Username Tidak Ditemukan !";
                }
                // jika username ditemukan dan user yang login belum berteman tampilkan hasi pencarian
                else {
                    $cari = true;
                }
            }
        }
        // input kosong
        elseif (empty($_POST['namateman'])) {
            $eror="Username Tidak Boleh Kosong !";
        }
        // inputan username yang login
        else {
            $eror="Username Invalid !";
        }
    }


    // PROSES Tambahkan TEMAN
    if (isset($_POST['tambahteman']) && $_POST['tambahteman'] == "Tambah Teman") {
        $sql = "INSERT INTO `berteman`(`EMAIL`, `PEN_EMAIL`) VALUES (:email,:emailteman)" ;
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':emailteman', $_POST['emailteman']);
        $stmt->execute();
        $success="berhasil menambahkan teman";
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cari Teman | Temanku</title>
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
            <div class="cariteman">
                <form method="POST">
                    <input type="text" name="namateman" placeholder="username teman">
                    <input type="submit" value="Cari" name="cari">
<?php
                        if (!empty($eror)) {
?>
                            <p class="error"><?php echo $eror;  ?></p>
<?php                   $eror="";}
                        else {

?>
                            <p class="success"><?php echo $success;  ?></p>
<?php                   }
?>
                </form>
            </div>
<?php
                // dijalankan ketika $cari bernilai true // teman ditemukan
                if ($cari){
                    foreach ($stmt as $col) {
?>
                        <!-- LIST TEMAN -->
                        <div class="listteman">
                            <div class="foto">
                                <img src="img/b.png" alt="">
                            </div>
                            <div class="tentang">
                                <h3><?php echo @$col['FULLNAME']; ?></h3>
                                <p>@<?php echo @$col['USERNAME']; ?></p>
                                <form method="post">
                                    <input type="hidden" name="emailteman" value="<?php echo $col['EMAIL']; ?>">
                                    <input type="submit" value="Tambah Teman" name="tambahteman">
                                </form>
                            </div>
                        </div>
<?php
                    }
                }
?>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; TEMANKU 2017</p>
    </div>
</body>
</html>
