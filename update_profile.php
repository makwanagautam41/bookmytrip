<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $mobile = $_POST['mobile']; 

    $sql = "UPDATE users SET name = ?, email = ?, mobile = ?";
    $params = [$name, $email, $mobile];
    $types = "sss"; 

    // Add new password if provided
    if (!empty($new_password)) {
        $params[] = password_hash($new_password, PASSWORD_DEFAULT);
        $types .= "s";
        $sql .= ", password = ?";
    }

    $sql .= " WHERE id = ?";
    $params[] = $user_id;
    $types .= "i"; 

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name;
            $_SESSION['message'] = "Profile updated successfully";
            header("Location: home.php");
            exit();
        } else {
            $error = "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>