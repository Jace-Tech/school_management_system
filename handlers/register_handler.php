<?php
require_once('./db/config.php');

if (isset($_POST['submit'])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $id = 'ADMIN';
    $fullname = $POST['fullname'];
    $email = $POST['email'];

    $pass1 = $_POST["password"];
    $pass2 = $_POST["password2"];

    if ($pass1 !== $pass2) {
        header("location: ../register.php?alert=p_f");
        exit();
    }

    $password = password_hash($POST['password'], PASSWORD_DEFAULT);

    $filename = $_FILES['image']['name'];
    $random = rand(1000, 9999);
    $destination = '../images/teachers/';
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename .= $random . '.' . $extension;
    $file = $_FILES['image']['tmp_name'];
    $filepath = "images/teachers/" . $filename;
    $imagePath = $destination . $filename;

    $upload = move_uploaded_file($file, $imagePath);

    if ($upload) {
        try {
            $result = $conn->prepare("INSERT INTO `login`(`id`, `name`, `email`, `image`, `password`) VALUES (:id ,:fullname,:email,:image,:password)");

            $result->execute([
                'id' => $id,
                'fullname' => $fullname,
                'email' => $email,
                'image' => $filepath,
                'password' => $password
            ]);

            if ($result) {
                header('location: ../index.php?alert=reg_s');
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
