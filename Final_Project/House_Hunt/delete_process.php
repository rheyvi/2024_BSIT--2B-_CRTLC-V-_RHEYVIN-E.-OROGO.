<?php
include_once "db.php";
session_start();

if(isset($_GET['houseId'])) {
    $houseId = $_GET['houseId'];
    echo "House ID received: " . $houseId . "<br>"; // Debugging output
    
    // Prepare statement to delete item from database
    $stmt = $conn->prepare("DELETE FROM houses WHERE houseId = ?");
    $stmt->bind_param("i", $houseId);
    
    if($stmt->execute()) {
        echo '<script>alert("Product deleted successfully!"); window.location.href = "admin_add.php";</script>';
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
