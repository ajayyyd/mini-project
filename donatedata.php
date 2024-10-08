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
// Prepare and bind
$stmt = "INSERT INTO donordata (name, age, phno, email, district, city, bloodgroup, availability) VALUES ($name, $age, $phone, $email, $district, $city, $bloodgroup, $status)";
mysqli_query($conn,$stmt);



// Execute the statement
// if ($result) {
//     echo "New record created successfully. <a href='profile.php'>View Profile</a>";
// } else {
//     echo "Error: ";
// }
?>