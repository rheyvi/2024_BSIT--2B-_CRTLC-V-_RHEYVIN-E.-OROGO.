<?php
include 'db.php';

// Start the session
session_start();

// Get monthly payment from the database
$sql = "SELECT monthly_payment FROM houses WHERE houseId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$monthly_payment = $row['monthly_payment'];

// Assuming user_id is stored in the session
$user_id = $_SESSION['user_id'];

// Handle Cancel action
if (isset($_POST['cancel'])) {
    $paymentId = $_POST['paymentId'];
    $sql = "UPDATE payment SET Status='Cancelled' WHERE paymentId=$paymentId";
    $conn->query($sql);
}

// Modify the SQL query to join houses and payment tables, and filter by user_id
$sql = "SELECT p.*, h.item_name FROM payment p JOIN houses h ON p.houseId = h.houseId WHERE p.user_id = $user_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/admin_order.css">
    <title>User-Order</title>
</head>
<body>
<div class="nav-buttons">
    <!-- Add buttons with icons -->
    <a href="view_property.php" class="btn btn-report">Back</a>
</div>
    

<h1>Your Orders</h1>
<table>
    <tr>
        <th>House Name</th>
        <th>Fullname</th>
        <th>Email Address</th>
        <th>Contact Number</th>
        <th>Bank</th>
        <th>Payment Method</th>
        <th>Account Number</th>
        <th>Deposit Amount</th>
        <th>Reference Number</th>
        <th>Date Input</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["item_name"]."</td>";
            echo "<td>".$row["Fullname"]."</td>";
            echo "<td>".$row["Email_Address"]."</td>";
            echo "<td>".$row["Contact_Number"]."</td>";
            echo "<td>".$row["Bank"]."</td>";
            echo "<td>".$row["Payment_Method"]."</td>";
            echo "<td>".$row["Account_Number"]."</td>";
            echo "<td>".$monthly_payment."</td>"; // Monthly payment value here
            echo "<td>".$row["Reference_Number"]."</td>";
            echo "<td>".$row["Date_Input"]."</td>";
            echo "<td>
            <form method='post' action='payment_user_form.php?houseId=".$row['houseId']."'>
                <input type='submit' name='pay' value='Pay Again'>
            </form>
                <form method='post'>
                    <input type='hidden' name='paymentId' value='".$row["paymentId"]."'>
                    <input type='submit' name='cancel' value='Cancel Payment'>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No records found</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>
