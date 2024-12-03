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
        $servername = "localhost";  
        $username = "root";         
        $password = "";             
        $dbname = "blooddrive";      

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // SQL query to fetch the user data
            // Admin data only has uname, email, and pwd
        $sql = "SELECT uname, pwd FROM admindata WHERE uname = ? AND pwd = ?";
            // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $pass);
        // } else {
        //     // User data has uname, email, pwd, and status
        //     $sql = "SELECT uname, pwd FROM userdata WHERE uname = ? AND pwd = ?";
        //     // Prepare and bind
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bind_param("ss", $user, $pass);
        // }

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
                // Bind the result variables for admin
                $stmt->bind_result($db_username, $db_password);
                $stmt->fetch();

                // Check password
                if ($pass === $db_password) {
                    // Successful admin login
                    $_SESSION['username'] = $user;

                    // Redirect to admin dashboard
                    header("Location: admin_dashboard.php");
                    exit();
                
            // } else {
            //     // Bind the result variables for user
            //     $stmt->bind_result($db_username, $db_password);
            //     $stmt->fetch();

            //     // Check password
            //     if ($pass === $db_password) {
            //         // Successful user login
            //         $_SESSION['username'] = $user;

            //         // First, clear any existing 'login' status
            //         $clear_sql = "UPDATE admindata SET status = NULL WHERE status = 'login'";
            //         $clear_stmt = $conn->prepare($clear_sql);
            //         $clear_stmt->execute();
            //         $clear_stmt->close();

            //         // Then, update status to 'login' for the current user
            //         $update_sql = "UPDATE admindata SET status = 'login' WHERE uname = ?";
            //         $update_stmt = $conn->prepare($update_sql);
            //         $update_stmt->bind_param("s", $user);
            //         $update_stmt->execute();
            //         $update_stmt->close();

            //         // Redirect to user dashboard
            //         header("Location: admin_dashboard.php");
            //         exit();
                
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
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>             
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