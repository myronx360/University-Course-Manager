<?php
/**
 * HW # 5
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/23/2017
 * Time: 5:19 PM
 */

// TODO: • Add the course to the Table “reg_courses”.
//TODO: • Redirect to another page (registered_Courses.php) showing a
//Table of currently registered courses (See Figure 2 (b)).
//Figure 1: Course Registration

require_once('../model/mainModel.php');



if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    $depID = getUserInfoByID($userID, "deptID");

    if(isset($_POST["register"])) {
        $crsID = $_POST["crsID"];
        insertRegCrsWithUser($crsID, $userID);
    }

    if(isset($_POST['drop'])){
        deleteRegCrs($_POST['dropCrsID'],$userID);
    }
}


// display reg_crs
$regCourses = getAllRegCrsWithUserID($userID);


?>
<!DOCTYPE html>
<html>
<head>
    <title>University Courses Description</title>
    <link rel="stylesheet" href="../main.css" type="text/css">
</head>
<body>
<main>
    <h1><?php echo getUserInfoByID($userID, "firstName").'\'s'; ?> Courses</h1>
<section>
<table>
    <tr>
        <th>Code</th>
        <th>Title</th>
        <th>Credits</th>
        <th>Description</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($regCourses as $regCourse): ?>
        <tr>
            <td><?php echo getCourseInfoByID($regCourse["crs_ID"], 'crs_code'); ?> </td>
            <td><?php echo getCourseInfoByID($regCourse["crs_ID"], 'crs_title'); ?> </td>
            <td><?php echo getCourseInfoByID($regCourse["crs_ID"], 'crs_credits'); ?> </td>
            <td><?php echo getCourseInfoByID($regCourse["crs_ID"], 'crs_description'); ?> </td>
            <td>
                <form action="registered_Courses.php" method="post">
                    <input type="submit" value="Drop" name="drop">
                    <input type="hidden" value="<?php echo $regCourse["crs_ID"]; ?>" name="dropCrsID">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</section>
<footer>
    <a href="student_home.php">Back to Registration</a>
    <form action="logout.php" method="post">
        <button type="submit">LogOut</button>
    </form>
</footer>
</body>
</main>
</html>