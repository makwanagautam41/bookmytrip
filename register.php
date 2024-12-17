<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $mobile = $_POST['mobile'];
    $adhar = $_POST['adhar']; 
    $age = $_POST['age']; 

    if (!preg_match('/^[0-9]{10,15}$/', $mobile)) {
        $error = "Invalid mobile number format";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {    
        $sql = "SELECT * FROM users WHERE email = ? OR mobile = ?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email or mobile already registered";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (name, email, mobile, adhar, age, password) VALUES (?, ?, ?, ?, ?, ?)"; 
            $stmt = $conn->prepare($sql);
            
            $stmt->bind_param("ssssis", $name, $email, $mobile, $adhar, $age, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Registration successful. Please log in."; 
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
        $stmt->close();
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
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/signup.css">
</head>
<body>
    <div class="container">
        <div class="img">
            <img src="./assets/img/back-img.png" alt="">
        </div>
        <div class="image-section">
            <img
                src="./assets/img/registerSeat.jpg"
                alt="Bus Booking Image">
            <div class="promo-text">
                <h3>Start Your Journey with Us!</h3>
                <p>Sign up now to enjoy exclusive offers and discounts on bus bookings.</p>
            </div>
        </div>
        <div class="register-section">
            <div class="brand-logo">BusTicketBook</div>
            <h2>Create an Account</h2>
            <p>Please fill your details</p>
            <?php if (isset($error)) echo '<p style="color:red;">' . $error . '</p>'; ?>
            <form onsubmit="return validateForm()" method="POST">
                <input type="text" name="name" id="name" placeholder="Name">
                <span id="errName"></span>
                <input type="email" name="email" id="email" placeholder="Email">
                <span id="errEmail"></span>
                <input type="text" name="mobile" id="mobile" placeholder="Mobile Number">
                <span id="errMobile"></span>
                <input type="text" name="adhar" id="adhar" placeholder="Adhar Number">
                <span id="errAdhar"></span>
                <input type="number" name="age" id="age" placeholder="Age">
                <span id="errAge"></span>
                <input type="password" name="password" id="password" placeholder="Password">
                <span id="errPassword"></span>
                <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password">
                <span id="errConfirmPassword"></span>
                <button type="submit" class="register-btn">Register</button>
            </form>
            <p class="signin-link">Already have an account? <a href="login.php">Sign in</a></p>
        </div>
    </div>
<script>
    function validateForm() {

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const mobile = document.getElementById('mobile').value.trim();
    const adhar = document.getElementById('adhar').value.trim();
    const age = document.getElementById('age').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();

    if (name.length <= 0) {
        document.getElementById('errName').textContent = "*Name is required.";
        document.getElementById('name').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errName').textContent = "";
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById('errEmail').textContent = "*Please enter a valid email address.";
        document.getElementById('email').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errEmail').textContent = "";
    }

    const mobilePattern = /^\d{10}$/;
    if (!mobilePattern.test(mobile)) {
        document.getElementById('errMobile').textContent = "*Please enter a valid 10-digit mobile number.";
        document.getElementById('mobile').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errMobile').textContent = "";
    }

    if (adhar.length !== 12) {
        document.getElementById('errAdhar').textContent = "*Adhar number must be 12 digits.";
        document.getElementById('adhar').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errAdhar').textContent = "";
    }

    if(age.length <=0){
        document.getElementById('errAge').textContent = "*Age should be Entred";
        document.getElementById('age').style.border = "1px solid red";
        return false;
    }else{
        document.getElementById('errAge').textContent = "";
    }

    if (password.length < 6) {
        document.getElementById('errPassword').textContent = "*Password must be at least 6 characters long.";
        document.getElementById('password').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errPassword').textContent = "";
    }

    if (password !== confirmPassword) {
        document.getElementById('errConfirmPassword').textContent = "*Passwords do not match.";
        document.getElementById('confirmPassword').style.border = "1px solid red";
        return false;
    } else {
        document.getElementById('errConfirmPassword').textContent = "";
    }
    }

</script>
</body>
</html>