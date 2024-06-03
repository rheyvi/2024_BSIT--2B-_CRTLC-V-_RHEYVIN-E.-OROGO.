<?php
include_once "db.php";

// Insert data into the 'houses' table
$sql = "INSERT INTO houses (location, price, description, image_url)
VALUES
('Modern Apartment', 'Manila, Philippines', 15000000.00, 'A modern apartment with stunning views.', 'images/modern_apartment.jpg'),
('Cozy House', 'Quezon City, Philippines', 8500000.00, 'A cozy house with a spacious backyard.', 'images/cozy_house.jpg'),
('Luxury Villa', 'Cebu, Philippines', 25000000.00, 'A luxurious villa with a private pool.', 'images/luxury_villa.jpg')";

if ($conn->query($sql) === TRUE) {
  echo "Data inserted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>
