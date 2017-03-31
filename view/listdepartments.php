<?php
/**
 * Created by PhpStorm.
 * User: Myron Williams
 * Date: 1/29/2017
 * Time: 7:13 PM
 */
require_once('../model/mainModel.php');



if(isset($_POST["newDep"])){
    insertDep($_POST["name"]);
}

if(isset($_POST["delete"])){
    deleteDep($_POST["depID"]);
}

if(isset($_POST["updateDep"])){
    updateDep($_POST["depID"], $_POST['updateName']);
}

// Get All from department
$departments = getAllDepartments();

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>List of Departments</title>
</head>
<body>

<h1>University Courses Manager</h1>
    <h2>Department List</h2>

    <table>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>

        <?php foreach ($departments as $department): ?>
                <tr>
                    <td><?php echo $department['departmentName'] ?></td>
                    <td>
                        <?php $getID = $department['departmentID']; ?>
                        <form action="listdepartments.php" method="post">
                            <input type="submit" value="Delete" name="delete">
                            <input type="hidden" name="depID" value="<?php echo $getID?>">
                        </form>
                    </td>
                    <td>
                        <form action="department_update_from.php" method="post">
                            <input type="submit" value="Update" name="update">
                            <input type="hidden" name="depName" value="<?php echo $department['departmentName']; ?>">
                            <input type="hidden" name="depID" value="<?php echo $getID; ?>">
                        </form>



                    </td>
                </tr>

        <?php endforeach; ?>
    </table>
    <h2>Add Department</h2>
    <form action="listdepartments.php" method="post">
        <?php $newID = $department['departmentID']; ?>
        <input type="text" name="name">
        <input type="submit" value="Add" name="newDep">
    </form>
    <br>
    <br>
    <a href="manager_home.php">List Courses</a>
</body>
</html>
