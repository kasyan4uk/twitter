<?php
include 'db_connection.php';
include 'User.php';

$userManager = new User($db);
$userManager->logoutUser();
?>