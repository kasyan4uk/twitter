<?php
include 'Database.php';

$servername = "db";
$username = "root";
$password = "1111";
$dbname = "twitter";

$db = new Database($servername, $username, $password, $dbname);
$conn = $db->getConnection();
?>