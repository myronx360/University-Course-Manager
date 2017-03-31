<?php
/**
 * Created by PhpStorm.
 * User: Myron Williams
 * Date: 3/20/17
 * Time: 4:15 PM
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/mainModel.php');


//insertUser($userName, $email, $password, $firstName, $lastName, $role, $deptID, $gender)
//insertUser("bob", "bob@gmail.com", "Strong123!", "Bobby", "Hill", "student", 1, "Male");
//insertUser("propane", "pro@gmail.com", "123", "Hank", "Hill", "manager", 2, "Male");
//insertUser("mspeggy", "peg@gmail.com", "abc", "Peggy", "Hill", "student", 3, "Female");

$user = filter_input(INPUT_POST, 'uname');
$password = filter_input(INPUT_POST, 'psw');
//echo $user." : ". $password;
$host  = $_SERVER['HTTP_HOST'];
//print_r($_POST) ;
// query
$result = $db->prepare("SELECT * FROM `user` WHERE `userName`= :userName AND `password`= :password");
$result->bindParam(':userName', $user);
$result->bindParam(':password', $password);
$result->execute();
$rows = $result->fetch();
if($rows > 0) {
    $_SESSION['userName'] = $rows['userName'];
    $_SESSION['userType'] = $rows['role'];
    $_SESSION['userID'] = $rows['userID'];

    if ($rows['role'] == 'manager') {
        header("location: manager_home.php");
//        exit();
    } elseif ($rows['role'] == 'student') {
        header("location: student_home.php");
//        exit();
    } else{
//        header("location: student_home.php");
//        exit();
        $errmsg = "Wrong user type";
        session_write_close();
        header("location: index.php");
//        exit();
    }
} else{
    $errmsg = 'Username and Password are not found';

}
if(isset($errmsg)) {
    $_SESSION['ERRMSG'] = $errmsg;
//    session_write_close();
    header("location: index.php");
//    exit();
}
?>