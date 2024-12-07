<?php
session_start(); // Start session handling

$servername = "localhost:3306"; // Adjust if necessary
$username = "root";
$password = "";
$dbname = "lf"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration if the form is submitted
if (isset($_POST['register-button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        // Removed the status message
    } else {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT Email FROM registrants WHERE Email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error . " SQL: SELECT Email FROM registrants WHERE Email = ?");
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Removed the status message
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO registrants (Name, Email, Password, registration_date) VALUES (?, ?, ?, NOW())");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error . " SQL: INSERT INTO registrants (Name, Email, Password, registration_date) VALUES (?, ?, ?, NOW())");
            }
            $stmt->bind_param("sss", $name, $email, $password); // Store plain password

            if ($stmt->execute()) {
                header('Location: login.php'); // Redirect to login page after successful registration
                exit; // Stop further execution
            } else {
                // Removed the status message
            }
        }
    }

    // Redirect back to the registration page
    header('Location: registration.php');
    exit; // Stop further execution
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #174f3c, #000000);
            color: #fff; 
            display: flex;
            justify-content: center;
            align-items: center; 
            height: 100vh; 
            position: relative; 
            overflow: hidden; 
        }

        .texture {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png'); 
            background-blend-mode: overlay; 
            z-index: 0; 
            opacity: 0.15; 
        }

        .container {
            max-width: 400px; 
            padding: 40px; 
            background: linear-gradient(to right, #000000, #005f7b); 
            border-radius: 10px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
            text-align: center; 
            color: #fff; 
            z-index: 1; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transition for hover effects */
        }

        .container:hover {
            transform: translateY(-5px); /* Elevate container on hover */
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3); /* Increase shadow on hover */
        }

        h2 {
            margin-bottom: 20px; 
            font-size: 24px; /* Increase font size */
            text-transform: uppercase; /* Uppercase letters for emphasis */
            letter-spacing: 1px; /* Spacing between letters */
        }

        form {
            display: flex; 
            flex-direction: column; 
            gap: 15px; 
            align-items: stretch; 
        }

        label {
            text-align: left; 
            font-weight: bold; 
        }

        input {
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            font-size: 16px; 
            width: 100%; 
            box-sizing: border-box; 
            transition: border-color 0.3s ease; /* Transition for input focus */
        }

        input:focus {
            border-color: #0052cc; /* Change border color on focus */
            outline: none; /* Remove outline */
        }

        button {
            padding: 10px; 
            background-color: #0052cc; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            width: 100%; 
            box-sizing: border-box; 
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transition for button effects */
        }

        button:hover {
            background-color: #0073e6; 
            transform: scale(1.05); /* Slightly enlarge button on hover */
        }

        p {
            margin-top: 20px; 
        }

        a {
            color: #4CAF50; 
            text-decoration: none; 
            transition: color 0.3s ease; /* Transition for link color */
        }

        a:hover {
            text-decoration: underline; 
            color: #366e3d; /* Darker shade on hover */
        }

        .image-container {
            display: flex; 
            align-items: center; 
            z-index: 1; 
        }

        .image-container img {
            max-width: 500px; /* Adjusted for better responsiveness */
            margin-left: 50px; 
            transition: transform 0.3s ease; /* Transition for image effect */
        }

        .image-container img:hover {
            transform: scale(1.1); /* Slightly enlarge image on hover */
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px; 
            }
            
            h2 {
                font-size: 20px; 
            }
            
            input, button {
                font-size: 14px; 
            }
        }
    </style>
</head>
<body>
    <div class="texture"></div>
    <div class="image-container">
        <div class="container">
            <h2>Create Your Account</h2>
            <form action="registration.php" method="POST">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit" name="register-button">Step Inside</button>
            </form>
            <p>Already have an account? <a href="login.php">Sign in here</a>.</p>
        </div>
        <img src="assests/logo.png" alt="Logo Image">
    </div>
</body>
</html>
