   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>About Us</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">

      <!-- chatbot link -->
      <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
      <script src="https://mediafiles.botpress.cloud/e7255614-4188-45fb-8237-d41f12df4a7c/webchat/config.js" defer></script>

      <style>
         /* Add custom CSS here */

         .comment-box {
         border: 1px solid #ccc;
         padding: 10px;
         margin-bottom: 20px;
         }

         .box-header {
            font-weight: bold;
         }

         .box-content {
            margin-top: 5px;
         }


         .reviews .review-form {
            margin-top: 20px;
         }

         .reviews .reviews-container .box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         }

         .reviews .reviews-container .box .user h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
         }

         .reviews .reviews-container .box .stars i {
            font-size: 1.5em;
            color: gold;
         }

         .reviews .reviews-container .box p {
            font-size: 1.2em;
            line-height: 1.5em;
            margin-top: 10px;
         }

         .reviews .heading {
            margin-bottom: 20px;
         }
      </style>
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

   <!-- about section starts  -->

   <section class="about">

      <div class="row">
         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>
         <div class="content">
            <h3>why choose us?</h3>
            <p>HouseHunt offers a comprehensive selection of properties, including houses, flats, and shops, ensuring you 
               find the perfect space for your needs. Our dedicated team provides exceptional service, guiding you through every 
               stage of the process with expertise and care.
               Trust HouseHunt for quality assurance and a seamless experience in finding your dream property.</p>
            <a href="contact.html" class="inline-btn">contact us</a>
         </div>
      </div>

   </section>

   <!-- about section ends -->

   <!-- steps section starts  -->

   <section class="steps">

      <h1 class="heading">3 simple steps</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>Search Property</h3>
            <p>Find your perfect property quickly and easily with our intuitive and detailed listings.</p>
      </div>
      
      <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>Contact Agents</h3>
            <p>Connect with our dedicated agents who are ready to assist you every step of the way.</p>
      </div>
      
      <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>Enjoy Property</h3>
            <p>Settle into your new space and start making unforgettable memories today.</p>
      </div>     

      </div>

   </section>

   <!-- steps section ends -->

   <!-- comment section starts -->

   <section class="comments">
   <h2 class="heading">Comments</h2>
   <div class="comment-form">
      <form method="post" action="save_comment.php">
         <textarea name="comment" placeholder="Write your comment here" required></textarea>
         <button type="submit">Submit</button>
      </form>
   </div>
   <div class="comment-list">
      <?php
      // Retrieve comments from the database and display them with user names
      include_once "db.php";
      $sql = "SELECT comments.*, users.username FROM comments INNER JOIN users ON comments.user_id = users.user_id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            echo "<div class='comment-box'>";
            echo "<div class='box-header'>" . $row['username'] . " says:</div>";
            echo "<div class='box-content'>" . $row['Comment'] . "</div>";
            echo "</div>";
         }
      } else {
         echo "No comments yet.";
      }
      ?>
   </div>
</section>


   <!-- comment section ends -->







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
