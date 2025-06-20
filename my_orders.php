<?php
session_start();
require 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// جلب الطلبات من قاعدة البيانات
$stmt = $conn->prepare("SELECT id, address, phone1, phone2, location, credit_card, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
       <link rel="stylesheet" href="style.css" />
    <title>طلباتي</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
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
<br><br><br><br><br><br>   
      <h2 style="text-align: center;">طلباتي السابقة</h2>


    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>العنوان</th>
                    <th>الهاتف 1</th>
                    <th>الهاتف 2</th>
                    <th>الموقع</th>
                    <th>البطاقة</th>
                    <th>تاريخ الطلب</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['phone1']) ?></td>
                        <td><?= htmlspecialchars($row['phone2']) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= htmlspecialchars($row['credit_card']) ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>لا يوجد طلبات بعد.</p>
    <?php endif; ?>

    <br>
<a href="order.php" class="fancy-link">رجوع إلى صفحة الطلب</a>

<style>
.fancy-link {
    display: inline-block;
    color: white;
    background-color:rgba(61, 54, 54, 0.53); /* لون خلفية أزرق جذاب، تقدر تغيّره */
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    cursor: pointer;
}

.fancy-link:hover {
    transform: scale(1.1);
    background-color:rgb(59, 57, 51); /* لون أغمق عند المرور بالماوس */
    cursor: pointer; /* شكل الماوس يصبح pointer (يد) */
}
</style>
    <br><br><br><br><br><br>   

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
