<?php
$host = "localhost";
$user = "root";
$password = ""; // غيّر حسب إعداداتك
$dbname = "personal_website";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
