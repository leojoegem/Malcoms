<?php
// Assuming you have a valid database connection
$conn = new mysqli("localhost", "root", "", "Phonestore", 3308);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["name"])) {
        $user_id = $_SESSION["id"];
        $email = $conn->real_escape_string($_POST["email"]);
        $inquiry_text = $conn->real_escape_string($_POST["inquiry"]);

        // Insert the inquiry into the database
        $insert_query = "INSERT INTO Phonestore.inquiries (user_id, email, inquiry_text) VALUES ($user_id, '$email', '$inquiry_text')";
        $conn->query($insert_query);

        // Update the has_inquiry column in the users table
        $update_query = "UPDATE Phonestore.users SET has_inquiry = TRUE WHERE id = $user_id";
        $conn->query($update_query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f8f8f8;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            display: flex;
            justify-content: space-around;
        }

        .tab {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .tab:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .about-us {
            margin-top: 20px;
        }

        h1 {
            color: #333;
            font-size: 2em;
        }

        .services {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .service {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #333;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease-in-out;
        }

        .service:hover {
            transform: scale(1.1);
        }

        .service i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-form {
            margin-top: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 1.2em;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .form-group button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" id="home-tab" class="tab">Home</a>
    <a href="shop.html" id="shop-tab" class="tab">Shop</a>
    <a href="profile.html" id="profile-tab" class="tab">Profile</a>
</div>

<div class="content">
    <h1>Welcome to Our Phone Shop!</h1>
    <div class="about-us">
        <p>
            At Our Phone Shop, we are passionate about providing you with the latest and greatest smartphones.
            Our mission is to offer high-quality devices at competitive prices.
            Explore our shop to discover a wide range of phones from various brands to suit your needs.
        </p>
    </div>

    <!-- Placeholder images -->
    <img src="Images/phone.jpg" alt="Phone Image 1" width="300" height="200">
    <img src="Images/store.jpg" alt="Phone Image 2" width="300" height="200">
    <!-- Add more placeholders as needed -->

    <!-- Services section -->
    <div class="services">
        <div class="service">
            <i class="fas fa-mobile-alt"></i>
            <p>Buying & Trading</p>
        </div>
        <div class="service">
            <i class="fas fa-mobile-alt"></i>
            <p>Screen Replacement</p>
        </div>
        <div class="service">
            <i class="fas fa-tools"></i>
            <p>Phone Repair</p>
        </div>
    </div>

    <!-- Contact Us form -->
    <div class="contact-form">
        <h2>Contact Us for Inquiries</h2>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="inquiry">Your Inquiry:</label>
                <textarea id="inquiry" name="inquiry" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit Inquiry</button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle tab switching
    document.getElementById("home-tab").addEventListener("click", function () {
        loadPage("index.php");
    });

    document.getElementById("shop-tab").addEventListener("click", function () {
        loadPage("shop.html");
    });

    // Check if the user is logged in and set the profile tab accordingly
    // Remove the PHP tags and fix the syntax errors
    if (true) {
        document.getElementById("profile-tab").href = "profileview.php";
    }

    function loadPage(page) {
        document.querySelector(".content").innerHTML = "Loading...";
        setTimeout(function () {
            fetch(page)
                .then(response => response.text())
                .then(data => {
                    document.querySelector(".content").innerHTML = data;
                })
                .catch(error => {
                    console.error("Error loading page:", error);
                    document.querySelector(".content").innerHTML = "Error loading page.";
                });
        }, 1000);
    }
</script>



</body>
</html>
