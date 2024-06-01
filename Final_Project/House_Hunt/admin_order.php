<?php
include 'db.php';

// Handle Confirm action
if (isset($_POST['confirm'])) {
    $paymentId = $_POST['paymentId'];
    $sql = "UPDATE payment SET Status='Done' WHERE paymentId=$paymentId";
    $conn->query($sql);
}

// Handle Delete action
if (isset($_POST['delete'])) {
    $paymentId = $_POST['paymentId'];
    $sql = "DELETE FROM payment WHERE paymentId=$paymentId";
    $conn->query($sql);
}

$sql = "SELECT * FROM payment";
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
    <title>Payments</title>
</head>
<body>
<div class="nav-buttons">
        <!-- Add buttons with icons -->
       <a href="admin_report.php"class="btn btn-report"><i class="fas fa-file-alt icon"></i>Report</a>
   </div>
    
    <h1>Payment Records</h1>
    <table>
        <tr>
            <th>Payment ID</th>
            <th>User ID</th>
            <th>House ID</th>
            <th>Fullname</th>
            <th>Email Address</th>
            <th>Contact Number</th>
            <th>Bank</th>
            <th>Payment Method</th>
            <th>Account Number</th>
            <th>Deposit Amount</th>
            <th>Reference Number</th>
            <th>Note</th>
            <th>Status</th>
            <th>Date Input</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["paymentId"]."</td>";
                echo "<td>".$row["user_id"]."</td>";
                echo "<td>".$row["houseId"]."</td>";
                echo "<td>".$row["Fullname"]."</td>";
                echo "<td>".$row["Email_Address"]."</td>";
                echo "<td>".$row["Contact_Number"]."</td>";
                echo "<td>".$row["Bank"]."</td>";
                echo "<td>".$row["Payment_Method"]."</td>";
                echo "<td>".$row["Account_Number"]."</td>";
                echo "<td>".$row["Deposit_Amount"]."</td>";
                echo "<td>".$row["Reference_Number"]."</td>";
                echo "<td>".$row["Note"]."</td>";
                echo "<td>".$row["Status"]."</td>";
                echo "<td>".$row["Date_Input"]."</td>";
                echo "<td>
                    <form method='post'>
                        <input type='hidden' name='paymentId' value='".$row["paymentId"]."'>
                        <input type='submit' name='confirm' value='Confirm'>
                    </form>
                    <form method='post'>
                        <input type='hidden' name='paymentId' value='".$row["paymentId"]."'>
                        <input type='submit' name='delete' value='Delete'>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
