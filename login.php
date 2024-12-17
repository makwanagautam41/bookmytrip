<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sqlAdmin = "SELECT id, name, email, password FROM admins WHERE email = ? OR mobile = ?";
    $stmtAdmin = $conn->prepare($sqlAdmin);
    $stmtAdmin->bind_param("ss", $login, $login);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    if ($resultAdmin->num_rows === 1) {
        $admin = $resultAdmin->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header('Location: admin/admin_dashboard.php');
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $sqlUser = "SELECT id, name, email, password FROM users WHERE email = ? OR mobile = ?";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param("ss", $login, $login);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows === 1) {
            $user = $resultUser->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['snackbar_shown'] = true;
                header("Location: home.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "User not found.";
        }
        $stmtUser->close();
    }
    $stmtAdmin->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="img">
            <img src="./assets/img/back-img.png" alt="">
        </div>
        <div class="login-section">
            <div class="brand-logo">BusTicketBook</div>
            <h2>Welcome back</h2>
            <p>Please enter your details</p>
            <?php 
                    if (isset($_SESSION['message'])) {
                        echo "<p class='success'>{$_SESSION['message']}</p>";
                        unset($_SESSION['message']); 
                    }
                ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form action="login.php" method="POST">
                <input type="text" id="email" name="login" placeholder="Email or Mobile">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" class="signin-btn">Sign in</button>
            </form>
            <button class="google-signin" style="margin-top:1.5rem;"><i class="fab fa-google"></i> Sign in with Google</button>
            <p class="signup-link">Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
        <div class="image-section">
        <img src="./assets/img/loginSeat.jpg"
            alt="Bus Booking Image">
        <div class="promo-text">
            <h3>Book Your Journey Now!</h3>
            <p>Sign up for free and enjoy access to exclusive deals and offers.</p>
        </div>
        </div>
  </div>
</body>
</html>