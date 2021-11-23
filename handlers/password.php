<?php
require_once("./db/config.php");


if (isset($_POST["submit"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_EMAIL);
    extract($POST);

    try {
        $stmt = $conn->query("SELECT * FROM `login` WHERE `email` = '$email'");
        $stmt->execute();

        if ($stmt->rowCount() < 1) {
            header("location: ../password-recovery.php?alert=no_u");
            exit();
        }

        $id = rand(100000, 9999999);
        $pin = rand(1000000, 99999999);

        $sql = $conn->query("SELECT * FROM `forgot_password` WHERE `pass_id` = '$id' AND `email` = '$email'");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            header("location: location: ../password-recovery.php?pin_verify");
            exit();
        }

        $query = "INSERT INTO `forgot_password`(`pass_id`, `email`, `pin`) 
    VALUES (:id, :email, :pin)";
        $result = $conn->prepare($query);
        $result->execute([
            "id" => $id,
            "email" => $email,
            "pin" => $pin
        ]);

        if ($result) {
            session_start();
            $_SESSION["pass_id"] = $id;

            $file = "text.txt";
            $handle = fopen($file, "a+");
            fwrite($handle, $pin . "\n");
            fclose($handle);

            // Mail Function
            // $subject = "Reset Pin";
            // $message = "Your Reset Pin is: \n {$pin}";
            // mail($email, $subject, $message);

            header("location: ../password-recovery.php?pin_verify");
        }
    } catch (PDOException $e) {
        header("location: ../password-recovery.php?alert=e");
    }
}

if (isset($_POST["verify"])) {
    session_start();
    $id = $_SESSION["pass_id"];

    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $query = "SELECT * FROM `forgot_password` WHERE `pass_id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    if ($pin == $row["pin"]) {
        header("location: ../password-recovery.php?recovery");
    } else {
        header("location: ../password-recovery.php?pin_verify&alert=p_e");
    }
}

if (isset($_POST["change"])) {
    session_start();
    $id = $_SESSION["pass_id"];
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    print_r($POST);
    $password = password_hash($password1, PASSWORD_DEFAULT);

    try {
        $query = "UPDATE `login` SET `password` = :password WHERE `id` = :id";
        $result = $conn->prepare($query);
        $result->execute([
            "password" => $password,
            "id" => "ADMIN"
        ]);

        if ($result) {
            session_start();
            session_destroy();

            $stmt = $conn->query("DELETE FROM `forgot_password` WHERE `pass_id` = '$id'");
            $stmt->execute();
            if ($stmt) {
                header("location: ../index.php?alert=p_r");
            }
        }
    } catch (PDOException $e) {
        header("location: ../password-recovery.php?recovery&alert=e");
    }
}



// Cancel

if (isset($_GET["cancel"])) {
    session_start();
    $pass_id = $_SESSION["pass_id"];

    $query = "DELETE FROM `forgot_password` WHERE `id` = ?";
    $result = $conn->prepare($query);
    $result->execute([$pass_id]);

    if ($result) {
        session_destroy();
        header("location: ../index.php");
    }
}
