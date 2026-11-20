<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "modern_kubo_db";

try {
    $conn = new mysqli($host, $username, $password, $database);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Database connection failed.");
}
