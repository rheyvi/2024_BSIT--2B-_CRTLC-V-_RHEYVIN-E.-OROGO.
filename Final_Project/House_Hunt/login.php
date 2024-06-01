<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Video Background -->
    <video class="video-background" autoplay muted loop>
        <source src="video/loginsignupBG.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <div class="house-hunt">HOUSE</div>
        <div class="house-hunt">HUNT</div>
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
            <!-- Username with user icon -->
            <label for="username"><i class="fas fa-user"></i> Username:</label>
            <input type="text" id="username" name="username" required>
            <!-- Password with key icon and toggle button -->
            <label for="password"><i class="fas fa-key"></i> Password:</label>
            <div style="position: relative;">
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <div class="links">
            <a href="signup.php">Sign Up</a>
        </div>
    </div>

    <!-- Add Font Awesome JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
