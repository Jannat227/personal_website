<?php
session_start();

// تحقق من أن المستخدم مسجل الدخول
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login_user.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>نجاح الطلب</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #ffe15c, #ffcd02);
        font-family: 'Cairo', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
        width: 100%;
        animation: fadeInUp 0.6s ease;
    }
    h1 {
        color: #28a745;
        font-size: 28px;
        margin-bottom: 10px;
    }
    p {
        color: #333;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .btn {
        padding: 10px 20px;
        background: #ffcd02;
        border: none;
        border-radius: 8px;
        color: #222;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s ease;
    }
    .btn:hover {
        background: #ffba00;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
    <div class="container">
        <h1>✅ تم إرسال الطلب بنجاح</h1>
        <p>شكراً لك على ثقتك بنا! تم تسجيل طلبك وسوف نتواصل معك قريباً.</p>
        <a href="index.php" class="btn">العودة للصفحة الرئيسية</a>
    </div>
</body>
</html>
