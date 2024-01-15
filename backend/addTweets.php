<?php
include 'db_connection.php';
include 'Tweet.php';

$addTweet = new Tweet($db);

session_start();
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitTweet'])) {
        $tweetContent = $_POST['tweetContent'];
        $addTweet->addTweet($tweetContent, $currentUserId);
    }
}
?>

