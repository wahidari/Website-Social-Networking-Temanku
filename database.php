<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "social";

try {
    //create PDO connection
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
// ambil data dari user yang login
function logged_user () {
    global $db, $userlogin, $username, $fullname, $address, $email, $phone;
    $sql = "SELECT * FROM pengguna WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $userlogin);
    $stmt->execute();
    foreach ($stmt as $col) {
        $fullname = $col['FULLNAME'];
        $username = $col['USERNAME'];
        $address  = $col['ADDRESS'];
        $email    = $col['EMAIL'];
        $phone    = $col['PHONE'];
    }
}
