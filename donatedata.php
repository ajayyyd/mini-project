<?php
// Database configuration
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "blooddrive"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['p_name'];
$age = $_POST['p_age'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$district = $_POST['district'];
$city = $_POST['city'];
$bloodgroup = $_POST['bloodgroup'];
$status = $_POST['status'];
$district = strtolower($district);
$city = strtolower($city);

// Main errors in the original code:
// 1. Values were not properly quoted in the SQL query
// 2. No proper SQL injection prevention
// 3. No error handling

// Corrected version using prepared statements
$stmt = $conn->prepare("INSERT INTO donordata (name, age, phno, email, district, city, bloodgroup, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisssss", $name, $age, $phone, $email, $district, $city, $bloodgroup, $status);

// Execute the statement and handle the result
if ($stmt->execute()) {
    echo "New record created successfully. <a href='profile.php'>View Profile</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
