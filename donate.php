<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Entry Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffdddd;
        }
        h1 {
            text-align: center;
            color: #cc0000;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #cc0000;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #cc0000;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #cc0000;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #990000;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
    <script>
        function validateForm() {
            let age = document.forms["donationForm"]["age"].value;
            let weight = document.forms["donationForm"]["weight"].value;
            let errorMessage = "";

            if (age < 18) {
                errorMessage += "Age must be above 18.\n";
            }
            if (weight < 55) {
                errorMessage += "Weight must be above 55kg.\n";
            }

            if (errorMessage) {
                alert(errorMessage);
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Blood Donation Entry Form</h1>
        <form name="donationForm" action="process_donation.php" method="POST" onsubmit="return validateForm()">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            
            <label for="allergies">Do you have any allergies?</label>
            <textarea id="allergies" name="allergies"></textarea>
            
            <label for="cough_cold">Do you have cough or cold?</label>
            <select id="cough_cold" name="cough_cold" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
            
            <label for="bloodgroup">Blood Group:</label>
            <select id="bloodgroup" name="bloodgroup" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            
            <label for="smoke_drink">Do you smoke or drink?</label>
            <select id="smoke_drink" name="smoke_drink" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
            
            <label for="donated_before">Have you donated blood before?</label>
            <select id="donated_before" name="donated_before" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
            
            <label for="recent_donation">If yes, how recently?</label>
            <input type="text" id="recent_donation" name="recent_donation">
            
            <label for="medications">Are you on any medications?</label>
            <textarea id="medications" name="medications"></textarea>
            
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" required>
            
            <label for="hiv">Do you have HIV (positive)?</label>
            <select id="hiv" name="hiv" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
            
            <label for="travel">Have you recently traveled outside the country?</label>
            <select id="travel" name="travel" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
