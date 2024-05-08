<?php
    // Include database connection
    include('db_connection.php');

    // Start session
    session_start();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare SQL statement to retrieve user data
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // Verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

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