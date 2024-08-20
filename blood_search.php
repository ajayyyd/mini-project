<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Search</title>
</head>
<style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #ff4d4d, #ffffff);
        }

        /* Container */
        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 40px;
            max-width: 400px;
            text-align: center;
        }

        /* Heading */
        h2 {
            color: #ff4d4d;
            margin-bottom: 20px;
        }

        /* Form Elements */
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        select:focus, input[type="text"]:focus {
            border-color: #ff4d4d;
            outline: none;
        }

        /* Button */
        input[type="submit"] {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #e60000;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 100%;
            }
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
    
    <div class="container">
        <h2>Search Blood Donors</h2>
        <form action="search.php" method="POST">
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

            <label for="city">City:</label>
            <select id="city" name="city" required>
                <option value="">Select City</option>
            </select>

            <label for="bloodgroup">Blood Group:</label>
            <select id="bloodgroup" name="bloodgroup" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <input type="submit" value="Search">
        </form>
    </div>

    <!-- <?php
// Database connection details
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
$state = $_POST['state'];
$city = $_POST['city'];
$bloodgroup = $_POST['bloodgroup'];

// Prepare and execute SQL query
$sql = "SELECT name, age, phno, email FROM donordata WHERE state=? AND city=? AND bloodgroup=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $state, $city, $bloodgroup);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    echo "<h2>List of Blood Donors</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Age</th><th>Contact</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"]. "</td><td>" . $row["age"]. "</td><td>" . $row["contact"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No donors found.";
}

// Close connection
$conn->close();
?> -->

</body>
</html>
