   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>House Listings</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/view_property.css">


      <!-- chatbot link -->
      <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
      <script src="https://mediafiles.botpress.cloud/e7255614-4188-45fb-8237-d41f12df4a7c/webchat/config.js" defer></script>


   </head>
   <body>
      
   <!-- header section starts  -->

   <header class="header">

      <nav class="navbar nav-1">
         <section class="flex">
            <a href="home.html" class="logo"><i class="fas fa-house"></i>HouseHunt</a>
            <a href="login.php" class="logout-btn">Logout</a>
         </section>
      </nav>
      <nav class="navbar nav-2">
         <section class="flex">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div class="menu">
               <ul>
                  <li><a href="#">Help<i class="fas fa-angle-down"></i></a>
                     <ul>
                     <li><a href="about.php">About Us</a></i></li>
                     <li><a href="contact.html">Contact Us</a></i></li>
                     <li><a href="contact.html#faq">FAQ</a></i></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </section>
      </nav>
   </header>

   <!-- header section ends -->

   <!-- House Listings section -->
   <div class="container">
      <h2>House Listings</h2>
      <?php
         // Start the session to access user_id
      session_start();

      // Dummy user_id for demonstration, replace this with the actual user_id
      $user_id = 123; // Example: $_SESSION['user_id'];

      // Include your database connection file
      include_once "db.php";
      // Fetch house listings from the database
      $result = $conn->query("SELECT * FROM houses");

      if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            // Display each house listing
            echo "<div class='house'>";
            echo "<img src='images/" . $row['image'] . "' alt='' >";
            echo "<h3>" . $row['item_name'] . "</h3>";
            echo "<h4> Details: <br> </h4>";
            echo "<br>";
            echo "<h5>" . $row['location'] . "</h5>";
            echo "<br>";
            echo "<h5>BHK: " . $row['BHK'] . "</h5>";
            echo "<br>";
            echo "<h5>Price: " . $row['price'] . "</h5>";
            echo "<br>";
            echo "<h5>Type: " . $row['type']. "</h5>";
            echo "<br>";
            echo "<button class='buy-btn' onclick=\"window.location.href='payment_user_form.html?houseId=" . $row['houseId'] . "&userId=" . $user_id . "'\">Buy</button>"; //Buy Button
            echo "</div>";
         }
      } else {
         echo "<p>No houses available.</p>";
      }

      // Close the database connection
      $conn->close();
      ?>

   </div>

   <!-- footer section starts  -->
   <footer class="footer">
      <section class="flex">
         <div class="box">
            <a href="tel:0900000000"><i class="fas fa-phone"></i><span>123456789</span></a>
            <a href="househunt@gmail.com"><i class="fas fa-envelope"></i><span>househunt@gmail.com</span></a>
            <a href="#"><i class="fas fa-map-marker-alt"></i><span>Manila, Philippines</span></a>
         </div>
         <div class="box">
            <a href="home.html"><span>home</span></a>
            <a href="about.php"><span>about</span></a>
            <a href="contact.html"><span>contact</span></a>
         </div>
         <div class="box">
            <a href="#"><span>facebook</span><i class="fab fa-facebook-f"></i></a>
            <a href="#"><span>twitter</span><i class="fab fa-twitter"></i></a>
            <a href="#"><span>linkedin</span><i class="fab fa-linkedin"></i></a>
            <a href="#"><span>instagram</span><i class="fab fa-instagram"></i></a>
         </div>
      </section>
      <div class="credit">&copy; copyright @ 2022 by <span>CRTL_C-V</span> | all rights reserved!</div>
   </footer>

   <!-- footer section ends -->

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   </body>
   
   </html>

   <?php
   