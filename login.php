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

// Process login if the form is submitted
if (isset($_POST['login-button'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT Password FROM registrants WHERE Email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error . " SQL: SELECT Password FROM registrants WHERE Email = ?");
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password (you may want to hash passwords when storing them in the database)
        if ($password === $hashed_password) {
            // Password is correct
            $_SESSION['email'] = $email; // Set session variable
            header('Location: welcome.php'); // Redirect to index page
            exit; // Stop further execution
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    // Clear the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #005f7b,#000000 ); 
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: rgba(0, 51, 102, 0.9); /* Darker background for better readability */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* More pronounced shadow */
            text-align: center;
            color: #fff;
            transition: transform 0.3s ease; /* Transition effect */
        }

        .container:hover {
            transform: translateY(-5px); /* Slight uplift on hover */
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px; /* Larger font for the title */
            text-transform: uppercase; /* Uppercase letters for emphasis */
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
            border-color: #FFD622FF; /* Change border color on focus */
            outline: none; /* Remove outline */
        }

        button {
            padding: 10px;
            background-color: #FFD622FF;
            color: #174f3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transition for button effects */
        }

        button:hover {
            background-color: #FFAA00FF; /* Slightly darker color on hover */
            transform: scale(1.05); /* Slight enlargement on hover */
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #FFD622FF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login-button">Login</button>
        </form>
        <?php
            if (isset($error_message)) {
                echo "<p style='color:red;'>" . htmlspecialchars($error_message) . "</p>";
            }
        ?>
        <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
    </div>
</body>
</html>
