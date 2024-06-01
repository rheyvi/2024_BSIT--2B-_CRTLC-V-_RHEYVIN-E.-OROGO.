<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div class="container">
    <button class="back-button" onclick="window.location.href='login.php'">Back</button>
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="birthday">Birthday:</label>
        <div class="birthday-select">
            <select id="birth-month" name="birth-month" required>
                <option value="">Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select id="birth-day" name="birth-day" required>
                <option value="">Day</option>
                <script>
                    for (let i = 1; i <= 31; i++) {
                        document.write('<option value="' + (i < 10 ? '0' + i : i) + '">' + i + '</option>');
                    }
                </script>
            </select>
            <select id="birth-year" name="birth-year" required>
                <option value="">Year</option>
                <script>
                    let currentYear = new Date().getFullYear();
                    for (let i = currentYear; i >= 1900; i--) {
                        document.write('<option value="' + i + '">' + i + '</option>');
                    }
                </script>
            </select>
        </div>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <input type="submit" value="Sign Up">
    </form>
</div>

<video class="video-background" autoplay muted loop>
    <source src="video/loginsignupBG (2).mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>
</body>
</html>


<?php
include_once "db.php";

// If the connection is successful, you can proceed with your form submission logic here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $birth_month = $_POST['birth-month'];
    $birth_day = $_POST['birth-day'];
    $birth_year = $_POST['birth-year'];
    $birthday = "$birth_year-$birth_month-$birth_day";
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email_address = ? OR phone_number = ?");
    $stmt->bind_param("sss", $username, $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If any of the fields already exist, display appropriate error message
        echo "<script>alert('Username, email, or contact number is already in use. Please choose different ones.');</script>";
    } else {
        // If none of the fields exist, proceed with registration
        $stmt = $conn->prepare("INSERT INTO users (fullname, email_address, password, username, birthday, sex, address, phone_number, date_login)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->bind_param("ssssssss", $fullname, $email, $password, $username, $birthday, $gender, $address, $phone);

        if ($stmt->execute()) {
            // Display success message using JavaScript alert
            echo '<script>alert("New record created successfully"); window.location.href = "login.php";</script>';
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
