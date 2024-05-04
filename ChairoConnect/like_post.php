<?php
    // Include database connection
    include('db_connection.php');

    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Handle post likes
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];

        // Check if user already liked the post
        $sql = "SELECT * FROM likes WHERE user_id = ? AND post_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert like
            $sql = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $post_id);
            $stmt->execute();
        }
        
        // Redirect back to feed
        header("Location: feed.php");
        exit();
    }
?>
