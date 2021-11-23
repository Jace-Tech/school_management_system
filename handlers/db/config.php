<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'ghschool');

$dsn = 'mysql:host=' . HOST . ';dbname=' . DB;

try {
    $conn = new PDO($dsn, USER, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Something went wrong" . $error;
}
