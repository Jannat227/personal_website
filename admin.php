<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

// حذف الصورة إذا تم الضغط على زر حذف
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM images WHERE id = $id");
}

$result = $conn->query("SELECT * FROM images");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <style>
        body { margin: 0; font-family: sans-serif; background-color: #444; color: white; }
        header { background: #fdd54d; padding: 20px; text-align: center; font-size: 24px; font-weight: bold; color: #000; }
        .container { padding: 40px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .card { background: #fff; color: #000; border-radius: 10px; overflow: hidden; box-shadow: 2px 2px 10px #00000040; text-align: center; padding-bottom: 15px; }
        .card img { width: 100%; height: 150px; object-fit: cover; }
        .card h3 { margin: 10px 0; }
        .card .type { font-weight: bold; margin-bottom: 10px; color: #555; }
        .card a { display: inline-block; padding: 8px 16px; margin: 10px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px; }
        .logout { position: absolute; top: 20px; right: 20px; background: #000; color: white; padding: 10px; text-decoration: none; }
    </style>
</head>
<body>

<header>لوحة التحكم</header>
<a href="logout.php" class="logout">تسجيل خروج</a>
<a href="upload.php" style="display:inline-block;padding:10px 20px;background:#fdd54d;margin:20px;text-decoration:none;color:black;">+ رفع صورة جديدة</a>

<div class="container">
    <div class="grid">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                <h3><?php echo $row['title']; ?></h3>
                <div class="type">
                    <?php 
                        if ($row['type'] == 'design') echo 'تصميم';
                        elseif ($row['type'] == 'coding') echo 'برمجة';
                        else echo 'غير محدد';
                    ?>
                </div>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('هل أنت متأكد من حذف الصورة؟');">🗑 حذف</a>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
