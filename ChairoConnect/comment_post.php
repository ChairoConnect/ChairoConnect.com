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

    // Handle post comments
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];

        // Insert comment into database
        $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $post_id, $user_id, $comment);
        $stmt->execute();
        
        // Redirect back to feed
        header("Location: feed.php");
        exit();
    }
?>
