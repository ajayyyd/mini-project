<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
// Fetch user data from the database
// Assuming you have a database connection $conn
// $result = $conn->query("SELECT * FROM users WHERE id = $user_id");
// $user = $result->fetch_assoc();
$user = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'blood_status' => 'available' // or 'not available'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $blood_status = $_POST['blood_status'];

    // Update user data in the database
    // $conn->query("UPDATE users SET name='$name', email='$email', blood_status='$blood_status' WHERE id=$user_id");
    // Redirect or show a success message
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; }
        label { display: block; margin: 10px 0 5px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin-bottom: 10px; }
        input[type="submit"] { padding: 10px 20px; background-color: #007BFF; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Your Profile</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="blood_status">Blood Availability Status:</label>
            <select id="blood_status" name="blood_status">
                <option value="available" <?php echo $user['blood_status'] === 'available' ? 'selected' : ''; ?>>Available</option>
                <option value="not available" <?php echo $user['blood_status'] === 'not available' ? 'selected' : ''; ?>>Not Available</option>
            </select>

            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
