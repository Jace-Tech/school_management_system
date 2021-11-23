<?php

require_once("db/config.php");
$types = ["image/jpg", "image/png", "image/jpeg"];

/******************** Insert [CREATE] ******************** */
if (isset($_POST['submit'])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    extract($POST);

    $id = rand(1000000, 99999999);

    $sql = "SELECT * FROM `events` 
        WHERE `event_id` = ? 
        OR `title` = ? 
        AND `event` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $title, $event]);

    if ($stmt->rowCount() > 0) {
        header("location: ../events.php?alert=e_e");
        exit();
    }

    $filename = $_FILES["image"]["name"];

    $destination = "../images/events/";
    $rand = rand(10000, 999999);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $filename .= $rand . "." . $extension;
    $file = $_FILES["image"]["tmp_name"];

    $size = $_FILES["image"]["size"];
    if ($size > 2000000) {
        header("location: events.php?alert=f_l");
        exit();
    }

    $type = $_FILES["image"]["type"];
    if (!array_search($type, $types)) {
        header("location: ../events.php?alert=f_t");
        exit();
    }

    $moved = move_uploaded_file($file, $destination . $filename);
    if ($moved) {
        try {
            $query = "INSERT INTO `events`(`event_id`, `title`, `event`, `image`, `content`, `time`, `date`) 
        VALUES (:id, :title, :event, :image, :content, :time, :date)";
            $result = $conn->prepare($query);
            $result->execute([
                "id" => $id,
                "title" => $title,
                "event" => $event,
                "content" => $content,
                "image" => $filename,
                "time" => $time,
                "date" => $date
            ]);

            if ($result) {
                header("location: ../events.php?alert=e_s");
            }
        } catch (PDOException $e) {
            header("location: ../events.php?alert=e");
        }
    }
}

/********************** Edit [UPDATE] ********************* */
if (isset($_POST["update"])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    if ($_FILES["image"]["size"] > 0) {
        $filename = $_FILES["image"]["name"];

        $rand = time();
        $destination = "../images/events/";
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $size = $_FILES["image"]["size"];
        if ($size > 2000000) {
            header("location: ../edit-events.php?e_id={$id}&alert=f_l");
            exit();
        }

        $type = $_FILES["image"]["type"];
        if (!array_search($type, $types)) {
            header("location: ../edit-events.php?e_id={$id}&alert=f_t");
            exit();
        }

        $file = $_FILES["image"]["tmp_name"];
        $filename .= $rand . "." . $extension;

        $moved = move_uploaded_file($file, $destination . $filename);

        if ($moved) {
            $path = "../images/events/" . $current_image;

            if (unlink($path)) {
                try {
                    $query = "UPDATE `events` SET `title` = :title, `event` = :event, `image` = :image, `content` = :content, `time` = :time, `date` = :date WHERE `event_id` = :id";
                    $result = $conn->prepare($query);
                    $result->execute([
                        "title" => $title,
                        "event" => $event,
                        "image" => $filename,
                        "content" => $content,
                        "time" => $time,
                        "date" => $date,
                        "id" => $id
                    ]);

                    if ($result) {
                        header("location: ../all-events.php?alert=upd_s");
                    }
                } catch (PDOException $e) {
                    header("location: ../all-events.php?alert=e");
                }
            }
        }
    } else {
        try {
            $query = "UPDATE `events` SET `title` = :title, `event` = :event, `content` = :content, `time` = :time, `date` = :date WHERE `event_id` = :id";
            $result = $conn->prepare($query);
            $result->execute([
                "title" => $title,
                "event" => $event,
                "content" => $content,
                "time" => $time,
                "date" => $date,
                "id" => $id
            ]);

            if ($result) {
                header("location: ../all-events.php?alert=upd_s");
            }
        } catch (PDOException $e) {
            header("location: ../all-events.php?alert=e");
        }
    }
}

/****************** Delete [DELETE] ************************/
if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    try {
        $query = "DELETE FROM `events` WHERE `event_id` = ?";
        $result = $conn->prepare($query);
        $result->execute([$id]);

        if ($result) {
            header("location: ../all-events.php?alert=ed_s");
        }
    } catch (PDOException $e) {
        header("location: ../all-events.php?alert=e");
    }
}

/************* TRUNCATE TABLE ****************/
if (isset($_GET["empty"])) {
    try {
        $sql = "SELECT `image` FROM `events`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            extract($row);

            $destination = "../images/events/";
            $path = $destination . $image;

            unlink($path);
        }

        $query = "TRUNCATE `events`";
        $result = $conn->prepare($query);
        $result->execute();

        if ($result) {
            header("location: ../settings.php?alert=te_s");
        }
    } catch (PDOException $e) {
        header("location: ../settings.php?alert=e");
    }
}
