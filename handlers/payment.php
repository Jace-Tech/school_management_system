<?php

require_once("./db/config.php");
require_once("../functions/index.php");

if(isset($_GET["a_id"])):
    $id = $_GET["a_id"];
    $status = "paid";

    $query = "UPDATE `payment_status` SET `status` = :status WHERE `payment_id` = :id";
    $result = $conn->prepare($query);
    $result->execute([
        "status" => $status,
        "id" => $id
    ]);

    if($result) header("location: ../payment_view.php");
endif;

if(isset($_GET["d_id"])):
    $id = $_GET["d_id"];
    $status = "not paid";

    $query = "UPDATE `payment_status` SET `status` = :status WHERE `payment_id` = :id";
    $result = $conn->prepare($query);
    $result->execute([
        "status" => $status,
        "id" => $id
    ]);

    if($result) header("location: ../payment_view.php");
endif;