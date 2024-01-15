<?php
include 'db_connection.php';
include 'Tweet.php';

$showAllTweets = new Tweet($db);
$showAllTweets->getAllTweets();
?>