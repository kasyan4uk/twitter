<?php
class Tweet {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addTweet($tweetContent, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO tweets (content, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $tweetContent, $user_id);

        if ($stmt->execute()) {
            header("Location: ../frontend/dist/myPage.html");
            exit();
        } else {
            echo "Помилка: " . $stmt->error;
        }

        $stmt->close();
        $this->db->closeConnection();
    }

    public function editTweet($tweetId, $newContent) {
        $stmt = $this->db->prepare("UPDATE tweets SET content = ? WHERE id = ?");
        $stmt->bind_param("si", $newContent, $tweetId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = array('message' => 'Твіт успішно відредаговано');
        } else {
            $response = array('message' => 'Помилка при редагуванні твіту');
        }

        $stmt->close();
        $this->db->closeConnection();

        echo json_encode($response);
    }

    public function getTweetsByUserId($currentUserId) {
        $stmt = $this->db->prepare("SELECT id, content FROM tweets WHERE user_id = ? ORDER BY create_date DESC");

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
        } else {
            echo "Помилка підготовки запиту: " . $this->db->error;
        }

        echo json_encode($tweets);
    }

    public function getAllTweets() {
        $stmt = $this->db->prepare("SELECT content FROM tweets ORDER BY create_date DESC");

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

        echo json_encode($tweets);
    }
}
?>
