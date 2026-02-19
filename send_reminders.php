<?php
// Database connection settings
$host = "localhost";
$dbname = "adhkar_reminder";
$username = "root";
$password = "";

$subject = "تذكير بقراءة الأذكار اليومية";

// Email message (HTML format)
$message = "
<html>
<head>
<title>تذكير بالأذكار</title>
</head>
<body>
<h2>السلام عليكم ورحمة الله وبركاته</h2>
<p>هذا تذكيرك اليومي بقراءة الأذكار الصباحية والمسائية.</p>
<p>نسأل الله أن يتقبل منك ويبارك في وقتك.</p>
</body>
</html>
";

// Email headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: adhkar@example.com\r\n";

try {
    // Create database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch subscribers emails
    $stmt = $conn->query("SELECT email FROM subscribers");
    $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send email to each subscriber
    foreach ($subscribers as $subscriber) {
        mail($subscriber['email'], $subject, $message, $headers);
    }

    echo "تم إرسال التذكيرات بنجاح!";
} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
?>
