<?php session_start();

$hostname = "ulyssebohnadmin.mysql.db";
$base = "ulyssebohnadmin";
$loginDB = "ulyssebohnadmin";
$passwordDB ="Password10";
$database = null;
try {
    $database = new PDO ("mysql:host=$hostname; dbname=$base; charset=utf8",
        "$loginDB",
        "$passwordDB");
} catch (PDOException $e) {
    die  ("Connection error : " . $e->getMessage() . "\n");
}