<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css" integrity="sha512-6p+GTq7fjTHD/sdFPWHaFoALKeWOU9f9MPBoPnvJEWBkGS4PKVVbCpMps6IXnTiXghFbxlgDE8QRHc3MU91lJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <link rel="stylesheet" href="assets/css/styles.css">

   <title>BookMyTrip</title>
</head>

<body>
   <!-- Header -->
   <header class="header" id="header">
      <nav class="nav container">
         <a href="#" class="nav__logo" id="nav__logo">
            BookMyTrip
         </a>

         <div class="nav__menu" id="nav-menu">
            <ul class="nav__list" id="nav__list">
               <li class="nav__item" id="nav-home">
                  <a href="index.php" class="nav__link active-link">Home</a>
               </li>

               <li class="nav__item">
                  <a href="aboutUs.php" class="nav__link">About</a>
               </li>

               <li class="nav__item">
                  <a href="#service" class="nav__link">Services</a>
               </li>

               <li class="nav__item">
                  <a href="find_booking.php" class="nav__link">Find Booking</a>
               </li>

               <li class="nav__item signin">
                  <a href="login.php" class="si">signIn/SignUp</a>
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

   <main class="main" id="main">
      <!-- home -->
      <section class="home section" id="home">
         <video src="assets/img/vid1.mp4" id="video" class="home__bg" loop autoplay muted></video>
         <div class="home__shadow"></div>

         <div class="home__container container grid">
            <div class="home__data">
               <h3 class="home__subtitle">
                  Welcome To BookMyTrip
               </h3>

               <h1 class="home__title" id="home__title">
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
      </section>
   </main>

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
                  Subscribe Our Newsletter <img src="./assets/icons/arrow-right-line.svg" alt="">
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
               <p>BookMyTrip is your trusted travel partner, and it's credit is <br>going to our developer.</p>
            </div>
            <div class="footer__links">
               <h3>Quick Links</h3>
               <ul>
                  <li><a href="#home">Home</a></li>
                  <li><a href="#about">About Us</a></li>
                  <li><a href="#services">Services</a></li>
                  <li><a href="login.php">Login</a></li>
               </ul>
            </div>
            <div class="footer__contact">
               <h3>Contact Us</h3>
               <p>Email: help@bookmytrip.com</p>
               <p>Phone: +91 8799170882</p>
            </div>
         </div>
         <div class="footer__bottom">
            <p class="credit">&copy; 2024 <a href="#">BookMyTrip.</a> All rights reserved.</p>
         </div>
      </div>
   </footer>
   <!-- footer section ends -->

   <a href="#" class="scrollup" id="scroll-up">
      <img src="./assets/icons/arrow-up-line.svg" alt="">
   </a>

   <!-- scroll revel -->
   <script src="assets/js/scrollreveal.min.js"></script>

   <!-- main js -->
   <script src="assets/js/main.js"></script>
</body>

</html>