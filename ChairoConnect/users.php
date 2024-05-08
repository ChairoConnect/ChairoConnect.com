<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <ul>
        <?php
        // Connect to the database
        include "db_connection.php";

        // Fetch all users from the database
        $sql = "SELECT id, username FROM users";
        $result = $conn->query($sql);

        // Display the list of users
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='chat.php?user_id={$row['id']}'>{$row['username']}</a></li>";
            }
        } else {
            echo "No users found.";
        }

        // Close database connection
        $conn->close();
        ?>
    </ul>
</body>
</html>
