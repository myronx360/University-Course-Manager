<?php
/**
 * HW # 5.
 * User: Myron Williams
 * Date: 2/23/2017
 * Time: 5:09 PM
 */

require_once('../model/mainModel.php');


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

    if(isset($_SESSION['ERRMSG']))
        $error_msg = $_SESSION['ERRMSG'];

if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    echo getUserInfoByID($userID,'firstName');
    $regCourses = getAllRegCrsWithUserID($userID);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>University Courses Description</title>
    <link rel="stylesheet" href="../main.css" type="text/css">
</head>
<body>
<?php if(isset($error_msg)) echo $error_msg; ?>
<main>
    <h1>University Courses Manager</h1>

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
                <?php if(isset($_SESSION['userID'])){ ?>
                <td>
                    <form action="registered_Courses.php" method="post">
                        <input type="submit" name="register" value="Register">
                        <input type="hidden" name="crsID" value="<?php echo $course['crs_ID']; ?>">
                    </form>
                </td>
                <?php }else{ ?>
                    <td>
                        <form action="registered_Courses.php" method="post">
                            <input type="submit" value="Register" disabled>
                            <input type="hidden" name="register" value="<?php echo $course['crs_ID']; ?>">
                        </form>
                    </td>
                <?php } ?>
            </tr>
            <?php endforeach ?>
        </table>
    </section>
    <footer>
        <?php if(isset($_SESSION['userID'])){ ?>
        <a href="registered_Courses.php">See Registered Courses</a>
            <br>
            <form action="logout.php" method="post">
                <button type="submit">LogOut</button>
            </form>
        <?php }else{ ?>
        <form action="../view/login.php" method="post">
            <button type="submit">LogIn</button>
        </form>
        <?php } ?>
    </footer>
    </body>
</main>
</html>
