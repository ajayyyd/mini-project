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
        .profile-info {
            padding: 20px;
        }
        
        .info-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .info-section h2 {
            color: #cc0000;
            margin-bottom: 15px;
        }
        
        .info-item {
            margin: 10px 0;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }
        
        .status-available {
            color: green;
        }
        
        .status-not-available {
            color: red;
        }

        .edit-btn {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .change-password-form {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .change-password-form input {
            margin: 5px 0;
            padding: 5px;
        }

        .password-dots {
            letter-spacing: 2px;
            font-weight: bold;
        }

        .profile-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .profile-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        
        <!-- Basic User Information -->
        <div class="info-section">
            <h2>Account Information</h2>
            <div class="info-item">
                <span class="info-label">Username:</span>
                <?php echo htmlspecialchars($user['uname']); ?>
                <button class="edit-btn" onclick="editField('username')">Edit</button>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <?php echo htmlspecialchars($user['email']); ?>
                <button class="edit-btn" onclick="editField('email')">Edit</button>
            </div>
            <div class="info-item">
                <span class="info-label">Password:</span>
                <span class="password-dots"><?php echo str_repeat('•', strlen($user['password'])); ?></span>
                <button class="edit-btn" onclick="togglePasswordChange()">Change Password</button>
            </div>
            <div id="passwordChangeForm" class="change-password-form">
                <input type="password" placeholder="Current Password" id="currentPassword">
                <input type="password" placeholder="New Password" id="newPassword">
                <input type="password" placeholder="Confirm New Password" id="confirmPassword">
                <button onclick="changePassword()">Submit</button>
                <button onclick="togglePasswordChange()">Cancel</button>
            </div>
            <div class="info-item">
                <span class="info-label">Account Status:</span>
                <?php echo htmlspecialchars($user['status']); ?>
            </div>
        </div>

        <!-- Donor Information -->
        <div class="info-section">
            <h2>Donor Information</h2>
            <?php if ($donor_data): ?>
                <div class="info-item">
                    <span class="info-label">Full Name:</span>
                    <?php echo htmlspecialchars($donor_data['name']); ?>
                    <button class="edit-btn" onclick="editField('name')">Edit</button>
                </div>
                <div class="info-item">
                    <span class="info-label">Age:</span>
                    <?php echo htmlspecialchars($donor_data['age']); ?>
                    <button class="edit-btn" onclick="editField('age')">Edit</button>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone Number:</span>
                    <?php echo htmlspecialchars($donor_data['phno']); ?>
                    <button class="edit-btn" onclick="editField('phone')">Edit</button>
                </div>
                <div class="info-item">
                    <span class="info-label">District:</span>
                    <?php echo htmlspecialchars($donor_data['district']); ?>
                    <button class="edit-btn" onclick="editField('district')">Edit</button>
                </div>
                <div class="info-item ">
                    <span class="info-label">City:</span>
                    <?php echo htmlspecialchars($donor_data['city']); ?>
                    <button class="edit-btn" onclick="editField('city')">Edit</button>
                </div>
                <div class="info-item">
                    <span class="info-label">Blood Group:</span>
                    <?php echo htmlspecialchars($donor_data['bloodgroup']); ?>
                    <button class="edit-btn" onclick="editField('bloodgroup')">Edit</button>
                </div>
                <div class="info-item">
                    <span class="info-label">Availability:</span>
                    <span class="status-<?php echo strtolower(str_replace(' ', '-', $donor_data['availability'])); ?>">
                        <?php echo htmlspecialchars($donor_data['availability']); ?>
                    </span>
                    <button class="edit-btn" onclick="editField('availability')">Edit</button>
                </div>
            <?php else: ?>
                <p>No donor information available. Have you registered as a donor?</p>
                <a href="donate.php" class="cta-btn">Register as Donor</a>
            <?php endif; ?>
        </div>

        <!-- Profile Actions -->
        <div class="profile-actions">
            <button onclick="editProfile()">Edit Profile</button>
            <button onclick="deleteProfile()">Delete Profile</button>
            <button onclick="window.location.href='profile.php'">Back to Dashboard</button>
        </div>
    </div>
    <script src="userprofile_script.js"></script>
</body>
</html>

<script>
    function togglePasswordChange() {
        document.getElementById("passwordChangeForm").style.display = "block";
    }

    function changePassword() {
        // TO DO: Implement password change functionality
        alert("Password changed successfully!");
        togglePasswordChange();
    }

    function editField(field) {
        // TO DO: Implement field editing functionality
        alert("Field edited successfully!");
    }

    function editProfile() {
        // TO DO: Implement profile editing functionality
        alert("Profile edited successfully!");
    }

    function deleteProfile() {
        // TO DO: Implement profile deletion functionality
        alert("Profile deleted successfully!");
    }
</script>
