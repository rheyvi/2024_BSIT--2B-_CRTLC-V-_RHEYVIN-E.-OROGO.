<?php
include_once "db.php";
session_start();

// Check if the login form is submitted
if (isset($_POST['username'])) {
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    
    // Use prepared statement to prevent SQL injection
    $sql_check_user_info = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql_check_user_info);
    mysqli_stmt_bind_param($stmt, 'ss', $uname, $pword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $count_result = mysqli_num_rows($result);
    
    if ($count_result == 1) {
        // Existing user
        $row = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $row['user_id'];  // Set the user ID from database to session
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['user_type'] = $row['user_type'];
    
        if ($row['user_type'] == 'Admin') {
            // Admin
            header("Location: admin_add.php");
            exit();
        } else if ($row['user_type'] == 'Customer') {
            // Common user
            header("Location: home.html");
            exit();
        }
    } else {
        echo '<script>alert("ERROR!! user_does_not_exist"); window.location.href = "login.php";</script>';
        exit();
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
