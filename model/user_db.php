<?php
/**
 * InClass # HW #
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/29/2017
 * Time: 9:08 PM
 */

// insert new user
function insertUser($userName, $email, $password, $firstName, $lastName, $role, $deptID, $gender){
    global $db;

    $query = "INSERT INTO `user`(`userName`, `email`, `password`, `firstName`,`lastName`,`role`, `deptID`, `gender`) 
              VALUES (:userName, :email, :password, :firstName,:lastName,:role,:deptID,:gender)";
    $statement = $db->prepare($query);
    $statement->bindParam(':userName', $userName);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':firstName', $firstName);
    $statement->bindParam(':lastName', $lastName);
    $statement->bindParam(':role', $role);
    $statement->bindParam(':deptID', $deptID);
    $statement->bindParam(':gender', $gender);
    $statement->execute();
}

function getUserInfoByID($userID, $info){
    global $db;
    // select book with bookID
    $query = 'SELECT * FROM `user`
              WHERE `userID` = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $userID);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    $user_info = $user[$info];
    return $user_info;
}