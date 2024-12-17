<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>cancel</title>
    <link rel="stylesheet" href="admin/admin_style.css">
</head>
<body>
<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    $query = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $booking_id, $_SESSION['user_id']);
    if($stmt->execute()){
        $_SESSION['message'] = "cancelled successful"; 
        header("Location: home.php");
        exit();
    }
} else {
    echo "Invalid booking ID.";
}
?>

</body>
</html>