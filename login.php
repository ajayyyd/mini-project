<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start(); // Start session to manage login state

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
        $pass = $_POST['password'];
        $user_type = $_POST['user_type']; // Get the user type

        // SQL query to fetch the user data
        if ($user_type === 'admin') {
            // Admin data only has uname, email, and pwd
            $sql = "SELECT uname, pwd FROM admindata WHERE uname = ? AND pwd = ?";
            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $user, $pass);
        } else {
            // User data has uname, email, pwd, and status
            $sql = "SELECT uname, pwd FROM userdata WHERE uname = ? AND pwd = ?";
            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $user, $pass);
        }

        // Execute the query
        $stmt->execute();
        $stmt->store_result(); // Store the result

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            if ($user_type === 'admin') {
                // Bind the result variables for admin
                $stmt->bind_result($db_username, $db_password); // Only uname and pwd for admin
                $stmt->fetch(); // Fetch the result

                // Check password
                if ($pass === $db_password) {
                    // Successful admin login
                    $_SESSION['username'] = $user; // Store username in session
                    $_SESSION['user_type'] = 'admin'; // Store user type in session

                    // Redirect to admin dashboard
                    header("Location: admin_dashboard.php");
                    exit();
                }
            } else {
                // Bind the result variables for user
                $stmt->bind_result($db_username, $db_password); // uname, pwd, status for user
                $stmt->fetch(); // Fetch the result

                // Check password
                if ($pass === $db_password) {
                    // Successful user login
                    $_SESSION['username'] = $user; // Store username in session
                    $_SESSION['user_type'] = 'user'; // Store user type in session

                    // Redirect to user dashboard
                    header("Location: profile.php");
                    exit();
                }
            }

            // If the password does not match
            $error_message = "Invalid username or password.";
        } else {
            // If no user found
            $error_message = "Invalid username or password.";
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
    ?>
    <h1>bloodrive.org</h1>
    <div class="login-box">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            User Role: 
            <select name="user_type" required>
                <option value="user">User </option>
                <option value="admin">Admin</option>
            </select>             
            <input type="submit" value="Login">
        </form>
        <?php
        // Display error message if login fails
        if (isset($error_message)) {
            echo '<div class="error">' . $error_message . '</div>';
        }
        ?>
        <div class="create-account">
            <p>Don't have an account? <a href="create.php">Create New Account</a></p>
        </div>
    </div>
</body>
</html>
