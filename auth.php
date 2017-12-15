<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php

session_start();
$userlogin = $_SESSION['user'];
// Jika Belum Login Redirect Ke Index
if(!isset($_SESSION["user"])) header("Location: welcome.php");

?>
