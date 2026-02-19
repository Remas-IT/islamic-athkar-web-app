<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>أذكار المسلم</title>

<!-- Import Arabic font -->
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">

<!-- Link CSS file -->
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container2">
<h1>أذكار المسلم</h1>

<!-- Links to Athkar pages -->
<a href="morning.html" target="_blank">أذكار الصباح</a>
<a href="evening.html" target="_blank">أذكار المساء</a>
<a href="daily.html" target="_blank">الورد اليومي</a>

<!-- Button for prayer times -->
<div class="button-container">
<a href="prayer_times.php" class="btn">عرض أوقات الصلاة</a>
</div>

<!-- Subscription section -->
<div class="container">
<p><strong>اشترك لتذكيرك بقراءة الأذكار</strong></p>

<!-- Subscription form -->
<form method="post">
<input type="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>
<button type="submit" name="subscribe" class="buttontwo">اشترك</button>
</form>

<?php
// Database connection settings
$host = "localhost";
$dbname = "adhkar_reminder";
$username = "root";
$password = "";

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user clicked subscribe
    if (isset($_POST['subscribe'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Insert email into database
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

} catch (PDOException $e) {
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
// Array of Athkar
const athkar = [
"سبحان الله",
"الحمد لله",
"لا إله إلا الله",
"الله أكبر",
"استغفر الله",
"لا حول ولا قوة إلا بالله"
];

// Choose random thikr and update WhatsApp link
function shareThikr() {
const randomThikr = athkar[Math.floor(Math.random() * athkar.length)];
document.getElementById("share").href = "https://wa.me/?text=" + randomThikr;
}
</script>

</body>
</html>
