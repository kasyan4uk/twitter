<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        header("Location: ../frontend/dist/myPage.html");
        exit();
    } else {
        echo "<script>alert('Такий користувач вже існує');</script>";
        echo "<script>window.location.href = '../frontend/dist/index.html';</script>";
    }

    $conn->close();
}
?>