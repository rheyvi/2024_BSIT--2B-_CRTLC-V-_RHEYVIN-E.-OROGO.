<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Report</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Report.css">
   
</head>
<body>
    
   <div class="nav-buttons">
        <!-- Add buttons with icons -->
        <a href="admin_add.php" class="btn btn-add"><i class="fas fa-plus icon"></i>Add</a>
       <a href="admin_order.php" class="btn btn-order"><i class="fas fa-shopping-cart icon"></i>Order</a>
   </div>
    
   
   <div class="product-display"> 
   <form method="post" action="report_process.php">
   
    <table class="product-display-table">
        <thead>
            <tr>
                <th>Total Client(s)</th>
                <th>Start Month-Year</th>
                <th>End Month-Year</th>
                <th>Total Sales</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="total_clients" placeholder="Total Clients"></td>
                <td>
                    <select name="start_month" id="start_month" required>
                        <option value="">Month</option>
                        <?php
                        // Generate options for start month
                        for ($i = 1; $i <= 12; $i++) {
                            $month = date('F', mktime(0, 0, 0, $i, 1));
                            echo "<option value='$i'>$month</option>";
                        }
                        ?>
                    </select>
                    <select name="start_year" id="start_year" required>
                        <option value="">Year</option>
                        <?php
                        // Generate options for start year (adjust range as needed)
                        $current_year = date('Y');
                        for ($i = $current_year; $i >= ($current_year - 100); $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="end_month" id="end_month" required>
                        <option value="">Month</option>
                        <?php
                        // Generate options for end month
                        for ($i = 1; $i <= 12; $i++) {
                            $month = date('F', mktime(0, 0, 0, $i, 1));
                            echo "<option value='$i'>$month</option>";
                        }
                        ?>
                    </select>
                    <select name="end_year" id="end_year" required>
                        <option value="">Year</option>
                        <?php
                        // Generate options for end year (adjust range as needed)
                        $current_year = date('Y');
                        for ($i = $current_year; $i >= ($current_year - 100); $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        
                        ?>
                    </select>
                </td>
                <td><input type="text" name="total_sales" placeholder="Total Sales"></td>
                <td>
                    <button class="btn add-btn"> <i class="fas fa-plus"></i> Add </button>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
</div>

</body>
</html>
