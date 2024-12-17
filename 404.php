<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>404 Not Found</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            font-size: 72px;
            margin-bottom: 20px;
            color: #ff6f61;
        }
        p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        a {
            color: #dc143c;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid #dc143c;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #dc143c;
            color: #fff;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you're looking for can't be found.</p>
        <p>It looks like you took a wrong turn. Don't worry, it happens to the best of us!</p>
        <p><a href="index.php">Go back to the Website</a></p>
    </div>
</body>
</html>
