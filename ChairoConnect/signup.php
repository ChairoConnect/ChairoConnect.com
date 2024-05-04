<?php
    // Include database connection
    include('db_connection.php');

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bitmoji = $_POST['bitmoji']; // Assuming user uploads their bitmoji

        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data
        $sql = "INSERT INTO users (email, password, bitmoji) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $hashed_password, $bitmoji);

        // Execute SQL statement
        if ($stmt->execute()) {
            // User sign up successful
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            // Error handling
            echo "Error: " . $conn->error;
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
    <title>Sign Up - Chairo Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Sign Up</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Log In</a></li>
        </ul>
    </nav>
    <section class="content">
        <h2>Create an account</h2>
        <!-- Sign up form -->
        <form action="signup.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="bitmoji">Bitmoji:</label><br>
            <input type="text" id="bitmoji" name="bitmoji" required><br>
            <button type="submit">Sign Up</button>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Chairo Social</p>
    </footer>
</body>
</html>
