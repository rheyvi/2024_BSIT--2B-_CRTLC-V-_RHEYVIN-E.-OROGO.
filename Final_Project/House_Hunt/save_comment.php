<?php
include_once "db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $comment = $_POST['comment'];
    // Assuming you have a user authentication system and $_SESSION['user_id'] holds the current user's ID
    $user_id = $_SESSION['user_id']; 

    // SQL query to insert comment into the database
    $sql = "INSERT INTO comments (user_id, Comment) VALUES ('$user_id', '$comment')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page after submitting the comment
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
