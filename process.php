<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "personal_website";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // لو تم الحفظ بنجاح، حول لصفحة الشكر
        header("Location: thankyou.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "Error: Please fill out all fields.";
}

$conn->close();
?>
