<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>admin_page</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="nav-buttons">
    <a href="admin_report.php" class="btn btn-report"><i class="fas fa-file-alt icon"></i>Report</a>
    <a href="login.php" class="btn btn-logout"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
</div>

<video autoplay muted loop id="video-background">
    <source src="video/FallingSnow .mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div class="container">
    <div class="admin-product-form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>add a new product</h3>
            <input type="text" placeholder="Enter Name" name="product_name" class="box">
            <input type="text" placeholder="Enter Location" name="product_location" class="box">
            <input type="text" placeholder="Enter Price" name="product_price" class="box">
            <select name="product_bhk" class="box">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <select name="product_type" class="box">
                <option value="flat">Flat</option>
                <option value="shop">Shop</option>
                <option value="house">House</option>
            </select>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="add_product" value="add product">
        </form>
    </div>

    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr>
                    <th>product image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>BHK</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include_once "db.php";

            // Fetch data from database
            $sql = "SELECT * FROM houses";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><img src='images/" . $row['image'] . "' height='100' alt=''></td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['BHK'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo "<td><a href='edit_process.php?houseId=" . $row['houseId'] . "' class='btn'> <i class='fas fa-edit'></i> edit </a></td>";
                    echo "<td><a href='delete_process.php?houseId=" . $row['houseId'] . "' class='btn' onclick=\"return confirm('Are you sure you want to delete this product?');\"> <i class='fas fa-trash'></i> delete </a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No products found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Process New Item
if(isset($_POST['add_product'])){ // Check if form is submitted
    $uploadOk = 1; // Flag to track upload status
    $target_dir = "images/"; // Directory to upload images
    $db_filename = ""; // Initialize the variable for database filename
    
    // Check if an image file is uploaded
    if(isset($_FILES["product_image"]) && !empty($_FILES["product_image"]["name"])) {
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        $check_img = getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check_img !== false) {
            echo "File is an image - " . $check_img["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Allow only specific file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // If upload is not OK, redirect with status
        if ($uploadOk == 0) {
            header("location: admin_add.php?insert_status=99");
            exit; // Stop further execution
        } else {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
                $db_filename = basename($_FILES["product_image"]["name"]);
            } else {
                header("location: index.php?insert_status=99");
                exit; // Stop further execution
            }
        }
    } else {
        echo "No file uploaded.";
        $uploadOk = 0;
    }
    
    // Retrieve and sanitize form data
    $item_name = $_POST['product_name'];
    $item_location = $_POST['product_location'];
    $item_price = $_POST['product_price'];
    $item_price = str_replace(['₱', ','], '', $item_price); // Remove currency symbol and commas
    $item_BHK = $_POST['product_bhk'];
    $item_type = $_POST['product_type'];
    
    // Debugging output
    echo "Name: $item_name<br>";
    echo "Location: $item_location<br>";
    echo "Price: $item_price<br>";
    echo "BHK: $item_BHK<br>";
    echo "Type: $item_type<br>";
    
    // Insert the data into the database
    $sql_insert_item = "INSERT INTO `houses`
    (`item_name`, `location`, `price`, `type`, `BHK`, `image` )
    VALUES
    ('$item_name','$item_location','$item_price','$item_type','$item_BHK','$db_filename')";
    
    echo "SQL query: $sql_insert_item<br>";
    
    // Execute the query
    $execute_query=mysqli_query($conn, $sql_insert_item);
    if($execute_query) {
        echo '<script>alert("New Product Added!"); window.location.href = "admin_add.php";</script>';
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
