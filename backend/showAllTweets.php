<?php
include 'db_connection.php';

$sql = "SELECT content FROM tweets ORDER BY create_date DESC";
$stmt = $conn->prepare($sql);

$tweets = [];

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tweets[] = array('content' => $row["content"]);
        }
    }
    $stmt->close();
} 

header('Content-Type: application/json');
echo json_encode($tweets);

$conn->close();
?>