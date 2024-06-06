<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment_user_form.css">

    <!-- chatbot link -->
    <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
    <script src="https://mediafiles.botpress.cloud/e7255614-4188-45fb-8237-d41f12df4a7c/webchat/config.js" defer></script>

    <title>Enter Payment Details</title>
    <script>
        // Function to get URL parameters
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            let results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Get houseId and userId from URL
            let houseId = getParameterByName('houseId');

            // Set hidden input values
            document.getElementById('houseId').value = houseId;
            document.getElementById('userId').value = userId;
        });
    </script>
</head>
<body>
    <video autoplay muted loop id="background-video">
        <source src="video/homevideoBG(2).mp4" type="video/mp4">
        Your browser does not support the video tag.
     </video>
     <div class="container">
        <button class="back-button" onclick="window.location.href='view_property.php'">Back</button>
        <form id="payment-form" method="POST" action="process_payment.php">
            <h2>Enter Payment Details</h2>

            <?php
            include_once "db.php";
            $houseId = $_GET['houseId'];

            // Fetch house details from the database
            $sql = "SELECT monthly_payment FROM houses WHERE houseId = $houseId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $formatted_monthly_payment = number_format($row['monthly_payment'], 2);
            ?>

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required><br>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required><br>
            <label for="bank">Bank:</label>
            <select id="bank" name="bank" required>
                <option value="BDO">BDO</option>
                <option value="Landbank">Landbank</option>
                <option value="Chinabank">Chinabank</option>
            </select><br>
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Debit">Debit</option>
                <option value="Credit">Credit</option>
            </select><br>
            <label for="account_number">Account Number:</label>
            <input type="text" id="account_number" name="account_number" required><br>
            <input type="text" id="deposit_amount" name="deposit_amount" value="₱<?php echo $formatted_monthly_payment; ?>" readonly><br>
            <label for="note">Note:</label>
            <textarea id="note" name="note"></textarea><br>
            <input type="hidden" id="houseId" name="houseId">  
            <input type="hidden" id="userId" name="userId">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
