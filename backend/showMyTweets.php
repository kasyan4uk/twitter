<?php
include 'db_connection.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];

    $sql = "SELECT id, content FROM tweets WHERE user_id = ? ORDER BY create_date DESC";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $currentUserId);
        $stmt->execute();

        $result = $stmt->get_result();

        $tweets = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tweets[] = array(
                    'id' => $row["id"],
                    'content' => $row["content"]
                );
            }
        }
        $stmt->close();
    } 
    header('Content-Type: application/json');
    echo json_encode($tweets);
} else {
    echo json_encode([]);
}

$conn->close();
?>
