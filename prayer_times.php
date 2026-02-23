<?php
// ---------------------------
// PHP: Fetch prayer times from database
// ---------------------------

// Database connection settings
$host = "localhost";
$dbname = "azkar_app"; // Database containing prayer times
$username = "root";
$password = "";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception for easier debugging
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL query to fetch the first row of prayer times
    $stmt = $conn->prepare("SELECT * FROM prayer_times LIMIT 1");
    $stmt->execute();
    // Fetch data as associative array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Display database connection or query errors
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>أوقات الصلاة</title>

<!-- Link to external CSS for styling -->
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container2">
<h1>أوقات الصلاة</h1>

<?php if ($result): ?>
    <!-- Display prayer times if data exists -->
    <div class="prayer-times">
        <p>الفجر: <?php echo $result['fajr']; ?></p>
        <p>الظهر: <?php echo $result['dhuhr']; ?></p>
        <p>العصر: <?php echo $result['asr']; ?></p>
        <p>المغرب: <?php echo $result['maghrib']; ?></p>
        <p>العشاء: <?php echo $result['isha']; ?></p>
    </div>
<?php else: ?>
    <!-- Show message if no data is available -->
    <p class="no-data-message">لا توجد بيانات</p>
<?php endif; ?>

<!-- Back link to main page -->
<a href="index.php" class="back-link">العودة للصفحة الرئيسية</a>

</div>

</body>
</html>
