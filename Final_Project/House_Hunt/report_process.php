<?php
include_once "db.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $total_clients = $_POST['total_clients'];
    $start_month = $_POST['start_month'];
    $start_year = $_POST['start_year'];
    $end_month = $_POST['end_month'];
    $end_year = $_POST['end_year'];
    $total_sales = $_POST['total_sales'];

    // Combine start month and year into a single date string
    $start_date = $start_year . '-' . $start_month . '-01';
    // Combine end month and year into a single date string
    $end_date = $end_year . '-' . $end_month . '-01';

    // SQL query to insert data into the database
    $sql = "INSERT INTO money (StartMonthYear, EndMonthYear, TotalClients, TotalSales, dateinput)
            VALUES ('$start_date', '$end_date', '$total_clients', '$total_sales', CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully"); window.location.href = "admin_report.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
