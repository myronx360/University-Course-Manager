<?php
/**
 * InClass # HW #
 * UniversityCoursesManager.
 * User: Myron Willams
 * Date: 3/29/2017
 * Time: 10:36 PM
 */
function getAllRegCrs(){
    global $db;
    // select all
    $query = 'SELECT * FROM `reg_courses`
              ORDER BY `reg_courses`.`regID`';
    $statement = $db->prepare($query);
    $statement->execute();
    $crs = $statement->fetchAll();
    $statement->closeCursor();
    return $crs;
}
function getAllRegCrsWithCrsID($crsID){
    global $db;
    // select all
    $query = 'SELECT * FROM `reg_courses`
              WHERE `reg_courses`.`crs_ID` = :crsID
              ORDER BY `reg_courses`.`regID`';
    $statement = $db->prepare($query);
    $statement->bindValue(':departmentID', $crsID);
    $statement->execute();
    $crses = $statement->fetchAll();
    $statement->closeCursor();
    return $crses;
}
function getAllRegCrsWithUserID($userID){
    global $db;
    // select all
    $query = 'SELECT * FROM `reg_courses`
              WHERE `reg_courses`.`userID` = :userID';
    $statement = $db->prepare($query);
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    $crs = $statement->fetchAll();
    $statement->closeCursor();
    return $crs;
}

function getRegCrsWithUserIDAndCrsID($userID, $crsID){
    global $db;
    // select all
    $query = 'SELECT * FROM `reg_courses`
              WHERE `reg_courses`.`userID` = :userID AND `reg_courses`.`crs_ID` = :crsID' ;
    $statement = $db->prepare($query);
    $statement->bindParam(':userID', $userID);
    $statement->bindParam(':crsID', $crsID);
    $statement->execute();
    $crs = $statement->fetch();
    $statement->closeCursor();
    return $crs;
}

function insertRegCrs($courseID){
    global $db;

    $query = "INSERT INTO `reg_courses`(`crs_ID`) 
              VALUES (:newCrs)";
    $statement = $db->prepare($query);
    $statement->bindParam(':newCrs', $courseID);
    $statement->execute();
}

function insertRegCrsWithUser($courseID,$user){
    global $db;

    $query = "INSERT INTO `reg_courses`(`crs_ID`, `userID`) 
              VALUES (:newCrs, :newUser)";
    $statement = $db->prepare($query);
    $statement->bindParam(':newCrs', $courseID);
    $statement->bindParam(':newUser', $user);
    $statement->execute();
}

function deleteRegCrs($crsID, $userID){
    global $db;

    $query = "DELETE FROM `reg_courses` 
              WHERE `reg_courses`.`crs_ID` = :crsID AND `reg_courses`.`userID` = :userID";
    $statement = $db->prepare($query);
    $statement->bindParam(':crsID', $crsID);
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    
}