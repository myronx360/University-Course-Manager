<?php
/**
 * InClass # HW #
 * UniversityCoursesManager.
 * User: Myron Williams
 * Date: 3/30/2017
 * Time: 1:54 PM
 */


// select course of the ID
function getCrsWithID($crsID){
    global $db;
    // select all
    $query = 'SELECT * FROM `courses`
              WHERE `courses`.crs_ID = :crsID';
    $statement = $db->prepare($query);
    $statement->bindValue(':crsID', $crsID);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    return $course;
}
// select course of the ID
function getCrsWithDepID($depID){
    global $db;
    // select all
    $query = 'SELECT * FROM `courses`
              WHERE `courses`.dep_ID = :depID';
    $statement = $db->prepare($query);
    $statement->bindParam(':depID', $depID);
    $statement->execute();
    $course = $statement->fetchAll();
    $statement->closeCursor();
    return $course;
}
function getCoursesWithDepID($department_id){
    global $db;
    // Get courses with selected department id
    $queryCoursesByDepID = 'SELECT * FROM courses
                        where dep_id = :department_id
                        ORDER BY dep_id';
    $statement2 = $db->prepare($queryCoursesByDepID);
    $statement2->bindValue(':department_id', $department_id);
    $statement2->execute();
    $courses = $statement2->fetchAll();
    $statement2->closeCursor();
    return $courses;
}

function getCourseInfoByID($crsID, $info){
    global $db;
    // select book with bookID
    $query = 'SELECT * FROM `courses`
              WHERE `crs_ID` = :crs_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':crs_id', $crsID);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    $course_info = $course[$info];
    return $course_info;
}

function deleteCrs($crsID){
    global $db;
//    // delete course from reg_courses
    $query1 = "DELETE FROM `reg_courses`
              WHERE `reg_courses`.`crs_ID` = :crsID";
    $statement1 = $db->prepare($query1);
    $statement1->bindParam(':crsID', $crsID);
    $statement1->execute();

    // delete course from courses
    $query = "DELETE FROM `courses`
              WHERE `courses`.`crs_ID` = :crsID";
    $statement = $db->prepare($query);
    $statement->bindParam(':crsID', $crsID);
    $statement->execute();



}

function updateCrs($crsID, $code, $title, $Credits, $description){
    // update a crs in courses table

        global $db;

        $query = "UPDATE `courses` 
              SET `crs_code`=:newCode,`crs_title`=:newTitle,`crs_credits`=:newCredits, `crs_description`=:newDes
              WHERE `crs_ID`=:newID";
        $statement = $db->prepare($query);
        $statement->bindParam(':newID', $crsID);
        $statement->bindParam(':newCode', $code);
        $statement->bindParam(':newTitle', $title);
        $statement->bindParam(':newCredits', $Credits);
        $statement->bindParam(':newDes', $description);
        $statement->execute();
}

function insertCrs($code, $title, $credits, $depID, $description){
    global $db;
    // add new Crs

    $queryInsertCourse = 'INSERT INTO `courses`(`crs_code`, `crs_title`, `crs_credits`, `dep_id`, `crs_description`) 
                               VALUES (:crs_code, :crs_title, :crs_credits, :dep_id, :crs_description)';
    $InsertCourseStatement1 = $db->prepare($queryInsertCourse);
    $InsertCourseStatement1->bindParam(':crs_code',$code);
    $InsertCourseStatement1->bindParam(':crs_title', $title);
    $InsertCourseStatement1->bindParam(':crs_credits',$credits );
    $InsertCourseStatement1->bindParam(':dep_id', $depID);
    $InsertCourseStatement1->bindParam(':crs_description',$description);
    $InsertCourseStatement1->execute();
}