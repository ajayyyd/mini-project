<?php
// session_start();
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "blooddrive"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} // Database connection file

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php"); // Redirect to login page if not logged in
//     exit();
// }

// $userId = $_SESSION['user_id'];

// Fetch user data from database
$query = "SELECT * FROM userdata WHERE uname = ? AND status = 'login'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No user found or not logged in.";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userprofile_style.css">
    <title>User Profile</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="profile-pic.jpg" alt="Profile Picture" class="profile-pic" id="profilePic">
            <h2 id="name"><?php echo htmlspecialchars($user['uname']); ?></h2>
        </div>
        <div class="profile-details">
            <!-- <p><strong>Address:</strong> <span id="address"><?php echo htmlspecialchars($user['address']); ?></span></p>
            <p><strong>Phone Number:</strong> <span id="phone"><?php echo htmlspecialchars($user['phone']); ?></span></p>
            <p><strong>Blood Group:</strong> <span id="bloodgroup"><?php echo htmlspecialchars($user['bloodgroup']); ?></span></p> -->
            <p><strong>Status:</strong> <span id="status"><?php echo htmlspecialchars($user['status']); ?></span></p>
            <button id="edit-btn" onclick="editProfile()">Edit</button>
            <button id="toggle-status-btn" onclick="toggleStatus()">Change Status</button>
            <button id="delete-btn" onclick="deleteProfile()">Delete Profile</button>
            <input type="file" id="upload-pic" accept="image/*" onchange="previewImage()">
            <button id="upload-btn" onclick="document.getElementById('upload-pic').click()">Upload Profile Picture</button>
        </div>
    </div>

    <script src="userprofile_script.js"></script>
</body>
</html>
