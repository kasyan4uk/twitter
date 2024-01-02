<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../frontend/dist/myPage.html");
            exit();
        } else {
            echo "<script>alert('Неправильний логін або пароль');</script>";
            echo "<script>window.location.href = '../frontend/dist/index.html';</script>";
        }
    } else {
        echo "Помилка запиту до бази даних: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

