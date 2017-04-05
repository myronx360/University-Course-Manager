<?php
/**
 * Created by PhpStorm.
 * User: Myron Williams
 * Date: 3/20/17
 * Time: 4:21 PM
 */
session_start();
require_once('../model/mainModel.php');
$errmsg = "Wrong user type must be a manager";
if(isset($_SESSION['userType'])) {
    if ($_SESSION['userType'] != 'manager') {
        $_SESSION['ERRMSG'] = $errmsg;
        header("Location:login.php");
    }
} else {
    $errmsg = "Must be logged in";
    $_SESSION['ERRMSG'] = $errmsg;
    header("Location:login.php");
}

if(isset($_SESSION['userID']))
    $userID = $_SESSION['userID'] ;

if(isset($_POST["addCourse"])){
echo "1. ".$_POST['depID'];
echo "3. ".$_POST['department'];
    $depName = $_POST['department'];
    $code = $_POST['code'];
    $title = $_POST['Title'];
    $credits = $_POST['Credits'];
    $department_id = $_POST['depID'];
    $description = $_POST['description'];

    insertCrs($code, $title, $credits, $department_id, $description);
}
// Get department ID
$department_id = filter_input(INPUT_GET, 'department_id', FILTER_VALIDATE_INT);
if ($department_id == NULL || $department_id == FALSE) {
    $department_id = 1;
}

// Get name for selected department
$department_name = getDepartmentName($department_id);
// Get courses with selected department id
$courses =  getCoursesWithDepID($department_id);
// Get All from department
$departments = getAllDepartments();
$name = getUserInfoByID($userID, "firstName");

if (isset($_POST["updateCrs"])) {
    updateCrs($_POST['crsID'], $_POST['code'], $_POST['Title'], $_POST['Credits'], $_POST['description']);
}
if(isset($_POST["delete"])){
    deleteCrs($_POST['crsID']);
}



?>
<html>
<head>
    <title>Manager Page</title>
    <link rel="stylesheet" href="../main.css" type="text/css">
</head>
<body>
<main>
<h1>Manager Page</h1>
<h1>Welcome <?php echo $name?>!</h1>
<aside>
    <h2>Courses List</h2>
    <h3>Departments</h3>
    <nav>
        <ul>
            <?php foreach ($departments as $department) :?>
                <li>
                    <a href="?department_id=<?php echo $department['departmentID']; ?>">
                        <?php echo $department['departmentName']; ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </nav>
</aside>
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
                    <form action="manager_home.php" method="post">
                        <input type="submit" name="delete" value="Delete">
                        <input type="hidden" value="<?php echo $course['crs_ID'] ?>" name="crsID">
                    </form>
                </td>
                <td>
                    <form action="course_update_from.php" method="post">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value="<?php echo $course['crs_ID'] ?>" name="crsID">
                        <input type="hidden" value="<?php echo $department_name; ?>" name="depName">
                    </form>
                </td>

            </tr>
        <?php endforeach ?>
    </table>
</section>
<footer>
    <a href="addcourses.php">Add Courses</a>
    <br>
    <a href="listdepartments.php">List Departments</a>
    <br>
    <form action="logout.php" method="post">
        <button type="submit">LogOut</button>
    </form>
</footer>
</main>
</body>
</html>

