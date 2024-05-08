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

    // Fetch posts from followed users
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT posts.*, users.email FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id IN (SELECT followee_id FROM followers WHERE follower_id = ?) ORDER BY posts.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Chairo Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Feed</h1>
    </header>
    <nav>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <section class="content">
        <h2>Feed</h2>
        <!-- New post button -->
        <a href="new_post.php" class="new-post-btn">New Post</a>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="post">
                <img src="uploads/<?php echo $row['image']; ?>" alt="Post Image">
                <p><?php echo $row['caption']; ?></p>
                <div class="actions">
                    <form action="like_post.php" method="POST">
                        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="like">Like</button>
                    </form>
                    <span class="like-count"><?php echo get_likes_count($row['id']); ?></span>
                </div>
                <h3>Comments:</h3>
                <?php 
                    $comments = get_comments($row['id']);
                    foreach ($comments as $comment) {
                        echo "<p>{$comment['email']}: {$comment['comment']}</p>";
                    }
                ?>
                <form action="comment_post.php" method="POST">
                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="comment" placeholder="Add a comment...">
                    <button type="submit">Post</button>
                </form>
            </div>
        <?php endwhile; ?>
    </section>
    <footer>
        <p>&copy; 2024 Chairo Social</p>
    </footer>
</body>
</html>
<?php
    function get_likes_count($post_id) {
        global $conn;
        $sql = "SELECT COUNT(*) AS count FROM likes WHERE post_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'];
        return $count;
    }

    function get_comments($post_id) {
        global $conn;
        $sql = "SELECT comments.*, users.email FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        return $comments;
    }
?>
