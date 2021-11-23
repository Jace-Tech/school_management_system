<?php

require_once("./db/config.php");
require_once("../functions/index.php");

if(isset($_POST["submit"])): 
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $bookId = generateId(11);

    $check = "SELECT * FROM `books` WHERE `book_name` = ?";
    $resultCheck = $conn->prepare($check);
    
    if($resultCheck->rowCount() < 1): 

        // FILE
        $filename = $_FILES["book"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $dest = "../books/files/";
        
        $filename = $bookId . '.' . $ext;
        $file = $_FILES["book"]["tmp_name"];

        // IMAGE
        $image = $_FILES["image"]["name"];
        $imageExt = pathinfo($image, PATHINFO_EXTENSION);
        $destImg = "../books/image/";

        $imageName = $bookId . '.' . $imageExt;
        $imageFile = $_FILES["image"]["tmp_name"];
        

        if(move_uploaded_file($file, $dest.$filename) && move_uploaded_file($imageFile, $destImg.$imageName)):
            $query = "INSERT INTO `books`(`book_id`, `book_name`, `image`, `quantity`, `book_path`) VALUES (:bookId, :bookName, :image, :quantity, :bookPath)";
            $result = $conn->prepare($query);
            $result->execute([
                "bookId" => $bookId,
                "bookName" => $bookName,
                "image" => $imageName,
                "quantity" => $quantity,
                "bookPath" => $filename
            ]);

            if($result): 
                header("location: ../books.php?alert=b_a");
            endif;
        endif;
    else: 
        $query = "UPDATE `books` SET `quantity` = `quantity` + 1 WHERE `book_name` = ?";
        $result = $conn->prepare($query);
        
        if($result) header("location:  ../books.php?alert=b_a");
    endif;

endif;


// Update
if(isset($_POST["update"])): 
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    if($_FILES["book"]["name"] && $_FILES["image"]["name"]): 

        $query = "SELECT * FROM `books` WHERE `book_id` = ?";
        $result = $conn->prepare($query);
        $result->execute([$BOOK_ID]);

        if($result->rowCount() > 0): 
            $book = $result->fetch();
            $bookFile = $book["book_path"];
            $bookImage = $book["image"];

            if(unlink("../books/files/{$bookFile}") && unlink("../books/image/{$bookImage}")):    

                // FILE
                $filename = $_FILES["book"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $dest = "../books/files/";
                
                $filename = $BOOK_ID . '.' . $ext;
                $file = $_FILES["book"]["tmp_name"];

                // IMAGE
                $image = $_FILES["image"]["name"];
                $imageExt = pathinfo($image, PATHINFO_EXTENSION);
                $destImg = "../books/image/";

                $imageName = $BOOK_ID . '.' . $imageExt;
                $imageFile = $_FILES["image"]["tmp_name"];
                

                if(move_uploaded_file($file, $dest.$filename) && move_uploaded_file($imageFile, $destImg.$imageName)):
                    $query = "UPDATE `books` SET `book_name` = :bookName, `image` = :image, `quantity` = :quantity, `book_path` = :bookPath WHERE `book_id` = :bookId";
                    $result = $conn->prepare($query);
                    $result->execute([
                        "bookName" => $bookName,
                        "image" => $imageName,
                        "quantity" => $quantity,
                        "bookPath" => $filename,
                        "bookId" => $BOOK_ID
                    ]);

                    if($result) header("location: ../books.php?alert=b_e");
                endif;
            endif;
        endif;
    else:
        $query = "UPDATE `books` SET `book_name` = :bookName, `quantity` = :quantity WHERE `book_id` = :bookId";
        $result = $conn->prepare($query);
        $result->execute([
            "bookName" => $bookName,
            "quantity" => $quantity,
            "bookId" => $BOOK_ID,
        ]);

        if($result) header("location: ../books.php?alert=b_e");
    endif;
endif;


// Delete
if(isset($_GET["delete_id"])): 
    $id = $_GET["delete_id"];

    $query = "SELECT * FROM `books` WHERE `book_id` = ?";
    $result = $conn->prepare($query);
    $result->execute([$id]);

    if($result->rowCount() > 0): 
        $book = $result->fetch();
        $bookFile = $book["book_path"];
        $bookImage = $book["image"];

        if(unlink("../books/files/{$bookFile}") && unlink("../books/image/{$bookImage}")): 
            $query = "DELETE FROM `books` WHERE `book_id` = ?";
            $result = $conn->prepare($query);
            $result->execute([$id]);

            if($result) header("location: ../books.php?alert=b_d");
        endif;
    endif;
endif;