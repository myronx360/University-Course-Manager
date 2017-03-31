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




?>
<html>
<head>
    <title>Add Courses</title>
</head>
<body>
<h1>University Courses Manager</h1>
<h2>Add Course</h2>
<form action="manager_home.php" method="post">
    <table>
        Department<select name="department">
            <?php foreach ($departments as $department) :?>
                     <option name="depID" value="<?php $department_id = $department['departmentID'];?>">
                         <?php echo $department['departmentName']; ?>
                         <?php $department_id = $department['departmentID'];?>
                     </option>
            <?php endforeach; ?>
                  </select><br>
        Code: <input type="text" name="code"><br>
        Title: <input type="text" name="Title"><br>
        Credits: <input type="text" name="Credits"><br>
        Description: <input type="text" name="description"><br>
        <input type="hidden" name="depID" value="<?php echo $department_id; ?>" >
        <input type="submit" value="Add Course" name="addCourse">
    </table>
    <br>
    <br>
    <a href="manager_home.php">List Courses</a>
</form>
</body>
</html>
