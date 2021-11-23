<?php

require_once("./db/config.php");

function check($name)
{
    if (isset($name)) {
        return $name;
    } else {
        return null;
    }
}

/*
 * ============================================================================
 * ************************* BASIC CRUD OPERATION ***********************
 * ============================================================================
 */

/* ******************************** CREATE [Insert] *************************** */
if (isset($_POST["submit"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $course_name = $POST["course-name"];
    $id = rand(1000, 9999);

    $subject1 = check($POST["subject1"]);
    $subject2 = check($POST["subject2"]);
    $subject3 = check($POST["subject3"]);
    $subject4 = check($POST["subject4"]);
    $subject5 = check($POST["subject5"]);
    $subject6 = check($POST["subject6"]);
    $subject7 = check($POST["subject7"]);
    $subject8 = check($POST["subject8"]);
    $subject9 = check($POST["subject9"]);
    $subject10 = check($POST["subject10"]);
    $subject11 = check($POST["subject11"]);
    $subject12 = check($POST["subject12"]);
    $subject13 = check($POST["subject13"]);
    $subject14 = check($POST["subject14"]);

    $subjects = [
        $subject1,
        $subject2,
        $subject3,
        $subject4,
        $subject5,
        $subject6,
        $subject7,
        $subject8,
        $subject9,
        $subject10,
        $subject11,
        $subject12,
        $subject13,
        $subject14
    ];

    $filteredArray = [];

    for ($i = 0; $i < count($subjects); $i++) {
        if ($subjects[$i] == null) {
            continue;
        } else {
            array_push($filteredArray, $subjects[$i]);
        }
    }

    try {
        $query = "INSERT INTO `courses`(`course_id`, `course_name`, `subjects`) VALUES (:id, :name, :subject)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            "id" => $id,
            "name" => $course_name,
            "subject" => json_encode($filteredArray)
        ]);

        if ($stmt) {
            header("location: ../add-course.php?alert=c_a");
        } else {
            header("location: ../add-course.php?alert=e");
        }
    } catch (PDOException $e) {
        echo $e;
    }
}

/* ******************************** EDIT [Update] *************************** */
if (isset($_POST["update"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $course_name = $POST["course-name"];
    $id = $POST["id"];

    $subject1 = check($POST["subject1"]);
    $subject2 = check($POST["subject2"]);
    $subject3 = check($POST["subject3"]);
    $subject4 = check($POST["subject4"]);
    $subject5 = check($POST["subject5"]);
    $subject6 = check($POST["subject6"]);
    $subject7 = check($POST["subject7"]);
    $subject8 = check($POST["subject8"]);
    $subject9 = check($POST["subject9"]);
    $subject10 = check($POST["subject10"]);
    $subject11 = check($POST["subject11"]);
    $subject12 = check($POST["subject12"]);
    $subject13 = check($POST["subject13"]);
    $subject14 = check($POST["subject14"]);

    $subjects = [
        $subject1,
        $subject2,
        $subject3,
        $subject4,
        $subject5,
        $subject6,
        $subject7,
        $subject8,
        $subject9,
        $subject10,
        $subject11,
        $subject12,
        $subject13,
        $subject14
    ];

    $filteredArray = [];

    for ($i = 0; $i < count($subjects); $i++) {
        if ($subjects[$i] == null) {
            continue;
        } else {
            array_push($filteredArray, $subjects[$i]);
        }
    }
    echo $id . "<br>";
    print_r($filteredArray);
    try {
        $query = "UPDATE `courses` SET `course_name` = :name, `subjects` = :subjects WHERE `course_id` = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            "id" => $id,
            "name" => $course_name,
            "subjects" => json_encode($filteredArray)
        ]);

        if ($stmt) {
            header("location: ../all-courses.php?alert=e_s");
        } else {
            header("location: ../all-courses.php?alert=e");
        }
    } catch (PDOException $e) {
        echo $e;
    }
}


/* ******************************** DELETE [Delete] *************************** */
if (isset($_GET["delete_id"])) {
    $id = $_GET["delete_id"];

    $query = "DELETE FROM `courses` WHERE `course_id` = ?";

    try {
        $result = $conn->prepare($query);
        $result->execute([$id]);

        if ($result) {
            header("location: ../all-courses.php?alert=cd_s");
        } else {
            header("location: ../all-courses.php?alert=e");
        }
    } catch (PDOException $e) {
        echo $e;
    }
}

// Truncate

if (isset($_GET["empty"])) {
    try {
        $query = "TRUNCATE `courses`";
        $result = $conn->prepare($query);
        $result->execute();

        if ($result) {
            header("location: ../settings.php?alert=te_s");
        }
    } catch (PDOException $e) {
        header("location: ../settings.php?alert=e");
    }
}
