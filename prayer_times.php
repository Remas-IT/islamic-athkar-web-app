<?php
$host = "localhost";
$dbname = "azkar_app";
$username = "root";
$password = "";

try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM prayer_times LIMIT 1");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>أوقات الصلاة</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container2">
<h1>أوقات الصلاة</h1>

<?php if ($result): ?>
<div class="prayer-times">
<p>الفجر: <?php echo $result['fajr']; ?></p>
<p>الظهر: <?php echo $result['dhuhr']; ?></p>
<p>العصر: <?php echo $result['asr']; ?></p>
<p>المغرب: <?php echo $result['maghrib']; ?></p>
<p>العشاء: <?php echo $result['isha']; ?></p>
</div>
<?php else: ?>
<p class="no-data-message">لا توجد بيانات</p>
<?php endif; ?>

<a href="index.php" class="back-link">العودة للصفحة الرئيسية</a>

</div>

</body>
</html>
