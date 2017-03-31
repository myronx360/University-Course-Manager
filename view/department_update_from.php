<?php
/**
 * Created by PhpStorm.
 * User: Myron Williams
 * Date: 1/29/2017
 * Time: 7:13 PM
 */
require_once('../model/mainModel.php');
$depID = $_POST['depID'];
$name = $_POST['depName'];



?>
<html>
<head>
    <title>Update Department</title>
</head>
<body>
<h1>University Courses Manager</h1>
<h2>Update Department</h2>
<form action="listdepartments.php" method="post">
    Department Name: <input type="text" name="updateName" value="<?php echo $name; ?>" >
    <input type="hidden" name="depID" value="<?php echo $depID ?>" >
    <input type="submit" value="Update Department" name="updateDep">
</form>
<br>
<br>
<a href="listdepartments.php">View Department List</a>
</body>
</html>
