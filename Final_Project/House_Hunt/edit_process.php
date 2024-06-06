<?php
include_once "db.php";

// Fetch current data for editing
if (isset($_GET['houseId'])) {
    $houseId = $_GET['houseId'];
    echo "House ID received: " . $houseId . "<br>"; // Debugging output

    // Fetch current data
    $sql = "SELECT * FROM houses WHERE houseId=$houseId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No record found!";
        exit;
    }
} else {
    echo "ID not set!";
    exit;
}

// Handle the form submission for updating
if (isset($_POST['update_product'])) {
    $houseId = $_POST['houseId'];
    $item_name = $_POST['product_name'];
    $item_location = $_POST['product_location'];
    $item_price = $_POST['product_price'];
    $item_BHK = $_POST['product_bhk'];
    $item_type = $_POST['product_type'];

    $update_img = "";
    if (isset($_FILES["product_image"]) && !empty($_FILES["product_image"]["name"])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $update_img = ", image='" . basename($_FILES["product_image"]["name"]) . "'";
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update query
    $sql_update = "UPDATE houses SET item_name='$item_name', location='$item_location', price='$item_price', BHK='$item_BHK', type='$item_type' $update_img WHERE houseId=$houseId";

    if (mysqli_query($conn, $sql_update)) {
        echo "Record updated successfully!";
        header("Location: admin_page.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="container">

<video autoplay muted loop id="video-background">
    <source src="video/loginsignupBG.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

    <div class="admin-product-form-container">
        <form id="edit_product_form" enctype="multipart/form-data">
            <h3>Edit Product</h3>
            <input type="hidden" id="houseId" name="houseId" value="<?php echo $row['houseId']; ?>">
            <input type="text" placeholder="Enter Name" id="product_name" name="product_name" class="box" value="<?php echo $row['item_name']; ?>">
            <input type="text" placeholder="Enter Location" id="product_location" name="product_location" class="box" value="<?php echo $row['location']; ?>">
            <input type="text" placeholder="Enter Price" id="product_price" name="product_price" class="box" value="<?php echo $row['price']; ?>">
            <select id="product_bhk" name="product_bhk" class="box">
                <option value="1" <?php if ($row['BHK'] == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if ($row['BHK'] == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if ($row['BHK'] == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if ($row['BHK'] == 4) echo 'selected'; ?>>4</option>
                <option value="5" <?php if ($row['BHK'] == 5) echo 'selected'; ?>>5</option>
            </select>
            <select id="product_type" name="product_type" class="box">
                <option value="flat" <?php if ($row['type'] == 'flat') echo 'selected'; ?>>Flat</option>
                <option value="shop" <?php if ($row['type'] == 'shop') echo 'selected'; ?>>Shop</option>
                <option value="house" <?php if ($row['type'] == 'house') echo 'selected'; ?>>House</option>
            </select>
            <input type="file" id="product_image" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <button type="button" id="update_product_btn" class="btn">Update Product</button>
        </form>
    </div>
</div>

<script>
document.getElementById('update_product_btn').addEventListener('click', function() {
    var formData = new FormData(document.getElementById('edit_product_form'));
    formData.append('update_product', '1'); // Add flag for update_product

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'edit_process.php');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Display response message
            location.reload(); // Reload the page after update
        } else {
            alert('Error updating record: ' + xhr.statusText);
        }
    };
    xhr.send(formData);
});
</script>

</body>
</html>

