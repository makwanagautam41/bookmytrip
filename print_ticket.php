<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['booking_id'])) {
    header('Location: login.php');
    exit();
}

$booking_id = $_GET['booking_id'];

// Fetch booking details
$query = "SELECT bookings.*, users.name as user_name, buses.bus_name FROM bookings
          JOIN users ON bookings.user_id = users.id
          JOIN buses ON bookings.bus_id = buses.id
          WHERE bookings.id = ? AND bookings.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $booking_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $booking = $result->fetch_assoc();
} else {
    echo "Invalid booking.";
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
    <title>Print Ticket</title>
    <link rel="stylesheet" href="admin/admin_style.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .ticket { border: 1px solid #000; padding: 20px; width: 600px; margin: 20px auto; }
        .ticket h2 { text-align: center; }
        .ticket p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>Booking Confirmation</h2>
        <p><strong>User Name:</strong> <?php echo htmlspecialchars($booking['user_name']); ?></p>
        <p><strong>Bus Name:</strong> <?php echo htmlspecialchars($booking['bus_name']); ?></p>
        <p><strong>Date of Journey:</strong> <?php echo htmlspecialchars($booking['date_of_journey']); ?></p>
        <p><strong>Seats:</strong> <?php echo htmlspecialchars($booking['seats']); ?></p>
        <p><strong>Total Fare:</strong> $<?php echo htmlspecialchars($booking['total_fare']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?></p>
        <button onclick="window.print()">Print Ticket</button>
    </div>
</body>
</html>
