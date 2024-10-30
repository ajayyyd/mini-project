<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #d32f2f;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        nav {
            background-color: #f44336;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 20px;
        }

        section h2 {
            color: #d32f2f;
            border-bottom: 2px solid #d32f2f;
            padding-bottom: 10px;
        }

        button {
            background-color: #d32f2f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #b71c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f44336;
            color: white;
        }

        .hidden {
            display: none;
        }

        .fade-in {
            animation: fadeIn 0.5s forwards;
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        <nav>
            <ul>
                <li><a onclick="toggleSection('view-users')">View All Users</a></li>
                <li><a onclick="toggleSection('manage-blood-groups')">Manage Blood Groups</a></li>
                <li><a onclick="toggleSection('view-requests')">View Blood Requests</a></li>
                <li><a onclick="toggleSection('edit')">Edit </a></li>
            </ul>
        </nav>
        <main>
		<section id="view-users" class="hidden">
			<h2>View All Users</h2>
			<button onclick="toggleUsers()">View Users</button>
			<button onclick="toggleAdmins()">View ADMINS</button>
			<div id="user-table" class="hidden"></div>
		</section>
            <section id="manage-blood-groups" class="hidden">
                <h2>Manage Blood Groups</h2>
                <button>Add Blood Group</button>
                <button>Change Blood Group</button>
            </section>
            <section id="view-requests" class="hidden">
                <h2>View Blood Requests</h2>
                <button>View Requests</button>
            </section>
            <section id="edit" class="hidden">
                <h2>Edit</h2>
                <button>Edit About Us</button>
                <button>Edit Contact Us</button>
            </section>
        </main>
    </div>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                section.classList.add('fade-in');
                section.addEventListener('animationend', () => {
                    section.classList.remove('fade-in');
                }, { once: true });
            } else {
                section.classList.add('fade-out');
                section.addEventListener('animationend', () => {
                    section.classList.add('hidden');
                    section.classList.remove('fade-out');
                }, { once: true });
            }
        }

        function toggleUsers() {
            const userTable = document.getElementById('user-table');
            if (userTable.classList.contains('hidden')) {
                fetchUsers();
            } else {
                userTable.classList.add('fade-out');
                userTable.addEventListener('animationend', () => {
                    userTable.classList.add('hidden');
                    userTable.classList.remove('fade-out');
                }, { once: true });
            }
        }

        function fetchUsers() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_users.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const userTable = document.getElementById('user-table');
                    userTable.innerHTML = this.responseText;
                    userTable.classList.remove('hidden');
                    userTable.classList.add('fade-in');
                    userTable.addEventListener('animationend', () => {
                        userTable.classList.remove('fade-in');
                    }, { once: true });
                }
            }
			
            xhr.send();
        }
		function toggleAdmins() {
    const userTable = document.getElementById('user-table');
    if (userTable.classList.contains('hidden')) {
        fetchAdmins();
    } else {
        userTable.classList.add('fade-out');
        userTable.addEventListener('animationend', () => {
            userTable.classList.add('hidden');
            userTable.classList.remove('fade-out');
        }, { once: true });
    }
}

function fetchAdmins() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_admins.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            const userTable = document.getElementById('user-table');
            userTable.innerHTML = this.responseText;
            userTable.classList.remove('hidden');
            userTable.classList.add('fade-in');
            userTable.addEventListener('animationend', () => {
                userTable.classList.remove('fade-in');
            }, { once: true });
        }
    }
    xhr.send();
}
    </script>
</body>
</html>


