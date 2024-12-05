<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "dem_exam");
$host = "localhost";
$user = "root";
$db = "dem_exam";//https://phpmyadmin/public/phpMyAdmin-5.2.1-all-languages/index.php?route=/database/structure&db=Dem_Exam
$pass = "root";
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);// Создаём подключение
} catch (PDOException $e) {
    exit("Error 404 No contact." . $e->getMessage());
}