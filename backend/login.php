<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../frontend/dist/myPage.html");
            exit();
        } else {
            echo "<script>alert('Неправильний логін або пароль');</script>";
            echo "<script>window.location.href = '../frontend/dist/index.html';</script>";
        }
    } else {
        echo "Помилка запиту до бази даних: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

