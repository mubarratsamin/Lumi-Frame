<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LumiFrame</title>
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
            position: relative; /* Position for absolute logout button */
            overflow: hidden; /* Prevents scrollbars due to animations */
        }

        img {
            max-width: 300px; /* Adjust logo size */
            margin-bottom: 5px; /* Space below the logo */
            animation: fadeIn 3s ease; /* Fade-in effect for logo */
        }

        h1 {
            font-size: clamp(40px, 8vw, 30px);
            margin-bottom: 10px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.5s ease forwards; /* Slide-in effect for heading */
            opacity: 0; /* Start hidden for animation */
        }

        p {
            font-size: clamp(18px, 4vw, 20px);
            margin-bottom: 40px;
            max-width: 800px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
            animation: fadeIn 1.2s ease forwards; /* Fade-in effect for paragraph */
            opacity: 0; /* Start hidden for animation */
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

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Explore Buttons */
        .explore-buttons {
            margin-bottom: 40px; /* Space below the button container */
            display: flex;
            gap: 20px; /* Space between buttons */
            animation: fadeIn 1.4s ease forwards; /* Fade-in effect for button container */
            opacity: 0; /* Start hidden for animation */
        }

        .explore-buttons button {
            background: linear-gradient(45deg, #174f3c, #007694); /* Gradient background */
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 12px 20px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; /* Transition effects */
            display: flex;
            align-items: center;
            border-radius: 5px; /* Rounded corners */
            position: relative; /* Position for animation effect */
            overflow: hidden; /* Prevents overflow of inner elements */
            font-weight: bold; /* Bold text */
            letter-spacing: 0.5px; /* Slightly spaced letters */
            text-transform: uppercase; /* Uppercase letters */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Initial shadow */
        }

        .explore-buttons button i {
            margin-right: 6px;
        }

        .explore-buttons button:hover {
            background: linear-gradient(45deg, #007694, #174f3c); /* Reverse gradient on hover */
            transform: translateY(-5px) scale(1.05); /* Move up and scale on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Shadow effect on hover */
            animation: pulse 0.5s infinite alternate; /* Pulse effect */
        }

        @keyframes pulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }

        /* Top Left Buttons */
        .top-left-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            gap: 10px; /* Space between buttons */
            animation: fadeIn 1.6s ease forwards; /* Fade-in effect for top left buttons */
            opacity: 0; /* Start hidden for animation */
        }

        .top-left-buttons button {
            background: linear-gradient(45deg, #174f3c, #174f3c); /* Gradient background */
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
            transition: background-color 0.3s, transform 0.3s; /* Added transform for scaling */
            display: flex;
            align-items: center;
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Initial shadow */
        }

        .top-left-buttons button i {
            margin-right: 6px;
        }

        .top-left-buttons button:hover {
            background: linear-gradient(45deg, #007694, #007694); /* Reverse gradient on hover */
            transform: scale(1.1); /* Scale effect on hover */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Shadow effect on hover */
        }

        /* Logout Button */
        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 20px;
        }

        .top-right-buttons button {
            background: linear-gradient(45deg, #174f3c, #174f3c); /* Gradient background */
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
            transition: background-color 0.3s, transform 0.3s; /* Added transform for scaling */
            display: flex;
            align-items: center;
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Initial shadow */
        }

        .top-right-buttons button i {
            margin-right: 6px;
        }

        .top-right-buttons button:hover {
            background: linear-gradient(45deg, #007694, #007694); /* Reverse gradient on hover */
            transform: scale(1.1); /* Scale effect on hover */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Shadow effect on hover */
        }

        @media (max-width: 768px) {
            h1 {
                font-size: clamp(30px, 6vw, 40px);
            }
            p {
                font-size: clamp(16px, 3.5vw, 20px);
            }
        }

        /* Reveal elements after page load */
        window.onload = function() {
            document.querySelectorAll('h1, p, .explore-buttons, .top-left-buttons').forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = 1; // Fade in effect
                }, index * 300); // Staggered effect
            });
        };
    </style>
</head>
<body>
<h1>Welcome <br> To</h1>
    <img src="assests/logo.png" alt="LumiFrame Logo"> <!-- Add logo here -->
    
    <p>Your destination for capturing and preserving life's most beautiful moments.</p>

    <!-- New Explore Buttons -->
    <div class="explore-buttons">
        <button onclick="location.href='gallery.php'">
            <i class="fas fa-images"></i> Gallery
        </button>
        <button onclick="location.href='shop.php'">
            <i class="fas fa-shopping-cart"></i> Shop
        </button>
        <button onclick="location.href='book.php'">
            <i class="fas fa-calendar-check"></i> Book Us
        </button>
        <button onclick="location.href='review.php'">
            <i class="fas fa-book"></i> Reviews
        </button>
    </div>

    <!-- Top Left Buttons -->
    <div class="top-left-buttons">
        <button onclick="location.href='about_us.php'">
            <i class="fas fa-info-circle"></i> About Us
        </button>
        <button onclick="location.href='contact.php'">
            <i class="fas fa-envelope"></i> Contact Us
        </button>
    </div>

    <!-- Top Right Logout Button -->
    <div class="top-right-buttons">
        <button onclick="location.href='login.php'">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </div>

    <script>
        window.onload = function() {
            document.querySelectorAll('h1, p, .explore-buttons, .top-left-buttons, .top-right-buttons').forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = 1; // Fade in effect
                }, index * 300); // Staggered effect
            });
        };
    </script>
</body>
</html>
