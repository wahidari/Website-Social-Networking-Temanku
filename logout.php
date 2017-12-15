<?php
# @Author: Wahid Ari <wahidari>
# @Date:   13 October 2017, 3:58
# @Copyright: (c) wahidari 2017

session_start();
unset($_SESSION['user']); // unset user session
header("Location: welcome.php");
?>
