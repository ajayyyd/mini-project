<?php
// session_start(); // Start the session

// // Check if the user is logged in
// if (!isset($_SESSION['userid'])) {
//     // Redirect to login page if not logged in
//     header("Location: login.php?redirect=blood_request.php");
//     exit();
// }

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$database = "bloodrive";

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's ID from session
// $userid = $_SESSION['userid'];

// Query to check the status of the user
$query = "SELECT status FROM userdata WHERE status = 'login' LIMIT 1";
$result = $conn->query($query);

// If there's no user with the status 'login', redirect to the login page
if ($result->num_rows == 0) {
    header("Location: login.php?redirect=blood_request.php");
    exit();
}
 else {
    // If no user found, redirect to login page
    header("Location: blood_request.php");
    exit();
}
?>

// User is logged in, proceed with the blood request form

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Form</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #a2002e;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus, 
        .form-group select:focus {
            outline: none;
            border-color: #a2002e;
        }

        .submit-btn {
            background-color: #a2002e;
            color: #fff;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #8b0025;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        select:focus, input[type="text"]:focus {
            border-color: #ff4d4d;
            outline: none;
        }
    </style>

<script>
        // JavaScript function to update the cities based on the selected district
        function updateCities() {
            var district = document.getElementById("district").value;
            var citySelect = document.getElementById("city");
            var cities = {
                "Alappuzha": ["Alappuzha", "Cherthala", "Kayamkulam", "Haripad", "Ambalapuzha", "Chengannur", "Mavelikkara", "Mannar"],
                "Ernakulam": ["Kochi", "Perumbavoor", "Muvattupuzha", "Aluva", "Angamaly", "Kothamangalam", "North Paravur", "Kalamassery", "Thrippunithura"],
                "Idukki": ["Thodupuzha", "Munnar", "Kattappana", "Kumily", "Devikulam", "Nedumkandam", "Vazhathope"],
                "Kannur": ["Kannur", "Thalassery", "Payyannur", "Mattannur", "Iritty", "Kuthuparamba", "Chakarakkal", "Panoor"],
                "Kasaragod": ["Kasaragod", "Kanhangad", "Nileshwar", "Cheruvathur", "Manjeshwar", "Uppala", "Hosdurg"],
                "Kollam": ["Kollam", "Punalur", "Karunagappally", "Paravur", "Kottarakkara", "Anchal", "Pathanapuram", "Chavara"],
                "Kottayam": ["Kottayam", "Changanassery", "Pala", "Kanjirappally","Mundakayam", "Vaikom", "Ettumanoor","Kuravilangadu", "Kaduthuruthy", "Erattupetta"],
                "Kozhikode": ["Kozhikode", "Vadakara", "Koyilandy", "Mukkam", "Feroke", "Ramanattukara", "Balussery", "Thiruvambady"],
                "Malappuram": ["Malappuram", "Manjeri", "Tirur", "Perinthalmanna", "Ponnani", "Nilambur", "Kottakkal", "Kondotty"],
                "Palakkad": ["Palakkad", "Ottapalam", "Shoranur", "Chittur", "Mannarkkad", "Alathur", "Cherpulassery", "Pattambi"],
                "Pathanamthitta": ["Pathanamthitta", "Adoor", "Thiruvalla", "Ranni", "Konni", "Pandalam", "Kozhencherry", "Mallapally"],
                "Thiruvananthapuram": ["Thiruvananthapuram", "Neyyattinkara", "Attingal", "Varkala", "Nedumangad", "Kattakada", "Pothencode", "Kazhakkoottam"],
                "Thrissur": ["Thrissur", "Chalakudy", "Irinjalakuda", "Kunnamkulam", "Kodungallur", "Guruvayur", "Wadakkanchery", "Chavakkad"],
                "Wayanad": ["Kalpetta", "Sultan Bathery", "Mananthavady", "Meppadi", "Vythiri", "Panamaram", "Pozhuthana"]
            };

            // Clear the city dropdown
            citySelect.innerHTML = "";

            // Add the corresponding cities to the dropdown
            if (district in cities) {
                cities[district].forEach(function(city) {
                    var option = document.createElement("option");
                    option.value = city;
                    option.text = city;
                    citySelect.appendChild(option);
                });
            }
        }
    </script>


</head>
<body>
    <div class="form-container">
        <h2>Blood Request Form</h2>
        <form action="" method="POST">
            <!-- Full Name -->
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <!-- Blood Group -->
            <div class="form-group">
                <label for="bloodgroup">Wanted Blood Group</label>
                <select id="bloodgroup" name="bloodgroup" required>
                    <option value="" disabled selected>Select blood group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <!-- District -->
           <label for="district">District:</label>
            <select id="district" name="district" onchange="updateCities()" required>
                <option value="">Select District</option>
                <option value="Alappuzha">Alappuzha</option>
                <option value="Ernakulam">Ernakulam</option>
                <option value="Idukki">Idukki</option>
                <option value="Kannur">Kannur</option>
                <option value="Kasaragod">Kasaragod</option>
                <option value="Kollam">Kollam</option>
                <option value="Kottayam">Kottayam</option>
                <option value="Kozhikode">Kozhikode</option>
                <option value="Malappuram">Malappuram</option>
                <option value="Palakkad">Palakkad</option>
                <option value="Pathanamthitta">Pathanamthitta</option>
                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                <option value="Thrissur">Thrissur</option>
                <option value="Wayanad">Wayanad</option>
            </select>

            <!-- City -->
            <label for="city">City:</label>
            <select id="city" name="city" required>
                <option value="">Select City</option>
            </select>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <!-- Gmail -->
            <div class="form-group">
                <label for="gmail">Gmail</label>
                <input type="email" id="gmail" name="gmail" placeholder="Enter your Gmail" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>
</body>
</html>

<?php
// Database connection parameters
// $host = "localhost";
// $user = "root";       // Replace with your MySQL username
// $password = "";       // Replace with your MySQL password
// $database = "blooddrive";

// // Create a connection
// $conn = new mysqli($host, $user, $password, $database);

// // Check for connection errors
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $bloodgroup = $_POST['bloodgroup'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $gmail = $_POST['gmail'];
    
    // Assuming you already have a user ID (replace '1' with the actual logic to fetch userid)
     // You should replace this with dynamic user ID retrieval
    $query1 = "SELECT userid FROM userdata WHERE uname = '$username'";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $userid = $stmt->get_result();
    // Insert data into bloodrequests table
    $sql = "INSERT INTO bloodrequests (fullname, bloodgroup, district, city, phone, gmail, userid)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $fullname, $bloodgroup, $district, $city, $phone, $gmail, $userid);

    // Execute the query
    if ($stmt->execute()) {
        echo "Blood request submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

