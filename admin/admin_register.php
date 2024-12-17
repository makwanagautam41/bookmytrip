<?php
session_start();
require_once '../db_connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../404.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Set default image if no image is selected
    $default_image = "../uploads/default_profile.png";
    $imagePath = $default_image;

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['profile_image'];
        $imageName = basename($image['name']);
        $imagePath = "../uploads/" . $imageName;

        if (in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Invalid file type.";
        }
    }

    $query = "SELECT * FROM admins WHERE email = ? AND mobile = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $mobile);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "An admin with this email already exists.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO admins (name, email, mobile, password, profile_image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $mobile, $hashed_password, $imagePath);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Admin Register Successful. Please Log in.";
            header("Location: admin_details.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
  <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <title>Admin Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="display: flex; justify-content:center">
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="flex flex-col max-w-md p-6 rounded-md sm:p-10 dark:bg-gray-50 dark:text-gray-800" style="background-color: #111827; width:100%;">
        <div class="mb-8 text-center">
            <h1 class="my-3 text-4xl font-bold text-white">Admin Register</h1>
            <p class="text-sm text-white">Welcome To BookMyTrip</p>
        </div>
        <form action="" method="POST" class="space-y-12" enctype="multipart/form-data" style="width: 100%;">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block mb-2 text-sm text-white">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" class="w-full px-3 py-2 border rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm text-white">Email address</label>
                    <input type="email" name="email" id="email" placeholder="leroy@jenkins.com" class="w-full px-3 py-2 border rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800">
                </div>
                <div>
                    <label for="mobile" class="block mb-2 text-sm text-white">Mobile</label>
                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile" class="w-full px-3 py-2 border rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800">
                </div>
                <div>
                    <label for="profile_image" class="block mb-2 text-sm text-white">Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image"  accept="image/*" class="w-full px-3 py-2 border rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800">
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <label for="password" class="text-sm text-white">Password</label>
                        <!-- <a rel="noopener noreferrer" href="#" class="text-xs hover:underline dark:text-gray-600">Forgot password?</a> -->
                    </div>
                    <input type="password" name="password" id="password" placeholder="*****" class="w-full px-3 py-2 border rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800">
                </div>
            </div>
            <div class="space-y-2">
                <div>
                    <button type="submit" class="w-full px-8 py-3 font-semibold rounded-md dark:bg-violet-600 dark:text-gray-50">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="./myadmin.js"></script>
</body>
</html>