<?php
session_start();
require 'config.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "كلمة المرور غير متطابقة.";
    } else {
        // تحقق إذا اسم المستخدم موجود مسبقاً
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "اسم المستخدم موجود مسبقاً.";
        } else {
            // إضافة المستخدم الجديد
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; // كل المستخدمين الجدد دورهم user

            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $role);

            if ($stmt->execute()) {
                // الحصول على ID المستخدم الذي تم إنشاؤه للتو
                $user_id_from_database = $conn->insert_id;

                // تسجيل الدخول تلقائياً بعد التسجيل
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['user_id'] = $user_id_from_database;

                header("Location: order.php");
                exit();
            } else {
                $error = "حدث خطأ أثناء التسجيل.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>إنشاء حساب جديد</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .register-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #000;
            font-weight: bold;
            font-size: 28px;
        }
        .register-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        .register-container button {
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
        .register-container button:hover {
            background-color: #fbc02d;
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            top: 12px;
            left: 12px;
            color: #FDD835;
            user-select: none;
        }
        .position-relative {
            position: relative;
        }
        @media (max-width: 480px) {
            .register-container {
                margin: 40px 20px;
                padding: 20px;
            }
        }
        a {
            color: #FDD835;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
  <nav>
    <ul>
      <li><a href="#">MENU</a></li>
      <li><a href="#contact">CONTACT</a></li>
      <li><a href="#services">SERVICES</a></li>
      <li><a href="#executed">HOME</a></li>
    </ul>
  </nav>
  <div class="logo">BY JANNAT</div>
</header>

<div class="register-container">
    <h2>إنشاء حساب جديد</h2>

    <?php if (!empty($error)): ?>
        <div style="color: red; margin-bottom: 15px; text-align: center; font-weight: bold;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" novalidate>
        <label for="username">اسم المستخدم</label>
        <input type="text" id="username" name="username" required placeholder="ادخل اسم المستخدم" />

        <div class="position-relative">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required placeholder="ادخل كلمة المرور" />
            <span class="toggle-password" onclick="togglePassword('password')" title="إظهار/إخفاء كلمة المرور">👁️</span>
        </div>

        <div class="position-relative">
            <label for="confirm_password">تأكيد كلمة المرور</label>
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="أعد إدخال كلمة المرور" />
            <span class="toggle-password" onclick="togglePassword('confirm_password')" title="إظهار/إخفاء كلمة المرور">👁️</span>
        </div>

        <button type="submit">إنشاء حساب</button>
    </form>

    <p style="text-align:center; margin-top: 20px;">هل لديك حساب؟ <a href="login_user.php">تسجيل دخول</a></p>
</div>

<section class="contact" id="contact">
  <div class="info" style="text-align: left; direction: ltr;">
    <p>Have any question?</p>
    <h3>CONTACT US</h3>
    <p>Phone: +964 770 000 1111</p>
    <p>Email: jannataltaher@gmail.com</p>
  </div>

  <form class="form" action="process.php" method="POST">
    <input type="text" name="name" placeholder="What's your Name?" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>

<script>
    function togglePassword(id) {
        const passInput = document.getElementById(id);
        passInput.type = passInput.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
