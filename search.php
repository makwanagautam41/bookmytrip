<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $route_from = $_POST['route_from'];
  $route_to = $_POST['route_to'];
  $date_of_journey = $_POST['date_of_journey'];

  $query = "SELECT * FROM buses WHERE route_from = ? AND route_to = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $route_from, $route_to);
  $stmt->execute();
  $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <title>BusTicketBook - Book Bus Tickets</title>
  <link rel="stylesheet" href="assets/css/search.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="hero-section" id="hero-section">
    <div class="overlay">
      <h1>Your Journey Starts Here - Find Your Next Destination!</h1>
      <form action="" method="POST">
        <div class="search-bar">
          <div class="input-group">
            <i class="fas fa-bus"></i>
            <input type="text" id="route_from" name="route_from" placeholder="From Station" required>
          </div>
          <div class="input-group-icon rotate">
            <i class="fas fa-exchange-alt"></i>
          </div>
          <div class="input-group">
            <i class="fas fa-map-marker-alt"></i>
            <input type="text" id="route_to" name="route_to" placeholder="To Station" required>
          </div>
          <div class="input-group">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" id="date_of_journey" name="date_of_journey" min="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="date-buttons">
            <button type="button" id="today-btn">Today</button>
            <button type="button" id="tomorrow-btn">Tomorrow</button>
          </div>
          <button class="search-btn" id="search-btn" type="submit" onclick="showSnackbar()">Search</button>
        </div>
      </form>
    </div>
  </div>

  <div id="loader" style="display:none;">
    <div class="loader-content"></div>
  </div>
  <div id="snackbar"></div>

  <?php if (isset($result) && $result->num_rows > 0): ?>
    <div class="bus-details">
      <h2>Available Buses</h2>
      <?php while ($bus = $result->fetch_assoc()): ?>
        <div class="bus-card">
          <div class="bus-info">
            <div class="badge">Book Mytrip</div>
            <h2><?php echo htmlspecialchars($bus['bus_name']); ?></h2>
            <div class="bus-number">
              <span><?php echo htmlspecialchars($bus['bus_number']); ?></span>
            </div>
            <div class="date bus-number">
              <span><?php echo "$date_of_journey" ?></span>
            </div>
          </div>
          <div class="timing-info">
            <div class="departure">
              <span><?php echo htmlspecialchars($bus['time_of_departure']); ?></span>
              <p><?php echo htmlspecialchars($bus['route_from']); ?></p>
            </div>
            <div class="duration">
              <i class="fa-solid fa-arrow-down rotate"></i>
            </div>
            <div class="arrival">
              <span><?php $time = new DateTime($bus['time_of_departure']);
                    $time->modify('+1 hour');
                    echo htmlspecialchars($time->format('H:i:s')); ?></span>
              <p><?php echo htmlspecialchars($bus['route_to']); ?></p>
            </div>
          </div>
          <div class="additional-info">
            <div class="rating">
              <span class="star-rating">4.7 ⭐</span>
              <span>32800</span>
            </div>
            <div class="icons">
              <i class="fas fa-water"></i>
              <i class="fas fa-tv"></i>
              <i class="fas fa-utensils"></i>
              <span>more +3</span>
            </div>
          </div>
          <div class="price-info">
            <p>Starts at</p>
            <div class="price">
              <span class="current-price"><?php echo htmlspecialchars($bus['fare']); ?></span>
            </div>
            <a style="text-decoration:none;" class="seats-btn" href="booking.php?bus_id=<?php echo $bus['id']; ?>&date_of_journey=<?php echo urlencode($date_of_journey); ?>&route_from=<?php echo $bus['route_from'] ?>&route_to= <?php echo $bus['route_to'] ?>">Book Now</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php elseif (isset($result)): ?>
    <script>
      let x = document.getElementById("snackbar");
      x.innerText = "No bus found";
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    </script>
  <?php endif; ?>


  <section class="facilities">
    <div class="facility-card">
      <div class="icon-container">
        <i class="fas fa-bus"></i>
      </div>
      <p>Upto 150% Refund<br>On Bus Cancellation</p>
    </div>
    <div class="facility-card">
      <div class="icon-container">
        <i class="fas fa-snowflake"></i>
      </div>
      <p>Upto 100% Refund<br>for Bad Service Quality</p>
    </div>
    <div class="facility-card">
      <div class="icon-container">
        <i class="fas fa-clock"></i>
      </div>
      <p>Upto 100% Refund<br>For Bus Delays</p>
    </div>
    <div class="facility-card">
      <div class="icon-container">
        <i class="fas fa-exchange-alt"></i>
      </div>
      <p>Upto 100% Refund<br>If You Change Plans</p>
    </div>
  </section>

  <script src="assets/js/search.js"></script>
</body>

</html>