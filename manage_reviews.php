<?php
$servername = "localhost:3306"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "lf"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Review deleted successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch reviews
$sql = "SELECT id, name, review, created_at FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif; /* Use Montserrat font */
        }

        body {
            background: linear-gradient(to right, #174f3c, #000000);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            text-align: center;
        }

        h1, h2 {
            color: #fff; /* Change h1 and h2 color */
        }

        .review {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            position: relative;
        }

        .review h3 {
            margin: 0 0 5px;
        }

        .review small {
            color: #ddd; /* Light grey for smaller text */
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 300px; /* Could be more or less, depending on screen size */
            text-align: center;
        }

        .modal-content img {
            width: 50px; /* Adjust as needed */
            height: 50px; /* Adjust as needed */
        }

        .logo {
            position: absolute; /* Position the logo */
            top: 10px; /* Distance from the top */
            right: 30px; /* Distance from the right */
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
    </style>
</head>
<body>

<a href="admin.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>

    <h1>Manage Reviews</h1>
    <br>
    <br>
    <div id="reviews">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="review">';
                echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                echo '<p>' . nl2br(htmlspecialchars($row['review'])) . '</p>';
                echo '<small>Submitted on ' . $row['created_at'] . '</small>';
                echo '<a href="?delete_id=' . $row['id'] . '" class="delete-btn">Delete</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }
        $conn->close();
        ?>
    </div>

    <!-- Modal for confirmation -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <img src="https://img.icons8.com/ios-filled/50/28a745/checkmark.png" alt="Checkmark">
            <h3>Review Submitted!</h3>
            <p>Thank you for your feedback.</p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        // Function to close the modal
        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        // Close modal if user clicks outside of the modal
        window.onclick = function(event) {
            const modal = document.getElementById('confirmationModal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>
