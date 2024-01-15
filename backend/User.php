<?php
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function registerUser($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $user_id = $this->db->getConnection()->insert_id;
            $_SESSION['user_id'] = $user_id;
            header("Location: ../frontend/dist/myPage.html");
            exit();
        } else {
            echo "<script>alert('Такий користувач вже існує');</script>";
            echo "<script>window.location.href = '../frontend/dist/index.html';</script>";
        }

        $stmt->close();
    }

    public function loginUser($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=? AND password=?");
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
        $this->db->closeConnection();
    }

    public function logoutUser() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            session_unset();
            session_destroy();
            header("Location: ../frontend/dist/index.html");
            exit();
        }
    }
}
?>
