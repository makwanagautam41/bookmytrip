<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['bus_id']) && isset($_GET['date_of_journey']) && isset($_GET['route_from']) && isset($_GET['route_to'])) {
    $bus_id = $_GET['bus_id'];
    $date_of_journey = $_GET['date_of_journey'];
    $route_from = $_GET['route_from'];
    $route_to = $_GET['route_to'];

    // Fetch bus details
    $query = "SELECT * FROM buses WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bus_id);
    $stmt->execute();
    $bus = $stmt->get_result()->fetch_assoc();

    $bus_number = $bus['bus_number'];

    if (!$bus) {
        echo "Bus not found.";
        exit();
    }

    // Handle form submission for booking
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!empty($_POST['seats'])) {
            $seats = $_POST['seats'];
            $total_fare = $bus['fare'] * count($seats);
            $seat_numbers = implode(',', $seats);  // Convert seats array to a comma-separated string
    
            // Generate a unique 13-digit booking number
            do {
                $booking_number = substr(str_shuffle(str_repeat('0123456789', 13)), 1, 13);
                $check_query = "SELECT COUNT(*) AS count FROM bookings WHERE booking_number = ?";
                $check_stmt = $conn->prepare($check_query);
                $check_stmt->bind_param("s", $booking_number);
                $check_stmt->execute();
                $result = $check_stmt->get_result();
                $row = $result->fetch_assoc();
            } while ($row['count'] > 0);
    
            $user_id = $_SESSION['user_id'];
            $query = "INSERT INTO bookings (user_id, bus_id, bus_name, date_of_journey, seats, total_fare, booking_number,route_from,route_to,bus_number, status) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Confirmed')";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iississsss", $user_id, $bus_id, $bus['bus_name'], $date_of_journey, $seat_numbers, $total_fare, $booking_number,$route_from, $route_to,$bus_number);
    
            if ($stmt->execute()) {
                header('Location: confirmation.php?booking_id=' . $stmt->insert_id);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "<script>alert('Please select at least one seat.');</script>";
        }
    }

} else {
    header('Location: search.php');
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
    <title>Select Seat - BusBooking</title>
    <link rel="stylesheet" href="assets/css/bus-seat.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

<section class="bus-info">
    <div class="info-container">
        <div class="info-block">
            <p class="info-title">Bus Name</p>
            <p class="info-value"><?php echo htmlspecialchars($bus['bus_name']); ?></p>
        </div>
        <div class="divider">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="info-block">
            <p class="info-title">Fare</p>
            <p class="info-value">₹<?php echo htmlspecialchars($bus['fare']); ?></p>
        </div>
        <div class="divider">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="info-block">
            <p class="info-title">Departure Date</p>
            <p class="info-value"><?php echo htmlspecialchars($date_of_journey); ?></p>
        </div>
    </div>
</section>

<form method="POST" action="">
    <section class="seat-selection">
        <h2 class="section-title">Select Your Seat</h2>
        <div class="deck-container">

            <!-- Front Deck -->
            <div class="deck">
                <h3 class="deck-title">Front Deck</h3>
                <div class="seat-grid">
                    <i class="fas fa-steering-wheel driver-icon"></i>
                    <?php 
                    $half = ceil($bus['total_seats'] / 2);
                    for ($i = 1; $i <= $half; $i++): ?>
                        <div class="seat">
                            <label>
                                <input type="checkbox" name="seats[]" value="<?php echo $i; ?>">
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Back Deck -->
            <div class="deck">
                <h3 class="deck-title">Back Deck</h3>
                <div class="seat-grid">
                    <?php for ($i = $half + 1; $i <= $bus['total_seats']; $i++): ?>
                        <div class="seat">
                            <label>
                                <input type="checkbox" name="seats[]" value="<?php echo $i; ?>">
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="confirm-booking">
        <button type="submit" class="btn-confirm">Confirm Booking</button>
    </section>
</form>

<section class="back-link">
    <a href="javascript:history.back()" class="link-back">Back to Search Results</a>
</section>

<script>
    document.querySelectorAll('.seat input[type="checkbox"]').forEach(seat => {
        seat.addEventListener('change', function () {
            this.parentElement.parentElement.classList.toggle('selected', this.checked);
        });
    });
</script>

</body>

</html>
