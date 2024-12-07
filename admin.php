<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - LumiFrame</title>
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
            font-size: 16px;
        }

        h1 {
            font-size: clamp(40px, 8vw, 50px);
            margin-bottom: 40px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease-out;
        }

        .admin-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: transparent;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 1200px;
            width: 90%;
            animation: slideIn 1s ease-out;
        }

        .panel-buttons {
            display: flex;
            justify-content: space-around;
            gap: 30px;
            flex-wrap: wrap;
            width: 100%;
            margin-top: 30px;
            animation: fadeIn 1.2s ease-out;
        }

        .panel-buttons .button-card {
            background: linear-gradient(45deg, #174f3c, #007694);;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            padding: 25px 35px;
            border-radius: 15px;
            text-align: center;
            width: 250px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 200px;
            background-color: #2e2e2e;
            position: relative;
        }
        .panel-buttons .button-card:hover {
            background: linear-gradient(45deg, #007694, #174f3c); /* Reverse gradient on hover */
            transform: translateY(-5px) scale(1.05); /* Move up and scale on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Shadow effect on hover */
            animation: pulse 0.5s infinite alternate; /* Pulse effect */
        }

        .panel-buttons .button-card i {
            font-size: 30px;
            margin-bottom: 15px;
        }

        .panel-buttons .button-card p {
            margin-top: 10px;
        }

        .panel-buttons .button-card:hover {
            background-color: #444444;
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        .panel-buttons .button-card:active {
            transform: scale(0.98);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 20px;
        }

        .top-right-buttons button {
            background: linear-gradient(45deg, #174f3c, #174f3c);
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .top-right-buttons button i {
            margin-right: 6px;
        }

        .top-right-buttons button:hover {
            background: linear-gradient(45deg, #007694, #007694);
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Media Query for smaller screens */
        @media (max-width: 768px) {
            h1 {
                font-size: clamp(30px, 6vw, 40px);
            }

            .panel-buttons .button-card {
                font-size: 16px;
                padding: 15px 25px;
                width: 200px;
            }
        }

    </style>
</head>
<body>

    <h1>Admin Panel - Lumi Frame</h1>

    <div class="admin-panel">
        <h3> Manage your website </h3>
        <!-- Admin Buttons -->
        <div class="panel-buttons">
            <div class="button-card" onclick="location.href='manage_gallery.php'">
                <i class="fas fa-images"></i>
                <p>Manage Gallery</p>
            </div>
            <div class="button-card" onclick="location.href='manage_products.php'">
                <i class="fas fa-box"></i>
                <p>Manage Products</p>
            </div>
            <div class="button-card" onclick="location.href='manage_reviews.php'">
                <i class="fas fa-star"></i>
                <p>Manage Reviews</p>
            </div>
            <div class="button-card" onclick="location.href='view_orders.php'">
                <i class="fas fa-receipt"></i>
                <p>View Orders</p>
            </div>
            <!-- Added Manage Bookings button -->
            <div class="button-card" onclick="location.href='manage_booking.php'">
                <i class="fas fa-calendar-check"></i>
                <p>Manage Bookings</p>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="top-right-buttons">
        <button onclick="location.href='login.php'">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </div>

</body>
</html>
