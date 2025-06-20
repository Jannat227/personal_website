<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>تقديم طلب</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .order-container {
            max-width: 400px;
            margin: 80px auto;
            background: rgb(255, 255, 255);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .order-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #000;
            font-weight: bold;
            font-size: 24px;
        }

        .order-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .order-container input[type="text"],
        .order-container input[type="tel"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .order-container button {
            width: 100%;
            background: #FDD835;
            border: none;
            padding: 12px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .order-container button:hover {
            background-color: #fbc02d;
        }

        @media (max-width: 480px) {
            .order-container {
                margin: 40px 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">BY JANNAT</div>
    <nav>
        <ul>
            <li><a href="#executed">HOME</a></li>
            <li><a href="#services">SERVICES</a></li>
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="#">MENU</a></li>
        </ul>
    </nav>
</header>

<div class="order-container">
    <h2>مرحباً، <?= htmlspecialchars($_SESSION['username']); ?>! قدم طلبك الآن:</h2>

    <form action="process_order.php" method="post">
        <input type="hidden" name="user_id" value="<?= isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>" />

        <label for="address">العنوان:</label>
        <input type="text" id="address" name="address" required />

        <label for="phone1">رقم الهاتف 1:</label>
        <input type="tel" id="phone1" name="phone1" required pattern="[0-9+]{6,15}" title="أدخل رقم هاتف صحيح" />

        <label for="phone2">رقم الهاتف 2 (اختياري):</label>
        <input type="tel" id="phone2" name="phone2" pattern="[0-9+]{6,15}" title="أدخل رقم هاتف صحيح أو اتركه فارغاً" />

        <label for="location">الموقع (كتابة أو لوكيشن):</label>
        <input type="text" id="location" name="location" required />

        <label for="credit_card">بطاقة الدفع (كردت كارت):</label>
        <input type="text" id="credit_card" name="credit_card" required pattern="\d{13,19}" title="أدخل رقم بطاقة صحيح (13-19 رقم)" />

        <button type="submit">إرسال الطلب</button>
    </form>
</div>

<!-- قسم الاتصال -->
<section class="contact" id="contact" data-aos="fade-up">
<form class="form" action="process.php" method="POST">
  <input type="text" name="name" placeholder="What's your Name?" required style="text-align: left; direction: ltr;">
  <input type="email" name="email" placeholder="Your Email" required style="text-align: left; direction: ltr;">
  <textarea name="message" placeholder="Message" required style="text-align: left; direction: ltr;"></textarea>
  <button type="submit">Send Message</button>
</form>

     <div class="info" style="text-align: left; direction: ltr;">
  <p>Have any question?</p>
  <h3>CONTACT US</h3>
  <p>Number phone: +964 770 000 1111</p>
  <p>E-mail: jannataltaher@gmail.com</p>
</div>


</section>
</body>
</html>
