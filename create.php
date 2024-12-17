<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
    background-color: #ffffff;
        color: #333;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  /* background: url(images/banner.png); */
  background: linear-gradient(to bottom right, #ff4d4d, #ffffff);
}
.wrapper{
  position: relative;
  max-width: 600px;
  width: 100%;
  background: #fff;
  padding: 34px;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.wrapper h2{
  position: relative;
  font-size: 22px;
  font-weight: 600;
  color: #fa0000;
}
.wrapper h2::before{
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 50px;
  border-radius: 12px;
  background: red;
  font-weight: bold;
}
.wrapper form{
  margin-top: 30px;
}
.wrapper form .input-box{
  height: 52px;
  margin: 18px 0;
}
form .input-box input{
  height: 100%;
  width: 100%;
  outline: none;
  padding: 0 15px;
  font-size: 17px;
  font-weight: 400;
  color: #333;
  border: 1.5px solid #C7BEBE;
  border-bottom-width: 2.5px;
  border-radius: 6px;
  transition: all 0.3s ease;
}
.input-box input:focus,
.input-box input:valid{
  border-color: red;
}

form h3{
  color: #707070;
  font-size: 14px;
  font-weight: 500;
  margin-left: 10px;
}
.input-box.button input{
  color: #fff;
  letter-spacing: 1px;
  border: none;
  background: rgb(255, 0, 0);
  cursor: pointer;
}
.input-box.button input:hover{
  background: #fc0b0b;
  transform: scale(1.03);
}
form .text h3{
 color: #333;
 width: 100%;
 text-align: center;
}
form .text h3 a{
  color: #ff0000;
  text-decoration: none;
}
form .text h3 a:hover{
  text-decoration: underline;
}
    </style>
</head>
<body>
<?php
// This block will execute when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";  // Use your database server name
    $username = "root";         // Your database username
    $password = "";             // Your database password
    $dbname = "blooddrive";      // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
 // Get the user type

    // SQL query based on user type
   
        $sql = "INSERT INTO userdata (uname, email, pwd) VALUES (?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $pass);

    // Execute the query
    if ($stmt->execute()) {
        $smessage = "New account created successfully";
    } else {
        $emessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<div class="wrapper">
        <h2>User Registration</h2>
        <form action="#">
            
          <div class="input-box">
            <input type="text" placeholder="Enter your Full Name" required>
          </div>

          <div class="input-box">
            <input type="text" placeholder="Enter your Mobile Number" required>
          </div>

          <div class="input-box">
            <input type="text" placeholder="Enter your Email Id" required>
          </div>

          <div class="input-box">
            <input type="number" placeholder="Enter your Age" required>
          </div>

          <div class="input-box">
            <label for="Gender" style="padding-left: 16px;">Gender</label>
            <select name="" id="" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Female">Transgender</option>
                <option value="Female">Gender Fluid</option>
                <option value="Female">Gender Neutral</option>
                <option value="Female">Apache RR 110</option>
                <option value="Female">Megatron</option>
            </select>
          </div>

          <div class="input-box">
            <label for="Blood Group" style="padding-left: 16px;">Blood Group</label>
            <select name="" id="" required>
                <option value="">Select</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
          </div>


          <div class="input-box">
            <img src="images/eyeclose.png" onclick="pass()" id="eyeicon" width="25px"
            style="float: right; position: absolute; right: 50px; top: 670px; cursor: pointer;">
             
            <input type="password" placeholder="Enter the Password" id="password" required> 
          </div>
          
          <div class="input-box button">
            <input type="Submit" value="Register Now">
          </div>

          <div class="text">
            <h3>Already have an account? <a href="login.html">Login now</a></h3>
          </div>

          
        </form>
      </div>
      <script>

        /* password view/hide toggle function */
        var a;
        function pass()
        {
            if(a==1)
        {
            document.getElementById('password').type='password';
            document.getElementById('eyeicon').src='images/eyeclose.png';
            a=0;
        }
        else
        {
            document.getElementById('password').type='text';
            document.getElementById('eyeicon').src='images/eye.png';
            a=1;
        }
        }
      </script>
    <?php
    // // Display success or error message
    if (isset($smessage)) {
        echo '<div class="message">' . $smessage . '</div>';
        echo '<a href="login.php" class="redirect-btn">Go to Sign In</a>';
    } elseif (isset($emessage)) {
        echo '<div class="error">' . $emessage . '</div>';
    }


