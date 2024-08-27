<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Life Donate Blood</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }
        .profile-box {
            display: none;
            position: absolute;
            top: 40px;
            right: 10px;
            width: 200px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .profile-box a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: blue;
        }
        .profile-box a:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="blood_search.php">Find Blood</li>
                <li><a href="create.php">Register Now</a></li>
                <form action="login.php">
                <li><button class ="login-btn">Log In</button></li>
                </form>
                <li><i class="fas fa-user profile-icon" id="profileIcon"></i>
                <div class="profile-box" id="profileBox">
                <a href="userprofile.php">Your Profile</a>
                </div>
                </li>
            </ul>
            
        </nav>
    </header>
    <section class="hero">
        <div class="content">
            <h1>Save Life Donate Blood</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
            <form action="donate.php">
            <button class="cta-btn">Donate Blood Now</button>
            </form>
        </div>
    </section>
</body>
</html>
