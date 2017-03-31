<?php
/**
 * Created by PhpStorm.
 * User: aaljarra
 * Date: 3/20/17
 * Time: 5:43 PM
// */
session_start();
unset($_SESSION['userName']);
unset($_SESSION['userType']);
unset($_SESSION['userID']);
unset($_SESSION['ERRMSG']);
session_destroy() ;
header("Location:index.php");
?>