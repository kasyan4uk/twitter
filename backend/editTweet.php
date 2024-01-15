<?php
include 'db_connection.php';
include 'Tweet.php';

$editTweet = new Tweet($db);

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data !== null && isset($data['tweetId'], $data['newContent'])) {
    $tweetId = intval($data['tweetId']);
    $newContent = $data['newContent'];
    $editTweet->editTweet($tweetId, $newContent);
}
?>