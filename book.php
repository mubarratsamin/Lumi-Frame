<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Us - LumiFrame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    background: linear-gradient(180deg, #00514f, #004380); /* Gradient background */
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    overflow: hidden; /* Prevents scrollbars */
}

h2 {
    font-size: clamp(30px, 6vw, 40px);
    margin-bottom: 20px;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    animation: slideIn 0.5s ease forwards;
    opacity: 0; /* Start hidden for animation */
}

.form-group {
    margin-bottom: 15px;
    width: 100%;
    max-width: 500px;
    margin: 10px auto;
}

.form-group label {
    font-weight: bold;
    color: rgba(255, 255, 255, 0.85);
}

.form-group input, .form-group select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: rgba(255, 255, 255, 0.2);
    color: #000000;
}

.form-group input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: rgba(255, 255, 255, 0.2);
    color: #000000;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 20px auto;
    font-weight: bold;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}

button:hover {
    background-color: #45a049;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

#modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Ensure modal is above all other content */
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background-color: #053625;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    color: #333;
    background: none;
    border: none;
}

.close-btn:hover {
    color: #ff4c4c;
}

h3 {
    font-size: 22px;
    margin-bottom: 20px;
}

p {
    font-size: 16px;
    margin-bottom: 15px;
}

select, input[type="text"] {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-weight: bold;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}

button:hover {
    background-color: #45a049;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

/* Keyframes for Modal Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
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
<a href="welcome.php" class="logo">
        <img src="assests\logo.png" alt="LumiFrame Logo" style="width: 120px;">
    </a>
    <form id="bookingForm" method="POST">
        <h2>Book Us</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="number">Phone Number:</label>
            <input type="text" id="number" name="number" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="venue">Venue:</label>
            <input type="text" id="venue" name="venue" required>
        </div>
        <div class="form-group">
            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="hours">Duration (Hours):</label>
            <input type="number" id="hours" name="hours" min="1" required>
        </div>
        <div class="form-group">
            <label for="service">Service:</label>
            <select id="service" name="service" required>
                <option value="photography">Photography</option>
                <option value="videography">Videography</option>
                <option value="both">Both</option>
            </select>
        </div>
        <button type="button" onclick="openModal()">Book Now</button>
    </form>

    <!-- Modal for Payment Details -->
    <div id="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">×</span>
            <h3>Payment Details</h3>
            <p>Total Amount: <strong id="totalAmount"></strong></p>
            <p>Recipient's Number: <strong>01321868891</strong></p>
            
            <!-- Payment Method Dropdown -->
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="payment_method" required>
                <option value="bkash">bKash</option>
                <option value="nagad">Nagad</option>
                <option value="rocket">Rocket</option>
            </select>
            
            <!-- Transaction ID and Sender's Number -->
            <input type="text" id="transactionId" name="transaction_id" placeholder="Transaction ID" required>
            <input type="text" id="senderNumber" name="sender_number" placeholder="Sender's Number" required>
            
            <button onclick="submitForm()">Confirm</button>
        </div>
    </div>

    <script>
        function openModal() {
            const hours = parseInt(document.getElementById("hours").value);
            const service = document.getElementById("service").value;

            if (hours <= 0) {
                alert("Please enter a valid duration.");
                return;
            }

            let rate = 0;
            if (service === "photography") rate = 600;
            else if (service === "videography") rate = 1000;
            else if (service === "both") rate = 1600;

            const totalAmount = hours * rate;
            document.getElementById("totalAmount").textContent = `${totalAmount} BDT`;

            document.getElementById("modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        function submitForm() {
            const transactionId = document.getElementById("transactionId").value;
            const senderNumber = document.getElementById("senderNumber").value;
            const paymentMethod = document.getElementById("paymentMethod").value;

            if (!transactionId || !senderNumber || !paymentMethod) {
                alert("Please fill in all payment details.");
                return;
            }

            const form = document.getElementById("bookingForm");

            // Create hidden fields for transaction details and payment method
            const transactionField = document.createElement("input");
            const senderField = document.createElement("input");
            const paymentMethodField = document.createElement("input");

            transactionField.type = "hidden";
            transactionField.name = "transaction_id";
            transactionField.value = transactionId;

            senderField.type = "hidden";
            senderField.name = "sender_number";
            senderField.value = senderNumber;

            paymentMethodField.type = "hidden";
            paymentMethodField.name = "payment_method";
            paymentMethodField.value = paymentMethod;

            // Append the hidden fields to the form
            form.appendChild(transactionField);
            form.appendChild(senderField);
            form.appendChild(paymentMethodField);

            // Submit the form
            form.submit();
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        // Retrieve form data
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $venue = $_POST['venue'];
        $start_time = $_POST['start_time'];
        $hours = $_POST['hours'];
        $service = $_POST['service'];
        $transaction_id = $_POST['transaction_id'];
        $sender_number = $_POST['sender_number'];
        $payment_method = $_POST['payment_method'];

        $rate = $service === "photography" ? 600 : ($service === "videography" ? 1000 : 1600);
        $total_amount = $hours * $rate;

        // Insert booking data into the database
        $sql = "INSERT INTO bookings (name, number, email, venue, start_time, hours, service, total_amount, transaction_id, sender_number, payment_method)
                VALUES ('$name', '$number', '$email', '$venue', '$start_time', $hours, '$service', $total_amount, '$transaction_id', '$sender_number', '$payment_method')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking confirmed! Thank you.');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
