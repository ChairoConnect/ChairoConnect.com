<?php
    // Include database connection
    include('db_connection.php');

    // Start session
    session_start();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL statement to retrieve user data
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // Verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['bitmoji'] = $row['bitmoji'];

                // Redirect to profile page
                header("Location: profile.php");
                exit();
            } else {
                // Incorrect password
                $error_message = "Incorrect password";
            }
        } else {
            // User not found
            $error_message = "User not found";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Chairo Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Log In</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </nav>
    <section class="content">
        <h2>Welcome back!</h2>
        <!-- Log in form -->
        <form action="login.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Log In</button>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Chairo Social</p>
    </footer>
</body>
</html>
