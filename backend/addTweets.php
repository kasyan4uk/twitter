<?php
include 'db_connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo 'Error';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitTweet'])) {
    $tweetContent = $_POST['tweetContent'];
    
    $stmt = $conn->prepare("INSERT INTO tweets (content, user_id) VALUES (?, ?)");
    $stmt->bind_param("si", $tweetContent, $user_id);

    if ($stmt->execute()) {
        header("Location: ../frontend/dist/myPage.html");
        exit();
    } else {
        echo "Помилка: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

