<?php
include 'db_connection.php';

$sql = "SELECT * FROM tweets ORDER BY create_date DESC";
$result = $conn->query($sql);

$tweets = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tweets[] = array('content' => $row["content"]);
    }
}

header('Content-Type: application/json');
echo json_encode($tweets);

$conn->close();
?>