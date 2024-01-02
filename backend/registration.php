<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
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