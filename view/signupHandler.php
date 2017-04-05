<?php
require_once('../model/mainModel.php');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$firstname = filter_input(INPUT_POST, 'firstname');
$email = filter_input(INPUT_POST, 'email');
$confirmpassword = filter_input(INPUT_POST, 'confirmpassword');
$lastname = filter_input(INPUT_POST, 'lastname');
$gender = filter_input(INPUT_POST, 'gender');
$role = filter_input(INPUT_POST, 'role');
$deptID = filter_input(INPUT_POST, 'dept');
$accepted = filter_input(INPUT_POST, 'accepted');

$users = getAllUsers();
$err = 0;

if (isset($username)) {// username overlaps with an existing user
    foreach ($users as $user) {
        if ($user["email"] == $username) {
            $err = 1;
        } else {
            $err = 0;
        }
    }
}


if(!preg_match('/^[a-zA-Z0-9]{4,10}$/',$username)) {
    $err = 2;
}elseif (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\#$!]).*$/", $password)) {//one character from !,#,@.// ^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.#+|!+|@+)(?=.#*+)(?=.*[A-Z]).*$
    $err = 3;
}elseif ($password != $confirmpassword) {
    $err = 4;
}elseif (!preg_match('/^[a-zA-Z]*$/',$firstname.$lastname)) {
    $err = 10;
}elseif (!preg_match('/^\w+@[a-zA-Z0-9_]+?\.(com|edu|net)+$/',$email)) {//FIXME:
    $err = 8;
}elseif (!isset($gender)) {
    $err = 6;
}elseif (!isset($role)) {
    $err = 7;
}elseif (!isset($accepted)) {
    $err = 9;
}else{
    $err = 0;
}

if($err!=0)
    header("location: user_signup_form.php?error=".$err);
else
    insertUser($username, $email, $password, $firstname, $lastname, $role, $deptID, $gender);// insertUser($userName, $email, $password, $firstName, $lastName, $role, $deptID, $gender)
//print_r($_POST);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration Handler</title>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="../screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="../print.css" type="text/css" media="print">
  </head>
  <body>
    <div class="container">
      <h1>Registration Complete</h1>
      <hr>
      <div class="span-3">
      	<br/>
      </div>
      <div class="span-18">
      	<div class="success">
          User successfully registered. <a href="login.php">Login</a>.
        </div>        
      </div>
      <div class="span-3 last">
      	<br/>
      </div>
    </div>
  </body>
</html>
