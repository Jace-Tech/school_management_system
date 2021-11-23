<?php

require_once("./db/config.php");
require_once("../functions/index.php");

if(isset($_POST["submit"])): 
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $uniformId = generateId(11);

    $check = "SELECT * FROM `uniform` WHERE `uniform_name` = ?";
    $resultCheck = $conn->prepare($check);
    
    if($resultCheck->rowCount() < 1): 

        // IMAGE
        $image = $_FILES["image"]["name"];
        $imageExt = pathinfo($image, PATHINFO_EXTENSION);
        $destImg = "../images/uniform/";

        $imageName = $uniformId . '.' . $imageExt;
        $imageFile = $_FILES["image"]["tmp_name"];
        

        if(move_uploaded_file($imageFile, $destImg.$imageName)):
            $query = "INSERT INTO `uniform`(`uniform_id`, `uniform_name`, `image`, `quantity`, `section`) VALUES (:uniformId, :uniformName, :image, :quantity, :section)";
            $result = $conn->prepare($query);
            $result->execute([
                "uniformId" => $uniformId,
                "uniformName" => $uniformName,
                "image" => $imageName,
                "quantity" => $quantity,
                "section" => $section
            ]);

            if($result): 
                header("location: ../uniform.php?alert=u_a");
            endif;
        endif;
    else: 
        $query = "UPDATE `uniform` SET `quantity` = `quantity` + 1 WHERE `uniform_name` = ?";
        $result = $conn->prepare($query);
        
        if($result) header("location:  ../uniform.php?alert=u_a");
    endif;

endif;


// Update
if(isset($_POST["update"])): 
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    if($_FILES["image"]["name"]): 

        $query = "SELECT * FROM `uniform` WHERE `uniform_id` = ?";
        $result = $conn->prepare($query);
        $result->execute([$uniform_ID]);

        if($result->rowCount() > 0): 
            $uniform = $result->fetch();
            $uniformImage = $uniform["image"];

            if(unlink("../images/uniform/{$uniformImage}")):
                // IMAGE
                $image = $_FILES["image"]["name"];
                $imageExt = pathinfo($image, PATHINFO_EXTENSION);
                $destImg = "../images/uniform/";

                $imageName = $uniform_ID . '.' . $imageExt;
                $imageFile = $_FILES["image"]["tmp_name"];
                

                if(move_uploaded_file($imageFile, $destImg.$imageName)):
                    $query = "UPDATE `uniform` SET `uniform_name` = :uniformName, `image` = :image, `quantity` = :quantity, `section` = :section WHERE `uniform_id` = :uniformId";
                    $result = $conn->prepare($query);
                    $result->execute([
                        "uniformName" => $uniformName,
                        "image" => $imageName,
                        "quantity" => $quantity,
                        "section" => $section,
                        "uniformId" => $UNIFORM_ID
                    ]);

                    if($result) header("location: ../uniform.php?alert=u_e");
                endif;
            endif;
        endif;
    else:
        $query = "UPDATE `uniform` SET `uniform_name` = :uniformName, `quantity` = :quantity, `section` = :section WHERE `uniform_id` = :uniformId";
        $result = $conn->prepare($query);
        $result->execute([
            "uniformName" => $uniformName,
            "quantity" => $quantity,
            "section" => $section,
            "uniformId" => $UNIFORM_ID,
        ]);

        if($result) header("location: ../uniform.php?alert=u_e");
    endif;
endif;


// Delete
if(isset($_GET["delete_id"])): 
    $id = $_GET["delete_id"];

    $query = "SELECT * FROM `uniform` WHERE `uniform_id` = ?";
    $result = $conn->prepare($query);
    $result->execute([$id]);

    if($result->rowCount() > 0): 
        $uniform = $result->fetch();
        $uniformImage = $uniform["image"];

        if(unlink("../images/uniform/{$uniformImage}")): 
            $query = "DELETE FROM `uniform` WHERE `uniform_id` = ?";
            $result = $conn->prepare($query);
            $result->execute([$id]);

            if($result) header("location: ../uniform.php?alert=u_d");
        endif;
    endif;
endif;