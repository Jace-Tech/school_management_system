<?php


require_once("./db/config.php");
$types = ["image/jpg", "image/png", "image/jpeg"];

/************ Insert [CREATE] ************** */
if (isset($_POST["submit"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $filename = $_FILES["image"]["name"];
    $destination = "../images/teachers/";
    $random = rand(1000, 99999);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $array = ["W", "X", "Y", "Z"];
    $id = $array[rand(0, 3)] . $array[rand(0, 3)];
    $id .= rand(10000, 999999);

    $size = $_FILES["image"]["size"];
    $type = $_FILES["image"]["type"];

    if (!array_search($type, $types)) {
        header("location: ../add-teacher.php?alert=f_t");
        exit();
    }

    if ($size > 2000000) {
        header("location: ../add-teacher.php?alert=f_t");
        exit();
    }

    $filename .= $random . "." . $extension;
    $file = $_FILES["image"]["tmp_name"];

    $query_check = "SELECT * FROM `teachers` WHERE `teacher_id` = :id OR `firstname` = :firstname AND `lastname` = :lastname";
    $result_check = $conn->prepare($query_check);
    $result_check->execute([
        "id" => $id,
        "firstname" => $firstname,
        "lastname" => $lastname
    ]);

    if ($result_check->rowCount() > 0) {
        header("location: ../add-teacher.php?alert=t_e");
        exit();
    }

    $moved = move_uploaded_file($file, $destination . $filename);

    if ($moved) {
        try {
            $query = "INSERT INTO `teachers`(`teacher_id`, `firstname`, `lastname`, `middlename`, `image`, `gender`, `phone_no`, `address`, `dob`) VALUES (:id, :firstname, :lastname,:middlename, :image, :gender, :phone, :address, :dob)";
            $result = $conn->prepare($query);
            $result->execute([
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "middlename" => $middlename,
                "gender" => $gender,
                "phone" => $phone,
                "address" => $address,
                "dob" => $dob,
                "image" => $filename
            ]);

            if ($result) {
                header("location: ../add-teacher.php?alert=t_s");
            }
        } catch (PDOException $e) {
            header("location: ../add-teacher.php?alert=e");
        }
    }
}


if (isset($_POST["update"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    if ($_FILES["image"]["name"] != null) {
        $types = ["image/jpg", "image/png", "image/jpeg"];

        $filename = $_FILES["image"]["name"];
        $random = rand(1000, 99999);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $destination = "../images/teachers/";
        chmod($destination, 777);

        $size = $_FILES['image']["size"];
        $type = $_FILES['image']["type"];

        $filename .= $random . '.' . $extension;
        $file = $_FILES["image"]["tmp_name"];

        if ($size > 2000000) {
            header("location: ../teacher-profile.php?alert=f_l&profile_id=" . $id);
            exit();
        }

        if (!array_search($type, $types)) {
            header("location: ../teacher-profile.php?alert=f_t&profile_id=" . $id);
        }

        try {
            $query = "UPDATE `teachers` 
            SET `firstname` = :firstname,
            `lastname` = :lastname,
            `gender` = :gender,
            `phone_no` = :phone,
            `image` = :image,
            `middlename` = :middlename,
            `dob` = :dob,
            `address` = :address
            WHERE `teacher_id` = :id
            ";
            $result = $conn->prepare($query);
            $result->execute([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "gender" => $gender,
                "phone" => $phone,
                "image" => $filename,
                "middlename" => $middlename,
                "dob" => $dob,
                "address" => $address,
                "id" => $id
            ]);

            if ($result) {
                $moved = move_uploaded_file($file, $destination . $filename);

                if ($moved) {
                    $path = $destination . $previous_image;
                    $deleted = unlink($path);

                    if ($deleted) {
                        header("location: ../teacher-profile.php?alert=upd_s&profile_id=" . $id);
                    }
                }
            }
        } catch (PDOException $e) {
            header("location: ../teacher-profile.php?alert=e&profile_id=" . $id);
        }
    } else {
        try {
            $query = "UPDATE `teachers` 
            SET `firstname` = :firstname,
            `lastname` = :lastname,
            `middlename` = :middlename,
            `dob` = :dob,
            `gender` = :gender,
            `phone_no` = :phone,
            `address` = :address
            WHERE `teacher_id` = :id
            ";
            $result = $conn->prepare($query);
            $result->execute([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "gender" => $gender,
                "phone" => $phone,
                "middlename" => $middlename,
                "dob" => $dob,
                "address" => $address,
                "id" => $id
            ]);

            if ($result) {
                header("location: ../teacher-profile.php?alert=upd_s&profile_id=" . $id);
            }
        } catch (PDOException $e) {
            header("location: ../teacher-profile.php?alert=e&profile_id=" . $id);
        }
    }
}


if (isset($_GET['delete_id'])) {
    $id = $_GET["delete_id"];

    try {
        $query = "SELECT * FROM `teachers` WHERE `teacher_id` = ?";
        $result = $conn->prepare($query);
        $result->execute([$id]);

        $row = $result->fetchAll();
        extract($row[0]);

        $destination = "../images/teachers/";
        $path = $destination . $image;

        chmod($destination, 777);

        $deleted = unlink($path);

        if ($deleted) {
            $sql = "DELETE FROM `teachers` WHERE `teacher_id` = ?";
            $result = $conn->prepare($sql);
            $result->execute([$id]);

            if ($result) {
                header("location: ../all-teachers.php?alert=td_s");
            }
        }
    } catch (PDOException $e) {
        header("location: ../all-teachers.php?alert=e");
    }
}


if (isset($_GET["truncate"])) {
    try {
        $query = "SELECT * FROM `teachers`";
        $result = $conn->prepare($query);
        $result->execute();

        while ($row = $result->fetch()) {
            extract($row);
            $path = "../images/teachers/" . $image;

            unlink($path);
        }

        $sql =  "TRUNCATE `teachers`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            header("location: ../settings.php?alert=tt_s");
        }
    } catch (PDOException $e) {
        header("location: ../settings.php?alert=e");
    }
}
