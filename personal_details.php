<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details Form</title>
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
                "Kottayam": ["Kottayam", "Changanassery", "Pala", "Kanjirappally","Mundakayam", "Vaikom", "Ettumanoor","Kuravilangadu", "Kaduthuruthy","arunoottimangalam","Erattupetta"],
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
    <style>
        /* Same styling as before for consistency */
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
        select {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Personal Details Form</h1>
        <form id="personalDetailsForm" action="donatedata.php" method="POST" >
            <label for="p_name">Full Name:</label>
            <input type="text" id="p_name" name="p_name" required>
            
            <label for="age">Age:</label>
            <input type="number" id="p_age" name="p_age" required>
            
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            
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
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available">available</option>
                <option value="not Available">not available</option>
            </select>
            
            <input type="submit" value="Submit">
        </form>
    </div>







</body>
</html>
