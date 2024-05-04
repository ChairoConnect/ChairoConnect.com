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

    // Retrieve user data
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Close statement
    $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Chairo Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <nav>
        <ul>
            <li><a href="feed.php">Feed</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <section class="content">
        <h2>Welcome, <?php echo $user['email']; ?></h2>
        <!-- Display user's info, images, and Bitmoji -->
        <div id="profile-info">
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Bitmoji: <?php echo $user['bitmoji']; ?></p>
        </div>
        <h2>Virtual Locker</h2>
        <!-- Display user's image drop locations -->
        <div id="locker">
            <!-- Placeholder for image drop locations -->
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Chairo Social</p>
    </footer>
</body>
</html>
