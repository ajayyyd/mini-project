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
        // if ($user_type === 'admin') {
        //     // Admin data only has uname, email, and pwd
        //     $sql = "SELECT uname, pwd FROM admindata WHERE uname = ? AND pwd = ?";
        //     // Prepare and bind
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bind_param("ss", $user, $pass);
        // } else {
            // User data has uname, email, pwd, and status
            $sql = "SELECT uname, pwd FROM userdata WHERE uname = ? AND pwd = ?";
            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $user, $pass);
        

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            // if ($user_type === 'admin') {
            //     // Bind the result variables for admin
            //     $stmt->bind_result($db_username, $db_password);
            //     $stmt->fetch();

            //     // Check password
            //     if ($pass === $db_password) {
            //         // Successful admin login
            //         $_SESSION['username'] = $user;
            //         $_SESSION['user_type'] = 'admin';

            //         // Redirect to admin dashboard
            //         header("Location: admin_dashboard.php");
            //         exit();
            //     }
            // } else {
                // Bind the result variables for user
                
                $stmt->bind_result($db_username, $db_password);
                $stmt->fetch();

                // Check password
                if ($pass === $db_password) {
                    // Successful user login
                    $_SESSION['userid'] = $row['userid'];
                    $_SESSION['username'] = $user;
                    $_SESSION['user_type'] = 'user';

                    // First, clear any existing 'login' status
                    $clear_sql = "UPDATE userdata SET status = NULL WHERE status = 'login'";
                    $clear_stmt = $conn->prepare($clear_sql);
                    $clear_stmt->execute();
                    $clear_stmt->close();

                    // Then, update status to 'login' for the current user
                    $update_sql = "UPDATE userdata SET status = 'login' WHERE uname = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("s", $user);
                    $update_stmt->execute();
                    $update_stmt->close();

                    // Redirect to user dashboard
                    header("Location: profile.php");
                    exit();
                
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
    <body>
    <div class="center">
        <h2 style="color: #af1905;">User Login</h2>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">

                <input type="password" name="password" required id="password">
                
                <img src="images/eyeclose.png" onclick="pass()" id="eyeicon" width="25px" 
                style="float: right; cursor: pointer; position: absolute; right: 15px; top: 8px;">
                <span></span>
                <label>Password</label>
            </div>

            <input type="submit" value="Login">
            <div class="signup">
                Not a member?<a href="create.php" >SignUp</a><br>
                <br><button class="button"><a href="index.html" id="home" style="color: white;">Back to Home</a></button>
            </div>
        </form>
    </div>
  <script>

    /* password view/hide toggle function */
    var a;
    function pass()
    {
        if(a==1)
    {
        document.getElementById('password').type='password';
        document.getElementById('eyeicon').src='images/eyeclose.png';
        a=0;
    }
    else
    {
        document.getElementById('password').type='text';
        document.getElementById('eyeicon').src='images/eye.png';
        a=1;
    }
    }
  </script>
</body>
        <?php
        // Display error message if login fails
        if (isset($error_message)) {
            echo '<div class="error">' . $error_message . '</div>';
        }
        ?>
</body>
</html>
