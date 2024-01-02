<?php
include 'db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data !== null && isset($data['tweetId'], $data['newContent'])) {
    $tweetId = intval($data['tweetId']);
    $newContent = $data['newContent'];

    $sql = "UPDATE tweets SET content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $newContent, $tweetId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = array('message' => 'Твіт успішно відредаговано');
        } else {
            $response = array('message' => 'Помилка при редагуванні твіту');
        }
    } else {
        $response = array('message' => 'Помилка підготовки запиту');
    }
} else {
    $response = array('message' => 'Помилка отримання даних');
}

echo json_encode($response);

$conn->close();
?>
