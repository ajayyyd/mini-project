<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .create-account-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .create-account-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .create-account-container input[type="text"],
        .create-account-container input[type="password"],
        .create-account-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .create-account-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .create-account-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
// This block will execute when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";  // Use your database server name
    $username = "root";         // Your database username
    $password = "";             // Your database password
    $dbname = "blooddrive";      // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // // Hash the password for security
    // $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // SQL query to insert the data into the userdata table
    $sql = "INSERT INTO userdata (uname, email, pwd) VALUES (?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $pass);

    // Execute the query
    if ($stmt->execute()) {
        $smessage = "New account created successfully";
    } else {
        $emessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<div class="create-account-container">
    <h2>Create Account</h2>
    <form action="" method="POST">
        <input type="text" placeholder="Username" name="username" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" value="Create Account">
    </form>
    <?php
    // Display success or error message
    if (isset($smessage)) {
        echo '<div class="message">' . $smessage . '</div>';
        echo '<a href="login.php" class="redirect-btn">Go to Sign In</a>';
    } elseif (isset($emessage)) {
        echo '<div class="error">' . $emessage . '</div>';
    }
    ?>
</div>


</body>
</html>
