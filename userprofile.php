<?php
session_start(); 

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

// Fetch user data from userdata table for the logged-in user
$query = "SELECT uname, email, pwd, status FROM userdata WHERE status = 'login'";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($db_username, $db_email, $db_password, $db_status);

// Fetch the result
if ($stmt->fetch()) {
    // User found, store the basic data
    $user = array(
        'uname' => $db_username,
        'email' => $db_email,
        'password' => $db_password,
        'status' => $db_status
    );
    $_SESSION['username'] = $db_username;
} else {
    // No logged-in user found
    header("Location: login.php"); 
    exit();
}
$stmt->close();

// Handle form submission for updating profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    
    // Update user data in the database
    $update_query = "UPDATE userdata SET uname = ?, email = ?, pwd = ? WHERE uname = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssss", $new_username, $new_email, $new_password, $db_username);
    
    if ($update_stmt->execute()) {
        // Update session variables
        $_SESSION['username'] = $new_username;
        $user['uname'] = $new_username;
        $user['email'] = $new_email;
        $user['password'] = $new_password;
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }
    
    $update_stmt->close();
}

// Handle form submission for updating donor information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_donor'])) {
    $donor_name = $_POST['donor_name'];
    $donor_age = $_POST['donor_age'];
    $donor_phno = $_POST['donor_phno'];
    $donor_district = $_POST['donor_district'];
    $donor_city = $_POST['donor_city'];
    $donor_bloodgroup = $_POST['donor_bloodgroup'];
    $donor_availability = $_POST['donor_availability'];
    
    // Update donor data in the database
    $donor_update_query = "UPDATE donordata SET name = ?, age = ?, phno = ?, email = ?, district = ?, city = ?, bloodgroup = ?, availability = ? WHERE name = ?";
    $donor_update_stmt = $conn->prepare($donor_update_query);
    $donor_update_stmt->bind_param("siissssss", $new_donor_name, $new_donor_age, $new_donor_phno, $new_db_email, $new_donor_district, $new_donor_city, $new_donor_bloodgroup, $new_donor_availability, $donor_name);
    
    if ($donor_update_stmt->execute()) {
        echo "<script>alert('Donor information updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating donor information.');</script>";
    }
    
    $donor_update_stmt->close();
}

// Fetch donor data from donordata table
$donor_query = "SELECT name, age, phno, district, city, bloodgroup, availability 
                FROM donordata 
                WHERE email = ?";
$donor_stmt = $conn->prepare($donor_query);
$donor_stmt->bind_param("s", $db_email);
$donor_stmt->execute();
$donor_stmt->bind_result($donor_name, $donor_age, $donor_phno, $donor_district, $donor_city, $donor_bloodgroup, $donor_availability);

// Fetch the donor data
if ($donor_stmt->fetch()) {
    $donor_data = array(
        'name' => $donor_name,
        'age' => $donor_age,
        'phno' => $donor_phno,
        'district' => $donor_district,
        'city' => $donor_city,
        'bloodgroup' => $donor_bloodgroup,
        'availability' => $donor_availability
    );
} else {
    $donor_data = null;
}

$donor_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="userprofile_style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333;
            background: linear-gradient(to bottom right,rgb(156, 0, 0),rgb(255, 255, 255));
        }

        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['uname']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
            
            <div class="profile-actions">
                <button type="submit" name="update_profile">Update Profile</button>
                <button type="button" onclick="toggleEdit()">Edit Profile</button>
            </div>
        </form>

        <h2>Donor Information</h2>
        <form method="POST" action="">
            <label for="donor_name">Name:</label>
            <input type="text" id="donor_name" name="donor_name" value="<?php echo htmlspecialchars($donor_data['name']); ?>" required>
            
            <label for="donor_age">Age:</label>
            <input type="number" id="donor_age" name="donor_age" value="<?php echo htmlspecialchars($donor_data['age']); ?>" required>
            
            <label for="donor_phno">Phone Number:</label>
            <input type="number" id="donor_phno" name="donor_phno" value="<?php echo htmlspecialchars($donor_data['phno']); ?>" required>
            
            <label for="donor_district">District:</label>
            <input type="text" id="donor_district" name="donor_district" value="<?php echo htmlspecialchars($donor_data['district']); ?>" required>
            
            <label for="donor_city">City:</label>
            <input type="text" id="donor_city" name="donor_city" value="<?php echo htmlspecialchars($donor_data['city']); ?>" required>
            
            <label for="donor_bloodgroup">Blood Group:</label>
            <input type="text" id="donor_bloodgroup" name="donor_bloodgroup" value="<?php echo htmlspecialchars($donor_data['bloodgroup']); ?>" required>
            
            <label for="donor_availability">Availability:</label>
<input type="text" id="donor_availability" name="donor_availability" value="<?php echo htmlspecialchars($donor_data['availability']); ?>" required>
            
            <div class="profile-actions">
                <button type="submit" name="update_donor">Update Donor Information</button>
            </div>
        </form>

        <h2>Current Donor Information</h2>
        <?php if ($donor_data): ?>
            <p>Name: <?php echo htmlspecialchars($donor_data['name']); ?></p>
            <p>Age: <?php echo htmlspecialchars($donor_data['age']); ?></p>
            <p>Phone Number: <?php echo htmlspecialchars($donor_data['phno']); ?></p>
            <p>District: <?php echo htmlspecialchars($donor_data['district']); ?></p>
            <p>City: <?php echo htmlspecialchars($donor_data['city']); ?></p>
            <p>Blood Group: <?php echo htmlspecialchars($donor_data['bloodgroup']); ?></p>
            <p>Availability: <?php echo htmlspecialchars($donor_data['availability']); ?></p>
        <?php else: ?>
            <p>No donor information available.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleEdit() {
            const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="number"]');
            inputs.forEach(input => {
                input.disabled = !input.disabled;
            });
        }
    </script>
</body>
</html>
