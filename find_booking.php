<?php
require_once 'db_connection.php'; // Include your database connection file

$bookingDetails = null; // Initialize variable to hold booking details
$errorMessage = ""; // Initialize variable for error messages

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookingId'])) {
    $bookingId = $_POST['bookingId'];

    // Fetch booking details based on booking ID
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookingDetails = $result->fetch_assoc(); // Fetch booking details
    } else {
        $errorMessage = "No booking found for ID: $bookingId";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>Find Booking</title>
    <style>
        /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.booking-form-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 400px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    font-size: 16px;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #218838;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #f8f9fa;
    color: #333;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9ecef;
}

.error-message {
    color: #dc3545;
    text-align: center;
    margin-top: 20px;
}

/* Responsive Styles */
@media (max-width: 600px) {
    .booking-form-container {
        padding: 15px;
        max-width: 90%;
    }

    h1 {
        font-size: 1.5em;
    }

    input[type="text"], button {
        font-size: 14px;
    }

    th, td {
        font-size: 14px;
    }
}
    </style>
</head>
<body>
    <div class="booking-form-container">
        <h1>Find Your Booking</h1>
        <form action="find_booking.php" method="POST">
            <label for="bookingId">Enter Booking ID:</label>
            <input type="text" id="bookingId" name="bookingId" required>
            <button type="submit">Find Booking</button>
        </form>
    </div>

    <?php if ($errorMessage): ?>
        <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php elseif ($bookingDetails): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Bus Number</th>
                <th>Date of Journey</th>
                <th>Status</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($bookingDetails['id']); ?></td>
                <td><?php echo htmlspecialchars($bookingDetails['user_id']); // Assuming you want to show user_id ?></td>
                <td><?php echo htmlspecialchars($bookingDetails['bus_number']); ?></td>
                <td><?php echo htmlspecialchars($bookingDetails['date_of_journey']); ?></td>
                <td><?php echo htmlspecialchars($bookingDetails['status']); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>
</html>