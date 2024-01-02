<?php
include 'db_connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
} else {
    echo 'Error';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitTweet'])) {
        $tweetContent = $_POST['tweetContent'];
        $sql = "INSERT INTO tweets (content, user_id) VALUES ('$tweetContent', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../frontend/dist/myPage.html");
            exit();
        } else {
            echo "Помилка: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

