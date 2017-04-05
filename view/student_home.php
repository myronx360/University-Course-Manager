<?php
/**
 * HW # 5
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/23/2017
 * Time: 4:57 PM
 */
session_start();
require_once('../model/mainModel.php');
$errmsg = "Wrong user type must be a student";
if(isset($_SESSION['userType'])) {
    if ($_SESSION['userType'] != 'student') {
        $_SESSION['ERRMSG'] = $errmsg;
        header("Location:login.php");
    }
} else {
    $errmsg = "Must be logged in";
    $_SESSION['ERRMSG'] = $errmsg;
    header("Location:login.php");
}


if(isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    $name = getUserInfoByID($userID, "firstName");


    $department_id = getUserInfoByID($userID, "deptID");
    $department_name = getDepartmentName($department_id);
    $courses = getCrsWithDepID($department_id);

    $regCourses = getAllRegCrsWithUserID($userID);
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Page</title>
    <link rel="stylesheet" href="../main.css" type="text/css">
</head>
<body>
<h1>Student Page</h1>
<h1>Welcome Back <?php echo $name?>!</h1>

<main>
    <h1>University Courses Manager</h1>
    <section>
        <?php echo $department_name; ?>
        <table>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Credits</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($courses as $course) :?>
                <tr>
                    <td><?php echo $course['crs_code'] ?> </td>
                    <td><?php echo $course['crs_title'] ?> </td>
                    <td><?php echo $course['crs_credits'] ?> </td>
                    <td><?php echo $course['crs_description'] ?> </td>
                    <td>
                        <?php if (getRegCrsWithUserIDAndCrsID($userID, $course['crs_ID']) > 0){ ?>
                            <form action="registered_Courses.php" method="post">
                                <input type="submit" name="register" value="Register" disabled>
                                <input type="hidden" name="crsID" value="<?php echo $course['crs_ID']; ?>">
                            </form>
                        <?php }else{ ?>
                            <form action="registered_Courses.php" method="post">
                                <input type="submit" name="register" value="Register">
                                <input type="hidden" name="crsID" value="<?php echo $course['crs_ID']; ?>">
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </section>
    <footer>
        <a href="registered_Courses.php">See Registered Courses</a>
    </footer>
    <form action="logout.php" method="post">
        <button type="submit">LogOut</button>
    </form>
</main>
</body>
</html>

