<?php
// Database connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "lf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all purchases
$sql = "SELECT * FROM purchases";
$result = $conn->query($sql);

// Handle Cancel or Done actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    if ($action == 'cancel') {
        // Delete the order from the database
        $deleteSql = "DELETE FROM purchases WHERE id = $orderId";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Order has been cancelled and removed from the list.";
        } else {
            echo "Error deleting order: " . $conn->error;
        }
    } elseif ($action == 'done') {
        // Update the status to 'done'
        $updateSql = "UPDATE purchases SET status = 'done' WHERE id = $orderId";
        if ($conn->query($updateSql) === TRUE) {
            echo "Order marked as done.";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(180deg, #00514f, #004380);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: clamp(40px, 8vw, 50px);
            margin-bottom: 40px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .orders-container {
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background: #003565;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background: #1a1a1a;
        }

        .cancel-btn, .done-btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .cancel-btn {
            background: #e74c3c;
            color: white;
        }

        .done-btn {
            background: #27ae60;
            color: white;
        }

        .cancel-btn:hover {
            background: #c0392b;
        }

        .done-btn:hover {
            background: #2ecc71;
        }

        .done {
            color: #2ecc71;
            font-size: 20px;
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
    </style>
</head>
<body>
<a href="admin.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>
    <h1>View Orders</h1>

    <div class="orders-container">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Customer Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Transaction ID</th>
                    <th>Sender's Number</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>৳<?php echo number_format($row['total'], 2); ?></td>
                        <td><?php echo ucfirst($row['payment_method']); ?></td>
                        <td><?php echo $row['transaction_id']; ?></td>
                        <td><?php echo $row['sender_number']; ?></td>
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
