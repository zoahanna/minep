<?php
// Database configuration
$host = 'localhost';
$dbname = 'comment_system';
$username = 'admin';
$password = 'laudadatcam';

// Connect to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $comment = trim($_POST['comment']);

    if (empty($comment)) {
        die("PassPhrase is required.");
    }

    // Hash the comment using SHA-256
    $hashedComment = hash('sha256', $comment);

    $stmt = $conn->prepare("SELECT COUNT(*) FROM comments WHERE comment = ?");
    $stmt->execute([$hashedComment]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
    echo "Password found in system!";
    include 'loginfail.html';
    } else {
    // Insert the hashed comment into the database
    $stmt = $conn->prepare("INSERT INTO comments (comment) VALUES (:comment)");
    $stmt->execute([
        'comment' => $hashedComment
    ]);
    include 'loginsuccess.html';
    }
}
?>
