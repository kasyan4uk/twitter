<?php
include 'db_connection.php';
include 'User.php';

$userManager = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userManager->loginUser($username, $password);
}
?>

