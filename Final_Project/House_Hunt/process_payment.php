<?php
include_once 'db.php';
session_start();

function gen_order_ref_number($len) {
    $alpha_num = array(
        'A','B','C','D','E','F','G','H','I','J',
        'K','L','M','N','O','P','Q','R','S','T',
        'U','V','W','X','Y','Z','0','1','2','3',
        '4','5','6','7','8','9','0'
    );
    $key = "";
    for ($i = 0; $i <= $len; $i++) {
        if($i % 2 == 0 && $i > 0) {
            $key .= $alpha_num[rand(0, 25)];
        } else {
            $key .= $alpha_num[rand(26, sizeof($alpha_num) - 1)];
        }
    }
    return $key;
}

if (isset($_POST['payment_method'])) {
    if (!isset($_SESSION['user_id'])) {
        die('User is not logged in.');
    }

    $user_id = $_SESSION['user_id'];
    $house_id = $_POST['houseId'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $bank = $_POST['bank'];
    $payment_method = $_POST['payment_method'];
    $account_number = $_POST['account_number'];
    $deposit_amount = $_POST['deposit_amount'];
    $note = $_POST['note'];

    // Generate the order reference number
    $order_ref_number = gen_order_ref_number(10);

    // Check if user_id exists in the users table
    $user_check_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $user_check_result = mysqli_query($conn, $user_check_query);

    if (mysqli_num_rows($user_check_result) == 0) {
        die('User does not exist.');
    }

    $sql_insert_payment = "INSERT INTO payment (
                                user_id, houseId, Fullname, Email_Address, 
                                Contact_Number, Bank, Payment_Method, 
                                Account_Number, Deposit_Amount, Note, 
                                Status, Date_Input, Reference_Number
                            ) VALUES (
                                '$user_id', '$house_id', '$fullname', '$email', 
                                '$contact', '$bank', '$payment_method', 
                                '$account_number', '$deposit_amount', '$note', 
                                'Pending', NOW(), '$order_ref_number'
                            )";

    $execute_insert_payment = mysqli_query($conn, $sql_insert_payment);

    if ($execute_insert_payment) {
        echo '<script>alert("This is your Reference Number: ' . $order_ref_number . ' . Please Take Note."); window.location.href = "view_property.php";</script>';
    } else {
        // Display detailed error information for debugging
        echo "Error: " . mysqli_error($conn);
    }
}
?>
