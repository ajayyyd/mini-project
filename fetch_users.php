<?php
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

$sql = "SELECT uname, email, pwd, status FROM userdata";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Username</th><th>Email</th><th>Password</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["uname"]. "</td><td>" . $row["email"]. "</td><td>" . $row["pwd"]. "</td><td>" . $row["status"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
