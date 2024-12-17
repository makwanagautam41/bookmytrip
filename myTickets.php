<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$query = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookings = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body style="background-color: #fff;">
    <h2>Your Bookings</h2>
    <a class="tktSrch" href="search.php">Search for Buses</a>
    <?php if ($bookings->num_rows > 0): ?>
        <div class="booking-list">
            <?php while ($booking = $bookings->fetch_assoc()): ?>
                <div class="booking-item">
                    <div><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking['booking_number']); ?></div>
                    <div><strong>name:</strong> <?php echo htmlspecialchars($user['name']); ?></div>
                    <div><strong>Bus:</strong> <?php echo htmlspecialchars($booking['bus_name']); ?></div>
                    <div><strong>Bus Number:</strong> <?php echo htmlspecialchars($booking['bus_number']); ?></div>
                    <div><strong>Date:</strong> <?php echo htmlspecialchars($booking['date_of_journey']); ?></div>
                    <div><strong>Seats:</strong> <?php echo htmlspecialchars($booking['seats']); ?></div>
                    <div><strong>Total Price:</strong> <?php echo htmlspecialchars($booking['total_fare']); ?></div>
                    <div><strong>From :</strong> <?php echo htmlspecialchars($booking['route_from']); ?></div>
                    <div><strong>To :</strong> <?php echo htmlspecialchars($booking['route_to']); ?></div>
                    <div><strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?></div>
                    <div><strong>Print ticket</strong><a href="" onclick="window.print()" class="print-button">Print Ticket</a></div>
                    <div><a href="cancel_booking.php?id=<?php echo $booking['id']; ?>"onclick='show()'>Cancel Booking</a></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</body>
<script>
    function show(){
        confirm("Do you realy want to cancel booking");
    }
</script>
</html>
