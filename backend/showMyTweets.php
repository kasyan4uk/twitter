<?php
include 'db_connection.php';
include 'Tweet.php';

$showMyTweets = new Tweet($db);

session_start();
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
    $showMyTweets->getTweetsByUserId($currentUserId);
} else {
    echo json_encode([]);
}
?>
