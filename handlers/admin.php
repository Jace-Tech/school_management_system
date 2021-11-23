<?php

require_once("./db/config.php");

if (isset($_POST["update"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $types = ["image/jpg", "image/png", "image/jpeg"];

    if ($_FILES["image"]["size"] > 0) {
        $filename = $_FILES["image"]["name"];

        $rand = time();
        $destination = "../images/teachers/";
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $size = $_FILES["image"]["size"];
        if ($size > 2000000) {
            header("location: ../edit.php?id={$id}&alert=f_l");
            exit();
        }

        $type = $_FILES["image"]["type"];
        if (!array_search($type, $types)) {
            header("location: ../edit.php?id={$id}&alert=f_t");
            exit();
        }

        $file = $_FILES["image"]["tmp_name"];
        $filename .= $rand . "." . $extension;
        $save_image = "images/teachers/" . $filename;

        $moved = move_uploaded_file($file, $destination . $filename);
        if ($moved) {
            $path = "../" . $prev_image;
            if (unlink($path)) {
                try {
                    $query = "UPDATE `login` SET `name` = :name, `email` = :email, `image` = :image WHERE `id` = :id";
                    $result = $conn->prepare($query);
                    $result->execute([
                        "name" => $name,
                        "email" => $email,
                        "image" => $save_image,
                        "id" => $id
                    ]);

                    if ($result) {
                        $time = time() + ((3600 * 24) * 7);
                        setcookie("email", $email, $time, "/");
                        header("location: ./logout_handler.php?alert=upd_s");
                    }
                } catch (PDOException $e) {
                    header("location: ../profile.php?alert=e");
                }
            }
        }
    } else {
        try {
            $query = "UPDATE `login` SET `name` = :name, `email` = :email WHERE `id` = :id";
            $result = $conn->prepare($query);
            $result->execute([
                "name" => $name,
                "email" => $email,
                "id" => $id
            ]);

            if ($result) {
                header("location: ../logout_handler.php?alert=upd_s");
            }
        } catch (PDOException $e) {
            header("location: ../profile.php?alert=e");
        }
    }
}

/*************** Truncate ***************** */
if (isset($_GET["del"])) {
    $query = "SELECT * FROM `login` WHERE `id` = ?";
    $result = $conn->prepare($query);
    $result->execute(["ADMIN"]);

    $row = $result->fetch();
    extract($row);

    $path = "../" . $image;

    if (unlink($path)) {
        $query = "DELETE FROM `login` WHERE `id` = ?";
        $result = $conn->prepare($query);
        $result->execute(["ADMIN"]);

        if ($result) {
            header("location: ./logout_handler.php");
        } else {
            header("location: ../settings.php?alert=e");
        }
    } else {
        header("location: ../settings.php?alert=e");
    }
}
