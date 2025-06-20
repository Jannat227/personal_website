<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type']; // نوع الخدمة
    $tools = $_POST['tools']; // الأدوات المستخدمة
    $duration = $_POST['duration']; // مدة التنفيذ
    $github = $_POST['github']; // رابط GitHub

    // رفع الصورة الرئيسية
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $upload_path = "uploads/" . basename($image_name);

    if (move_uploaded_file($image_tmp, $upload_path)) {
        // إدخال بيانات الصورة الرئيسية في جدول الصور
        $stmt = $conn->prepare("INSERT INTO images (title, image, description, price, type, tools, duration, github) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $title, $upload_path, $description, $price, $type, $tools, $duration, $github);
        $stmt->execute();

        $main_image_id = $stmt->insert_id; // الحصول على رقم ID للصورة الرئيسية المضافة

        // رفع الصور الإضافية المتعددة
        if (!empty($_FILES['additional_images']['name'][0])) {
            $count_files = count($_FILES['additional_images']['name']);
            for ($i = 0; $i < $count_files; $i++) {
                $add_name = $_FILES['additional_images']['name'][$i];
                $add_tmp = $_FILES['additional_images']['tmp_name'][$i];
                $add_path = "uploads/" . basename($add_name);

                if (move_uploaded_file($add_tmp, $add_path)) {
                    // تخزين رابط الصورة الإضافية مع ربطها بالصورة الرئيسية
                    $stmt2 = $conn->prepare("INSERT INTO product_images (image_path, product_id) VALUES (?, ?)");
                    $stmt2->bind_param("is", $main_image_id, $add_path);
                    $stmt2->execute();
                }
            }
        }

        $success = "✅ تم رفع المشروع بنجاح!";
    } else {
        $error = "❌ فشل في رفع الصورة الرئيسية.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>رفع مشروع جديد</title>
    <style>
        body { background: #333; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        form { background: #222; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #000; width: 350px; }
        input, textarea, select, button { display: block; margin: 10px 0; padding: 10px; width: 100%; box-sizing: border-box; border-radius: 5px; border: none; }
        button { background: #fdd54d; cursor: pointer; font-weight: bold; }
        textarea { resize: vertical; }
        .message { margin-top: 10px; color: lightgreen; }
        .error { color: red; }
        a { color: #fdd54d; text-decoration: none; display: block; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
  <form method="POST" enctype="multipart/form-data">
    <h2>رفع مشروع جديد</h2>

    <input type="text" name="title" placeholder="عنوان المشروع" required />

    <textarea name="description" placeholder="وصف مختصر" rows="3" required></textarea>

    <input type="text" name="price" placeholder="السعر بالدولار (مثلاً: 100$)" required />

    <select name="type" required>
        <option value="">اختر نوع الخدمة</option>
        <option value="design">تصميم</option>
        <option value="coding">برمجة</option>
    </select>

    <input type="text" name="tools" placeholder="الأدوات المستخدمة (مثلاً: Photoshop, React)" required />

    <input type="text" name="duration" placeholder="مدة التنفيذ (مثلاً: أسبوعين)" required />

    <input type="url" name="github" placeholder="رابط GitHub (إن وجد)" />

    <label>الصورة الرئيسية:</label>
    <input type="file" name="image" accept="image/*" required />

    <label>صور إضافية (اختياري):</label>
    <input type="file" name="additional_images[]" accept="image/*" multiple />

    <button type="submit">رفع المشروع</button>

    <?php
    if (isset($success)) echo "<p class='message'>$success</p>";
    if (isset($error)) echo "<p class='error'>$error</p>";
    ?>

    <a href="admin.php">⬅ العودة للوحة الأدمن</a>
  </form>
</body>
</html>
