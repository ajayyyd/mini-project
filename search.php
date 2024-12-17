<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "blooddrive";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$district = $_POST['district'];
$city = $_POST['city'];
$bloodgroup = $_POST['bloodgroup'];
$district = strtolower($district);
$city = strtolower($city);

// SQL query to fetch data based on district, city, and blood group
$sql = "SELECT  name, bloodgroup, phno, email ,availability FROM donordata WHERE bloodgroup = '$bloodgroup' AND city = '$city' AND district = '$district'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Search Results</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom right, #ff4d4d, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Table Container */
        .table-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 100%;
            overflow-x: auto;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff4d4d;
            color: white;
            font-size: 18px;
        }

        td {
            font-size: 16px;
        }

        /* Button */
        .back-button {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #e60000;
        }

        .button-container {
            display: flex;
            gap: 10px; /* Adjusts the space between the buttons */
            margin-top: 20px; /* Adds some space above the buttons */
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Blood Donor List</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>S.No</th><th>Name</th><th>Blood Group</th><th>Contact</th><th>Availability</th></tr>";
            $i=1;
            while($row = $result->fetch_assoc()) {
                
                echo "<tr><td>" .$i. "</td><td>".$row["name"]. "</td><td>" . $row["bloodgroup"]. "</td><td>" . $row["phno"]."<br>".$row["email"]. "</td><td>" . $row["availability"]."</td></tr>";
                $i=$i+1;
            }
            echo "</table>";
        } else {
            echo "No results found";
        }
        $conn->close();
        ?>
        <div class="button-container">
            <a href="blood_search.php" class="back-button">Go Back</a>
            <!-- Button to Request Blood -->
            <form action="login.php" method="GET">
                <input type="hidden" name="redirect" value="blood_request.php">
                <button type="submit" class="back-button">Request Blood</button>
            </form>
    </div>

    </div>
</body>
</html>
