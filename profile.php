<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Life Donate Blood</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .menu {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            right: 10px;
            top: 60px;
            width: 200px;
            z-index: 1000;
        }

        .menu-item {
            padding: 10px;
            text-align: left;
        }

        .menu-item:hover {
            background: #f0f0f0;
        }

        .hamburger {
            cursor: pointer;
            font-size: 24px;
            margin-left: 10px;
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
                <li><a href="blood_search.php">Find Blood</a></li>
                <li>
                    <a href="#" class="profile-link">Profile</a>
                    <span class="hamburger" onclick="toggleMenu()">☰</span>
                    <div class="menu" id="menu">
                        <div class="menu-item"><a href="userprofile.php">Edit Profile</a></div>
                        <div class="menu-item"><a href="delete_account.php">Delete Account</a></div>
                        <div class="menu-item"><a href="logout.php">Log Out</a></div>
                        <div class="menu-item"><a href="details.php">Details</a></div>
                        <div class="menu-item"><a href="requests.php">Requests</a></div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <div class="content">
            <h1>Save Life Donate Blood</h1>
            <form action="donate.php">
                <button class="cta-btn">Donate Blood Now</button>
            </form>
        </div>
    </section>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        // Close menu if clicking outside of it
        window.onclick = function(event) {
            const menu = document.getElementById('menu');
            if (!event.target.matches('.hamburger') && !event.target.matches('.profile-link')) {
                menu.style.display = 'none';
            }
        }
    </script>
</body>
<?php

?>
</html>
