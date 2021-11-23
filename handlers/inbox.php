<?php

require_once("./db/config.php");

if (isset($_POST["submit"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);
    $id = rand(1000, 100000);

    $sql = "INSERT INTO `counter`(`message_id`) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt) {
        $query = "INSERT INTO `inbox`(`message_id`, `sender`, `email`, `message`) VALUES (:id, :sender,:email, :message)";

        $result = $conn->prepare($query);
        $result->execute([
            'id' => $id,
            'sender' => $sender,
            'email' => $email,
            'message' => $message
        ]);

        if ($result) {
            //header("location: ../../");
        } else {
            //header("location: ../../");
        }
    } else {
        //header("location: ../../");
    }
}


/****************************** DELETE ***************************/
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $query = "DELETE FROM `inbox` WHERE `message_id` = ?";
    $result = $conn->prepare($query);
    $result->execute([$id]);

    if ($result) {
        header("location: ../inbox.php?alert=md_s");
    } else {
        header("location: ../inbox.php?alert=e");
    }
}


/****************** Truncate ******************** */

if (isset($_GET["empty"])) {
    $query = "TRUNCATE `inbox`";
    $result = $conn->prepare($query);
    $result->execute();

    if ($result) {
        header("location: ../settings.php?et_s");
    }
}
