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

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        
        // File upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow only certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = basename($_FILES["image"]["name"]);
                $caption = $_POST['caption'];

                // Insert post into database
                $sql = "INSERT INTO posts (user_id, image, caption) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $user_id, $image, $caption);
                $stmt->execute();
                
                header("Location: feed.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post - Chairo Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>New Post</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="feed.php">Feed</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <section class="content">
        <h2>Create a new post</h2>
        <!-- Post form -->
        <form action="new_post.php" method="POST" enctype="multipart/form-data">
            <label for="image">Select Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required><br>
            <label for="caption">Caption:</label><br>
            <textarea id="caption" name="caption" required></textarea><br>
            <button type="submit">Post</button>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Chairo Social</p>
    </footer>
</body>
</html>
