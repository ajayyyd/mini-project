<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="style.css">
   
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
    $pass = $_POST['password'];

    // SQL query to fetch the user data
    $sql = "SELECT * FROM userdata WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify the password
        $row = $result->fetch_assoc();
        if ($pass == $row['pwd']) {
            echo "login succesful ";
            // header("Location: donate.php");
            // Password is correct, redirect to index.html
            $link_id = isset($_POST['link_id']) ? intval($_POST['link_id']) : 0;
            echo $link_id;
            
            
            if ($link_id > 0) {
                echo $link_id;
                echo "redirecting to donation form";
                // header('Location: donate.php');
            }
            // elseif($link_id == 0){
            //     echo "login succesful";
            //     header('Location: index.html');
                
            //     exit();
            // }
            
            
            
            
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
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
