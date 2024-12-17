<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Fetch booking details
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $booking = $stmt->get_result()->fetch_assoc();
} else {
    header('Location: home.php');
}

// Review submission handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    $insert_query = "INSERT INTO reviews (name, rating, review_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sis", $name, $rating, $review_text);

    if ($stmt->execute()) {
        echo "<script>
                alert('Review submitted successfully!');
                window.location.href = 'home.php';
              </script>";
    } else {
        echo "<script>alert('Failed to submit review. Please try again.');</script>";
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
    <title>BusBooking - Summary</title>
    <link rel="stylesheet" href="assets/css/confirm-booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <div class="price-summary">
        <div class="summary-header">
            <i class="fa-solid fa-rectangle-list"></i>Ticket Summary
        </div>
        <div class="summary-content">
            <div class="summary-item">
                <span>Bus:</span>
                <span><?php echo htmlspecialchars($booking['bus_name']); ?></span>
            </div>
            <div class="summary-item">
                <span>Date:</span>
                <span><?php echo htmlspecialchars($booking['date_of_journey']); ?></span>
            </div>
            <div class="summary-item">
                <span>Seat:</span>
                <span><?php echo htmlspecialchars($booking['seats']); ?></span>
            </div>
            <div class="summary-item">
                <span>Status:</span>
                <span class="confirmed"><?php echo htmlspecialchars($booking['status']); ?></span>
            </div>
            <div class="divider"></div>
            <div class="summary-item">
                <span>Base Fare x 1</span>
                <span>₹<?php echo htmlspecialchars($booking['total_fare']); ?></span>
            </div>
        </div>
        <div class="summary-total">
            <span>Total</span>
            <span>₹<?php echo htmlspecialchars($booking['total_fare']); ?></span>
        </div>
        <!-- <a href="print_ticket.php?booking_id=<?php echo $booking['id']; ?>" class="print-button">Print Ticket</a> -->
         <button href="" onclick="window.print()" class="print-button">Print Ticket</button>
        <a href="home.php" class="print-button">Back To Home</a>
    </div>

    <!-- Review Section -->
    <!-- <div class="flex flex-col max-w-xl p-8 shadow-sm rounded-xl lg:p-12 dark:bg-gray-50 dark:text-gray-800">
        <h2 class="text-3xl font-semibold text-center">Your opinion matters!</h2>
        <form method="POST" action="">
            <div class="flex flex-col items-center py-6 space-y-3">
                <span class="text-center">How was your experience?</span>
                <div class="flex space-x-3">
                    
                    <button type="button" class="rating-star" data-value="1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                    <button type="button" class="rating-star" data-value="2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                    <button type="button" class="rating-star" data-value="3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                    <button type="button" class="rating-star" data-value="4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                    <button type="button" class="rating-star" data-value="5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                    <input type="hidden" name="rating" id="rating" value="">
                </div>
            </div>
            <div class="flex flex-col w-full">
                <input type="text" name="name" id="name" value="" placeholder="Enter Your Name">
                <textarea name="review_text" rows="3" placeholder="Message..." class="p-4 rounded-md resize-none dark:text-gray-800 dark:bg-gray-50"></textarea>
                <button type="submit" class="py-4 my-8 font-semibold rounded-md dark:text-gray-50 dark:bg-violet-600">Leave Feedback</button>
            </div>
        </form>
    </div> -->

    <script>
        const stars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                let rating = star.getAttribute('data-value');
                ratingInput.value = rating;

                stars.forEach(star => star.style.color = 'gray');
                for (let i = 0; i < rating; i++) {
                    stars[i].style.color = 'gold';
                }
            });
        });
    </script>

</body>
</html>
