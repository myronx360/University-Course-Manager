<?php
/**
 * InClass # HW #
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/26/2017
 * Time: 8:39 PM
 */

//require_once ('../model/mainModel.php');
//require_once ('../model/logout.php');
session_start();
unset($_SESSION['userName']);
unset($_SESSION['userType']);
unset($_SESSION['userID']);
session_destroy() ;

if(isset($_SESSION['ERRMSG'])) {
    $error_msg = $_SESSION['ERRMSG'];
}
//    echo $error_msg;
//    unset($_SESSION['ERRMSG']);
//    session_destroy() ;

if(isset($_COOKIE["userName"])){
    $username = $_COOKIE["userName"];
    $password =  $_COOKIE["password"];

}else{
    $username = "";
    $password =  "";

}
//}
?>

<!DOCTYPE html>
<html>
<style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }
    .error, .alert, .notice, .success, .info {padding:0.8em;margin-bottom:1em;border:2px solid #ddd;}
    .error, .alert {background:#fbe3e4;color:#8a1f11;border-color:#fbc2c4;}
    .notice {background:#fff6bf;color:#514721;border-color:#ffd324;}
    .success {background:#e6efc2;color:#264409;border-color:#c6d880;}
    .info {background:#d5edf8;color:#205791;border-color:#92cae4;}
    .error a, .alert a {color:#8a1f11;}

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
</style>
<body>

<h2>Login Form</h2>

<?php if(isset($error_msg)) {

    echo "<div class='error'> $error_msg; </div>";
}
 ?>

<form action="login_action.php" method="post">
    <div class="imgcontainer">
        <img src="../img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" value = "<?php echo $username ?>" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $password ?>" required>

        <button type="submit">Login</button>
        <input type="checkbox" checked="checked" name="remember" value="remember"> Remember me
        <span><a href="user_signup_form.php">New User</a></span>
    </div>
</form>
    <div class="container" style="background-color:#f1f1f1">
        <form action="../view/index.php" method="post">
            <button type="submit" class="cancelbtn">Cancel</button>
        </form>
        <span class="psw"> <a href="#">Forgot password?</a></span>
    </div>


</body>
</html>
