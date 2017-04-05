<?php
/**
 * Created by PhpStorm.
 * User: Myron Williams
 * Date: 1/29/2017
 * Time: 7:13 PM
 */


require_once('../model/mainModel.php');

// Get All from department
$departments = getAllDepartments();

$crsID = $_POST['crsID'];
$name = $_POST['depName'];
$course = getCrsWithID($crsID);


?>
<html>
<head>
    <title>Course Department</title>

    <link rel="stylesheet" href="../main.css" type="text/css">
</head>
<body>
<h1>University Courses Manager</h1>
<h2>Course Department</h2>
<form action="manager_home.php" method="post">
    <table>
        Department<select name="department">
            <?php foreach ($departments as $department) :?>
                <?php if($department['departmentName'] == $name) { ?>
                <option selected>
                    <?php echo $department['departmentName']; ?>
                    <?php $department_id = $department['departmentID'];?>
                </option>
                <?php }else{ ?>
                    <option>
                        <?php echo $department['departmentName']; ?>
                        <?php $department_id = $department['departmentID'];?>
                    </option>
                <?php } ?>
            <?php endforeach; ?>
        </select><br>
        Code: <input type="text" name="code" value="<?php echo $course['crs_code']; ?>"><br>
        Title: <input type="text" name="Title"  value="<?php echo $course['crs_title']; ?>"><br>
        Credits: <input type="text" name="Credits"  value="<?php echo $course['crs_credits']; ?>"><br>
        Description: <input type="text" name="description"  value="<?php echo $course['crs_description']; ?>"><br>
    <input type="hidden" name="crsID" value="<?php echo $crsID ?>" >
    <input type="submit" value="Update Course" name="updateCrs">
</form>
<br>
<br>
<a href="manager_home.php">View Course List</a>
</body>
</html>
