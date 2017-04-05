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
    echo $rows;
    if ($rows['role'] == 'manager') {
        header("location: manager_home.php");
        rememberMe($user, $password);
//        exit();
    } elseif ($rows['role'] == 'student') {
        header("location: student_home.php");
        rememberMe($user, $password);
//        exit();
    } else{
//        header("location: student_home.php");
//        exit();
        $errmsg = "Wrong user type";
        session_write_close();
        header("location: index.php");
//        exit();
    }
} else if($rows < 0){

//    $errmsg = 'Username and Password are not found';
//    $errmsg = $rows;


}
if(isset($errmsg)) {
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: login.php");
    exit();
}

function rememberMe($user, $password){
    if(isset($_POST["remember"])){
        setcookie('userName' , $user , time()+ 2000 , '/' ) ;
        setcookie('password' , $password , time()+ 2000 , '/' ) ;
    }else{
        setcookie('userName' , '' , time()- 2000 , '/' ) ;
        setcookie('password' , '' , time()- 2000 , '/' ) ;
    }
}
?>