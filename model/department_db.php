<?php
/**
 * InClass # HW #
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/29/2017
 * Time: 10:57 PM
 */

function getAllDepartments(){
    global $db;
    // Get All from department
    $queryAllOFDepartment = 'SELECT * FROM department';
    $statement3 = $db->prepare($queryAllOFDepartment);
    $statement3->execute();
    $departments = $statement3->fetchAll();
    $statement3->closeCursor();
    return $departments;
}

function getDepartmentName($departmentID){
    global $db;
// Get name for selected department
    $queryDepartment = 'SELECT * FROM department
                      WHERE departmentID = :department_id';
    $statement1 = $db->prepare($queryDepartment);
    $statement1->bindValue(':department_id', $departmentID);
    $statement1->execute();
    $department = $statement1->fetch();
    $department_name = $department['departmentName'];
    $statement1->closeCursor();
    return $department_name;
}

function updateDep($depID, $name){
    global $db;

    $query = "UPDATE `department` 
              SET `departmentName`=:newName
              WHERE `departmentID` = :depID";
    $statement = $db->prepare($query);
    $statement->bindParam(':depID', $depID);
    $statement->bindParam(':newName', $name);
    $statement->execute();
}

function insertDep($name){
    global $db;

    $query = "INSERT INTO `department`(`departmentName`) 
              VALUES (:newName)";
    $statement = $db->prepare($query);
    $statement->bindParam(':newName', $name);
    $statement->execute();
}

function deleteDep($depID){
    global $db;

    $query = "DELETE FROM `department` 
              WHERE `department`.`departmentID` = :depID";
    $statement = $db->prepare($query);
    $statement->bindParam(':depID', $depID);
    $statement->execute();
}
