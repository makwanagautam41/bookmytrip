<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
   header("Location: login.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

   <!--Font Awesome CDN-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- remixicon -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

   <!-- css -->
   <link rel="stylesheet" href="assets/css/styles.css">
   <title>BookMyTrip</title>
</head>

<body>
   <div id="snackbar"><?php echo "Welcome back, " . htmlspecialchars($_SESSION['user_name']) . "!"; ?></div>
   <!-- header -->
   <header class="header" id="header">
      <nav class="nav container">
         <a href="#" class="nav__logo" id="nav__logo">
            BookMyTrip
         </a>

         <div class="nav__menu" id="nav-menu">
            <ul class="nav__list" id="nav__list">
               <li class="nav__item" id="nav-home">
                  <a href="#home" class="nav__link active-link">Home</a>
               </li>

               <li class="nav__item">
                  <a href="#about" class="nav__link">About</a>
               </li>

               <li class="nav__item">
                  <a href="#popular" class="nav__link">Services</a>
               </li>

               <li class="nav__item">
                  <a href="myTickets.php" class="nav__link">Tickets</a>
               </li>

               <li class="nav__item">
                  <a href="#" id="myBtn" class="nav__link">Profile</a>
               </li>

               <li class="nav__item">
                  <a href="logout.php" class="nav__link">LogOut</a>
               </li>
            </ul>

            <div class="nav__close" id="nav-close">
               <img src="assets/icons/close-line.svg" alt="">
            </div>
         </div>

         <div class="nav__toggle" id="nav-toggle">
            <img src="assets/icons/menu-3-line.svg" alt="">
         </div>
      </nav>
   </header>

   <!-- Popup profile start -->
   <?php
   $user_id = $_SESSION['user_id'];
   $sql = "SELECT * FROM users WHERE id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $user_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $user = $result->fetch_assoc();
   $stmt->close();
   ?>
   <div id="myModal" class="modal">
      <div class="modal-content">
         <span class="close">&times;</span>
         <h1 class="cont">My Profile</h1>
         <div class="popupform profile">
            <div class="yourname">
               <label for="yourname">Yourname :</label>
               <p><?php echo htmlspecialchars($user['name']); ?></p>
            </div>
            <div class="email">
               <label for="email">Email :</label>
               <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="mobile">
               <label for="mobile">Mobile :</label>
               <p><?php echo htmlspecialchars($user['mobile']); ?></p>
            </div>
            <div class="joined">
               <label for="joined">Joined :</label>
               <p><?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>
            <button id="editProf">Edit Profile</button>
         </div>
      </div>
   </div>
   <!-- Popup profile end -->

   <!-- popup edit profile start -->
   <div id="myEdtModal" class="modal">
      <div class="modal-content">
         <span class="edtclose">&times;</span>
         <h1 class="cont">Update Profile</h1>
         <form action="update_profile.php" method="post">
            <div class="popupform">
               <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
               <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
               <input type="text" name="mobile" placeholder="Mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required><br>
               <input type="password" name="new_password" placeholder="New Password (leave blank to keep current)"><br>
               <button type="submit">Update Profile</button>
            </div>
         </form>
      </div>
   </div>
   <!-- popup edit profile end -->

   <main class="main">
      <!-- home -->
      <section class="home section" id="home">
         <video src="assets/img/vid1.mp4" id="video" class="home__bg" loop autoplay muted></video>
         <div class="home__shadow"></div>

         <div class="home__container container grid">
            <div class="home__data">
               <h3 class="home__subtitle">
                  Welcome To BookMyTrip
               </h3>

               <h1 class="home__title">
                  Explore <br>
                  The World
               </h1>

               <p class="home__description">
                  Live the trips exploring the world, discover
                  paradises, islands, mountains and much
                  more, get your trip now.
               </p>

               <a href="booking.php" class="button">
                  Start Your Journey <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" height="30px" width="30px">
                     <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                  </svg>
               </a>
               <p class="tp" s>Top Picks</p>
            </div>

            <div class="home__cards grid">
               <article class="home__card">
                  <img src="assets/img/ctl.jpg" alt="home image" class="home__card-img">
                  <h3 class="home__card-title">Chotila</h3>
                  <div class="home__card-shadow"></div>
               </article>

               <article class="home__card">
                  <img src="assets/img/ahmbd.jpg" alt="home image" class="home__card-img">
                  <h3 class="home__card-title">Ahmedabad</h3>
                  <div class="home__card-shadow"></div>
               </article>

               <article class="home__card">
                  <img src="assets/img/rjkt.jpg" alt="home image" class="home__card-img">
                  <h3 class="home__card-title">Rajkot</h3>
                  <div class="home__card-shadow"></div>
               </article>

               <article class="home__card">
                  <img src="assets/img/srt.jpg" alt="home image" class="home__card-img">
                  <h3 class="home__card-title">Surat</h3>
                  <div class="home__card-shadow"></div>
               </article>
            </div>
         </div>
      </section>

      <!-- video -->
      <section class="video section">
         <div class="container">
            <h2 class="section__title">Video Tour</h2>
            <div class="video__container">
               <p class="video__description">Find out more with our video of the most beautiful and
                  pleasant places for you and your family.
               </p>

               <div class="video__content">
                  <video id="video-file">
                     <source src="assets/img/vid1.mp4" type="video/mp4">
                  </video>

                  <button class="button button--flex video__button" id="video-button">
                     <i class="ri-play-line video__button-icon" id="video-icon"></i>
                  </button>
               </div>
            </div>
         </div>
         <div class="video_shadow"></div>
      </section>

      <!-- join -->
      <section class="join section">
         <div class="join__container container grid">
            <div class="join__data">
               <h2 class="section__title">
                  Your Journey <br>
                  Starts Here
               </h2>

               <p class="join__description">
                  Get up to date with the latest
                  travel and information from us.
               </p>

               <form action="" class="join__form">
                  <input type="email" placeholder="Enter your email" class="join__input">

                  <button class="join__button button">
                     Subscribe Our Newsletter <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" height="30px" width="30px">
                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                     </svg>
                  </button>
               </form>
            </div>

            <div class="join__image">
               <img src="assets/img/news.jpg" alt="join image" class="join__img">
               <div class="join__shadow"></div>
            </div>
         </div>
      </section>
   </main>

   <!-- footer section starts -->
   <footer class="footer">
      <div class="container">
         <div class="footer__content">
            <div class="footer__about">
               <h3>Credit</h3>
               <p>BookMyTrip is your trusted travel partner, and it's <br> credit is going to our developer.</p>
               <h3>Your Name</h3>
               <p><?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            </div>
            <div class="footer__links">
               <h3>Quick Links</h3>
               <ul>
                  <li><a href="#home">Home</a></li>
                  <li><a href="#about">About Us</a></li>
                  <li><a href="#services">Services</a></li>
               </ul>
            </div>
            <div class="footer__contact">
               <h3>Contact Us</h3>
               <p>Email: support@bookmytrip.com</p>
               <p>Phone: +91 8799170882</p>
            </div>
         </div>
         <div class="footer__bottom">
            <p class="credit">&copy; 2024 BookMyTrip. All rights reserved.</p>
         </div>
      </div>
   </footer>
   <!-- footer section ends -->

   <a href="#" class="scrollup" id="scroll-up">
      <img src="assets/icons/arrow-up-line.svg" alt="">
   </a>

   <script src="assets/js/scrollreveal.min.js"></script>
   <script src="assets/js/main.js"></script>
</body>
<script>
   window.onload = function() {
      var snackbar = document.getElementById("snackbar");
      if (snackbar.innerHTML) {
         snackbar.className = "show";
         setTimeout(function() {
            snackbar.className = snackbar.className.replace("show", "");
         }, 3000);
      }
   };
</script>

</html>