<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>أذكار المسلم</title>

<!-- Import Arabic Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">

<!-- Updated CSS path after moving style.css into assets folder -->
<link rel="stylesheet" href="assets/style.css">

</head>
<body>

<div class="container2">
<h1>أذكار المسلم</h1>

<!-- Updated page paths after moving HTML files into pages folder -->
<a href="pages/morning.html" target="_blank">أذكار الصباح</a>
<a href="pages/evening.html" target="_blank">أذكار المساء</a>
<a href="pages/daily.html" target="_blank">الورد اليومي</a>

<div class="button-container">
<a href="praytime.php" class="btn">عرض أوقات الصلاة</a>
</div>

<div class="container">
<p><strong>اشترك لتذكيرك بقراءة الأذكار</strong></p>

<form method="post">
<input type="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>
<button type="submit" name="subscribe" class="buttontwo">اشترك</button>
</form>

<?php
// Database connection configuration
$host = "localhost";
$dbname = "adhkar_reminder";
$username = "root";
$password = "";

try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle email subscription request
if (isset($_POST['subscribe'])) {

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

// Validate email format
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

$stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (:email)");
$stmt->bindParam(':email', $email);

if ($stmt->execute()) {
echo "<p>تم الاشتراك بنجاح! ستتلقى تذكيراتك قريبًا.</p>";
} else {
echo "<p>حدث خطأ أثناء الاشتراك.</p>";
}

} else {
echo "<p>الرجاء إدخال بريد إلكتروني صحيح.</p>";
}
}
}
catch (PDOException $e) {
echo "<p>خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage() . "</p>";
}
?>
</div>

<!-- Share section -->
<div class="share-section">
<h3>شارك الأذكار:</h3>
<a id="share" class="share-button" href="#" onclick="shareThikr()">مشاركة على واتساب</a>
</div>

<script>
// Array of athkar for random sharing
const athkar = [
"سبحان الله",
"الحمد لله",
"لا إله إلا الله",
"الله أكبر",
"استغفر الله",
"لا حول ولا قوة إلا بالله"
];

// Generate random thikr and update WhatsApp share link
function shareThikr() {
const randomThikr = athkar[Math.floor(Math.random() * athkar.length)];
document.getElementById("share").href =
"https://wa.me/?text=" + encodeURIComponent(randomThikr);
}
</script>

</body>
</html>
