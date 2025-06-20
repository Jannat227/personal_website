<?php
session_start();

$admin_user = "jannat";
$admin_pass = "2001"; // غيّرها لاحقًا

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["username"] === $admin_user && $_POST["password"] === $admin_pass) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "بيانات الدخول غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { background: #333; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: #222; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #000; }
        input { display: block; margin: 10px 0; padding: 10px; width: 250px; }
        button { padding: 10px 20px; background: #fdd54d; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    </form>
</body>
</html>
