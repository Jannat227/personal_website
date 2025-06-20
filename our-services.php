<?php
include 'config.php';

$designs = $conn->query("SELECT * FROM images WHERE type = 'design'");
$codings = $conn->query("SELECT * FROM images WHERE type = 'coding'");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>خدماتنا</title>
    <style>
        body { font-family: sans-serif; background: #f9f9f9; padding: 30px; }
        h2 { color: #333; margin-top: 40px; }
        .services { display: flex; flex-wrap: wrap; gap: 20px; }
        .service { background: #fff; padding: 15px; border-radius: 8px; width: 250px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .service img { width: 100%; height: 150px; object-fit: cover; border-radius: 5px; }
        .service h3 { margin-top: 10px; font-size: 18px; text-align: center; }
    </style>
</head>
<body>

<h2>خدمات التصميم</h2>
<div class="services">
    <?php while($row = $designs->fetch_assoc()): ?>
        <div class="service">
            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
            <h3><?= $row['title'] ?></h3>
        </div>
    <?php endwhile; ?>
</div>

<h2>خدمات البرمجة</h2>
<div class="services">
    <?php while($row = $codings->fetch_assoc()): ?>
        <div class="service">
            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
            <h3><?= $row['title'] ?></h3>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
