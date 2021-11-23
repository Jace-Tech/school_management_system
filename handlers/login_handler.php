<?php

require_once ('db/config.php');

if (isset($_POST['login'])){
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    try{
        $username = $POST['username'];
        $password = $POST['password'];

        $query = $conn->prepare("SELECT `password` FROM `login` WHERE `email` = :username");
        $query->execute([
            'username' => $username
        ]);

        if ($query->rowCount() > 0) {
            $row = $query->fetch();
            $hashPassword = $row['password'];
            $result= password_verify($password, $hashPassword);

            if ($result){
                 header('location: ../dashboard.php?alert=log_s');

                if(isset($POST['remember_me'])){
                    $time = time() + 604800;
                }
                else{
                    $time = time() + 864000;
                }
                setcookie('email', $username, $time, "/");
            }
            else{
                header('location: ../index.php?alert=log_f&q=wp');
            }
        }
        else {
            header('location: ../index.php?alert=log_f&q=no_user');
        }
    }
    catch (PDOException $exception){
        echo $exception;
    }
}