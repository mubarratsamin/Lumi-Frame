<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update status when admin clicks approve or reject
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Validate status
    if (in_array($status, ['Approved', 'Rejected'])) {
        // Update the status in the database
        $sql = "UPDATE bookings SET status = '$status' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully!";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}

// Fetch all bookings
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Bookings</title>
    <style>
        /* Basic CSS for table and buttons */
        body {
            background: linear-gradient(180deg, #00514f, #004380); /* Gradient background */
            color: #000000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .approve-btn, .reject-btn {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
        }
        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }
        .reject-btn {
            background-color: #f44336;
            color: white;
        }
        .status {
            font-weight: bold;
        }
        .logo {
            position: absolute;
            top: 10px;
            right: 30px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }
        h2 {
            color: #fff;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<a href="admin.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>
<h2>Manage Bookings</h2>

<?php
if ($result->num_rows > 0) {
    // Display bookings in a table
    echo "<table>";
    echo "<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Venue</th>
            <th>Start Time</th>
            <th>Hours</th>
            <th>Service</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['venue'] . "</td>";
        echo "<td>" . $row['start_time'] . "</td>";
        echo "<td>" . $row['hours'] . "</td>";
        echo "<td>" . $row['service'] . "</td>";
        echo "<td>" . $row['total_amount'] . " BDT</td>";
        echo "<td class='status'>" . $row['status'] . "</td>"; // Display status

        // Only show approve/reject buttons if the status is "Pending"
        if ($row['status'] == 'Pending') {
            echo "<td>
                    <form method='POST' style='display:inline'>
                        <button class='approve-btn' type='submit' name='status' value='Approved'>Approve</button>
                        <input type='hidden' name='id' value='" . $row['id'] . "' />
                    </form>
                    <form method='POST' style='display:inline'>
                        <button class='reject-btn' type='submit' name='status' value='Rejected'>Reject</button>
                        <input type='hidden' name='id' value='" . $row['id'] . "' />
                    </form>
                  </td>";
        } else {
            echo "<td><button disabled>Seen</button></td>"; // If already approved or rejected
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

$conn->close();
?>

</body>
</html>
