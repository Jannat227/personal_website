<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background:rgb(255, 255, 255);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #000;
            font-weight: bold;
            font-size: 28px;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .login-container button {
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

        .login-container button:hover {
            background-color: #fbc02d;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 40px 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- الهيدر -->
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

<!-- محتوى تسجيل الدخول -->
<div class="login-container">
    <h2>تسجيل الدخول</h2>
    <form action="order.php" method="post">
        <label for="username">اسم المستخدم</label>
        <input type="text" id="username" name="username" required placeholder="ادخل اسم المستخدم" />

        <label for="password">كلمة المرور</label>
        <input type="password" id="password" name="password" required placeholder="ادخل كلمة المرور" />

        <button type="submit">دخول</button>
    </form>
</div>
<section class="contact" id="contact" data-aos="fade-up">
  <form class="form" action="process.php" method="POST">
    <input type="text" name="name" placeholder="What's your Name?" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
  <div class="info">
    <p>Have any question?</p>
    <h3>CONTACT US</h3>
    <p>Number phone: +964 770 000 1111</p>
    <p>E-mail: jannataltaher@gmail.com</p>
  </div>
</section>
</body>
</html>
